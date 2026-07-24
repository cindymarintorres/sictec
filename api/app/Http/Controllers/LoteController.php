<?php

namespace App\Http\Controllers;

use App\Exports\FacturasExport;
use App\Imports\FacturasImport;
use App\Jobs\ConsultarRucJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $archivo = $request->file('archivo');
        $import = new FacturasImport();

        $import->leerDesde($archivo->getRealPath());
        $rucsTotales = $import->getRucs();

        $rucsUnicos = $import->getRucs()->unique()->values();

        if ($rucsUnicos->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron RUC válidos en la columna RUC_EMISOR',
            ], 422);
        }

        $loteUuid = (string) Str::uuid();

        // Persistimos el original ANTES de crear el batch, sin depender de su id
        Storage::disk('local')->putFileAs(
            "lotes/{$loteUuid}",
            $archivo,
            $archivo->getClientOriginalName()
        );

        $jobs = $rucsUnicos->map(fn($ruc) => new ConsultarRucJob($ruc));

        $batch = $batch = Bus::batch($jobs)
            ->name('lote-facturas')
            ->onQueue('sri-consultas')
            ->dispatch();

        // Mapeo batch_id -> lote_uuid para poder ubicar el archivo en show/descargar
        Cache::put("lote-uuid:{$batch->id}", $loteUuid, now()->addDay());

        return response()->json([
            'batch_id' => $batch->id,
            'total_filas' => $rucsTotales->count(),
            'rucs_unicos' => $rucsUnicos->count(),
            'duplicados' => $rucsTotales->count() - $rucsUnicos->count(),
        ], 201);
    }

    public function show(string $batchId)
    {
        $batch = Bus::findBatch($batchId);

        if (! $batch) {
            return response()->json(['message' => 'Lote no encontrado'], 404);
        }

        return response()->json([
            'total_jobs' => $batch->totalJobs,
            'pending_jobs' => $batch->pendingJobs,
            'processed_jobs' => $batch->processedJobs(),
            'failed_jobs' => $batch->failedJobs,
            'finished' => $batch->finished(),
            'cancelled' => $batch->cancelled(),
        ]);
    }

    public function descargar(string $batchId)
    {
        $batch = Bus::findBatch($batchId);

        if (! $batch) {
            return response()->json(['message' => 'Lote no encontrado'], 404);
        }

        if (! $batch->finished()) {
            return response()->json(['message' => 'El lote aún no ha terminado de procesarse'], 409);
        }

        $loteUuid = Cache::get("lote-uuid:{$batchId}");

        if (! $loteUuid) {
            return response()->json(['message' => 'Archivo original no encontrado'], 404);
        }

        $rutaOriginal = collect(Storage::disk('local')->files("lotes/{$batchId}"))->first();

        if (! $rutaOriginal) {
            return response()->json(['message' => 'Archivo original no encontrado'], 404);
        }

        $nombreBase = pathinfo($rutaOriginal, PATHINFO_FILENAME);
        $ext = pathinfo($rutaOriginal, PATHINFO_EXTENSION);

        return Excel::download(
            new FacturasExport($batchId, Storage::disk('local')->path($rutaOriginal)),
            "{$nombreBase}_clasificado.{$ext}"
        );
    }

    public function cancelar(string $batchId)
    {
        $batch = Bus::findBatch($batchId);

        if (! $batch) {
            return response()->json(['message' => 'Lote no encontrado'], 404);
        }

        if ($batch->finished()) {
            return response()->json(['message' => 'El lote ya terminó, no se puede cancelar'], 409);
        }

        $batch->cancel();

        return response()->json(['message' => 'Lote cancelado']);
    }
}

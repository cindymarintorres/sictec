<?php

namespace App\Http\Controllers;

use App\Exports\FacturasExport;
use App\Imports\FacturasImport;
use App\Jobs\ConsultarRucJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class LoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $archivo = $request->file('archivo');
        $extension = $archivo->getClientOriginalExtension();

        $import = new FacturasImport();
        Excel::import($import, $archivo);

        $rucsTotales = $import->getRucs();
        $rucsUnicos = $import->getRucs()->unique()->values();

        if ($rucsUnicos->isEmpty()) {
            return response()->json([
                'message' => 'No se encontraron RUC válidos en la columna RUC_EMISOR',
            ], 422);
        }

        $jobs = $rucsUnicos->map(fn($ruc) => new ConsultarRucJob($ruc));

        $batch = $batch = Bus::batch($jobs)
            ->name('lote-facturas')
            ->onQueue('sri-consultas')
            ->dispatch();

        // El id del batch ya existe en este punto -> lo usamos para guardar el original
        Storage::disk('local')->putFileAs(
            "lotes/{$batch->id}",
            $archivo,
            "original.{$extension}"
        );

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

        $rutaOriginal = collect(Storage::disk('local')->files("lotes/{$batchId}"))
            ->first(fn($path) => str_starts_with(basename($path), 'original.'));

        if (! $rutaOriginal) {
            return response()->json(['message' => 'Archivo original no encontrado'], 404);
        }

        $ext = pathinfo($rutaOriginal, PATHINFO_EXTENSION);

        return Excel::download(
            new FacturasExport($batchId, Storage::disk('local')->path($rutaOriginal)),
            "lote-{$batchId}-clasificado.{$ext}"
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

<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class FacturasExport implements FromCollection, WithHeadings
{
    protected array $encabezados;
    protected Collection $filas;

    public function __construct(protected string $batchId, string $rutaOriginal)
    {
        $hoja = Excel::toCollection(null, $rutaOriginal)->first();

        $this->encabezados = $hoja->first()->toArray();
        $indiceRuc = array_search('RUC_EMISOR', $this->encabezados, true);

        $this->filas = $hoja->skip(1)->map(function ($fila) use ($indiceRuc) {
            $ruc = trim((string) $fila[$indiceRuc]);
            $actividad = Cache::get("lote:{$this->batchId}:ruc:{$ruc}", 'No encontrado');

            return array_merge($fila->toArray(), [$actividad]);
        })->values();
    }

    public function headings(): array
    {
        return array_merge($this->encabezados, ['ACTIVIDAD_ECONOMICA']);
    }

    public function collection()
    {
        return $this->filas;
    }
}
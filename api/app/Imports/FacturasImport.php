<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FacturasImport
{
    protected Collection $rucs;

    public function __construct()
    {
        $this->rucs = collect();
    }

    /**
     * Lee el archivo con PhpSpreadsheet usando getFormattedValue(), igual que
     * FacturasExport. Es crítico que ambos lean el RUC de la misma forma
     * exacta: si Import y Export interpretan el mismo RUC de forma distinta
     * (uno con cero a la izquierda, el otro sin él), la clave de cache
     * jamás va a coincidir entre lo que el Job guarda y lo que el Export busca.
     */
    public function leerDesde(string $rutaArchivo): Collection
    {
        $spreadsheet = IOFactory::load($rutaArchivo);
        $hoja = $spreadsheet->getActiveSheet();

        $filas = [];
        foreach ($hoja->getRowIterator() as $fila) {
            $valores = [];
            foreach ($fila->getCellIterator() as $celda) {
                $valores[] = $celda->getFormattedValue();
            }
            $filas[] = $valores;
        }

        $encabezados = array_shift($filas);
        $indiceRuc = array_search('RUC_EMISOR', $encabezados, true);

        if ($indiceRuc === false) {
            return $this->rucs = collect();
        }

        return $this->rucs = collect($filas)
            ->pluck($indiceRuc)
            ->filter()
            ->map(fn ($ruc) => trim((string) $ruc))
            ->values();
    }

    public function getRucs(): Collection
    {
        return $this->rucs;
    }
}
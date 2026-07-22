<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FacturasImport implements ToCollection, WithHeadingRow
{
    protected Collection $rucs;

    public function __construct()
    {
        $this->rucs = collect();
    }

    // WithHeadingRow convierte "RUC_EMISOR" -> "ruc_emisor" automáticamente
    public function collection(Collection $rows)
    {
        $this->rucs = $rows->pluck('ruc_emisor')
            ->filter()
            ->map(fn ($ruc) => trim((string) $ruc));
    }

    public function getRucs(): Collection
    {
        return $this->rucs;
    }
}
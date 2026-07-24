<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class FacturasExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    private const COLOR_HEADER_FONDO = '5B9BD5';
    private const COLOR_HEADER_TEXTO = 'FFFFFF';
    private const COLOR_FILA_PAR = 'DEEBF6';
    private const COLOR_FILA_IMPAR = 'FFFFFF';

    protected array $encabezados;
    protected Collection $filas;

    public function __construct(protected string $batchId, string $rutaOriginal)
    {
        $spreadsheet = IOFactory::load($rutaOriginal);
        $hoja = $spreadsheet->getActiveSheet();

        $filasFormateadas = $this->leerFilasComoTextoOriginal($hoja);

        $this->encabezados = array_shift($filasFormateadas);
        $indiceRuc = array_search('RUC_EMISOR', $this->encabezados, true);

        $this->filas = collect($filasFormateadas)->map(function ($fila) use ($indiceRuc) {
            $ruc = trim((string) $fila[$indiceRuc]);
            $resultado = Cache::get("lote:{$this->batchId}:ruc:{$ruc}");

            $actividad = $resultado['actividad_economica'] ?? 'No encontrado';
            $categoria = $resultado['categoria'] ?? 'No encontrado';

            return array_merge($fila, [$actividad, $categoria]);
        })->values();
    }

    /**
     * Lee cada celda con getFormattedValue() en vez del valor crudo,
     * para preservar exactamente lo que el usuario ve en el Excel original
     * (ceros a la izquierda en RUC, fechas formateadas, etc.), evitando
     * que PhpSpreadsheet reinterprete texto como número.
     */
    private function leerFilasComoTextoOriginal(Worksheet $hoja): array
    {
        $filas = [];

        foreach ($hoja->getRowIterator() as $fila) {
            $valoresFila = [];
            foreach ($fila->getCellIterator() as $celda) {
                $valoresFila[] = $celda->getFormattedValue();
            }
            $filas[] = $valoresFila;
        }

        return $filas;
    }

    public function headings(): array
    {
        return array_merge($this->encabezados, ['ACTIVIDAD_ECONOMICA', 'CATEGORIA']);
    }

    public function collection()
    {
        return $this->filas;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Calibri')->setSize(11);

        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => self::COLOR_HEADER_TEXTO],
                    'name' => 'Calibri',
                    'size' => 11,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => self::COLOR_HEADER_FONDO],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $totalFilas = $sheet->getHighestRow();
                $totalColumnas = $sheet->getHighestColumn();

                for ($fila = 2; $fila <= $totalFilas; $fila++) {
                    $colorFondo = $fila % 2 === 0
                        ? self::COLOR_FILA_PAR
                        : self::COLOR_FILA_IMPAR;

                    $rango = "A{$fila}:{$totalColumnas}{$fila}";

                    $sheet->getStyle($rango)->applyFromArray([
                        'font' => [
                            'name' => 'Calibri',
                            'size' => 11,
                            'color' => ['rgb' => '000000'],
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $colorFondo],
                        ],
                    ]);
                }
            },
        ];
    }
}

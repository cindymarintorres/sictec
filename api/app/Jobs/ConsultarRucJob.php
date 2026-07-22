<?php

namespace App\Jobs;

use App\Services\ClasificadorService;
use App\Services\SriConsultaService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class ConsultarRucJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 5;

    public function __construct(
        private readonly string $ruc,
    ) {}

    public function handle(SriConsultaService $sriConsulta, ClasificadorService $clasificador): void
    {
        if ($this->batch()?->cancelled()) {
            return;
        }

        $contribuyente = $sriConsulta->consultar($this->ruc);
        $actividad = $contribuyente['actividadEconomicaPrincipal'] ?? null;

        Cache::put($this->claveCache(), [
            'actividad_economica' => $actividad,
            'categoria' => $clasificador->clasificar($actividad),
        ], now()->addHours(6));
    }

    private function claveCache(): string
    {
        return "lote:{$this->batch()->id}:ruc:{$this->ruc}";
    }

    public function middleware(): array
{
    return [new RateLimited('sri-consultas')];
}
}

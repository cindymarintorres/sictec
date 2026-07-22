<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SriConsultaService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.sri.api_url');
    }

    /**
     * Valida un RUC en el SRI. Devuelve true o false
     */
    public function validar(string $ruc): bool
    {
        try {
            $response = Http::timeout(10)
                ->retry(2, 500)
                ->get("{$this->baseUrl}/existePorNumeroRuc", [
                    'numeroRuc' => $ruc,
                ]);

            if (! $response->successful()) {
                Log::warning("SRI respondió {$response->status()} para RUC Valido -> {$ruc}");
                return false;
            }

            return (bool) $response->json();

        } catch (\Throwable $e) {
            Log::error("Error validando RUC {$ruc} en el SRI: {$e->getMessage()}");
            return false;
        }
    }

    /**
     * Consulta un RUC en el SRI. Devuelve el registro crudo o null
     * si no existe o la consulta falla.
     */
    public function consultar(string $ruc): ?array
    {
        try {
            $response = Http::timeout(10)
                ->retry(2, 500)
                ->get("{$this->baseUrl}/obtenerPorNumerosRuc", [
                    'ruc' => $ruc,
                ]);

            if (! $response->successful()) {
                Log::warning("SRI respondió {$response->status()} para RUC {$ruc}");
                return null;
            }

            $data = $response->json();

            return $data[0] ?? null;
        } catch (\Throwable $e) {
            Log::error("Error consultando RUC {$ruc} en el SRI: {$e->getMessage()}");
            return null;
        }
    }
}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('app:test-sri-concurrencia {cantidad=5}')]
#[Description('Prueba cuántas consultas concurrentes soporta el SRI')]
class TestSriConcurrencia extends Command
{
    //protected $signature = 'sri:test-concurrencia {cantidad=5}';
    //protected $description = 'Prueba cuántas consultas concurrentes soporta el SRI';

    public function handle(): void
    {
        $cantidad = (int) $this->argument('cantidad');
        $baseUrl = config('services.sri.api_url');
        $rucs = collect(config('sictec.rucs_prueba'))->take($cantidad);

        //dump('baseUrl:', $baseUrl);
        //dump('rucs cargados:', $rucs->all());

        if ($rucs->isEmpty()) {
            $this->error('No se cargaron RUCs desde config(sictec.rucs_prueba). Revisa el nombre del archivo/clave de config.');
            return;
        }

        $inicio = microtime(true);

        // Fase 1: valida todos los RUCs en paralelo
        $respuestasValidar = Http::pool(
            fn($pool) =>
            $rucs->map(
                fn($ruc) =>
                $pool->timeout(10)->get("{$baseUrl}/existePorNumeroRuc", ['numeroRuc' => $ruc])
            )->all()
        );

        $rucsValidos = $rucs->values()->filter(function ($ruc, $i) use ($respuestasValidar) {
            $response = $respuestasValidar[$i];
            return ! ($response instanceof \Throwable)
                && $response->successful()
                && $response->json() === true;
        })->values();

        $this->info("RUCs válidos: {$rucsValidos->count()} de {$rucs->count()}");

        // Fase 2: consulta solo los que dieron true, también en paralelo
        $respuestasConsultar = Http::pool(
            fn($pool) =>
            $rucsValidos->map(
                fn($ruc) =>
                $pool->timeout(10)->get("{$baseUrl}/obtenerPorNumerosRuc", ['ruc' => $ruc])
            )->all()
        );

        $duracion = round(microtime(true) - $inicio, 2);

        foreach ($respuestasConsultar as $i => $response) {
            $ruc = $rucsValidos[$i];
            $status = $response instanceof \Throwable ? 'EXCEPCIÓN: ' . $response->getMessage() : $response->status();
            $this->line("RUC {$ruc}: {$status}");
        }

        $this->info("Total procesados: {$rucs->count()} en {$duracion}s");
    }
}

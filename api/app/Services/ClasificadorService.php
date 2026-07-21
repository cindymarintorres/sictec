<?php

namespace App\Services;

use Illuminate\Support\Str;

class ClasificadorService
{
    private const SIN_CLASIFICAR = 'Sin clasificar';

    public function clasificar(?string $actividadEconomica): string
    {
        if (blank($actividadEconomica)) {
            return self::SIN_CLASIFICAR;
        }

        $normalizada = $this->normalizar($actividadEconomica);

        foreach (config('categorias') as $categoria => $palabrasClave) {
            foreach ($palabrasClave as $palabra) {
                $patron = '/\b' . preg_quote($this->normalizar($palabra), '/') . '\b/';
                if (preg_match($patron, $normalizada) === 1) {
                    return $categoria;
                }
            }
        }

        return self::SIN_CLASIFICAR;
    }

    private function normalizar(string $texto): string
    {
        return Str::of($texto)->ascii()->lower()->toString();
    }
}
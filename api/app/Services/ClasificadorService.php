<?php

namespace App\Services;

use Illuminate\Support\Str;

class ClasificadorService
{
    private const SIN_CLASIFICAR = 'Sin clasificar';

    /**
     * Mapa: descripcion oficial del SRI (normalizada) => codigo CIIU+SRI.
     * Generado desde el catalogo oficial. Ver: descripciones_actividad.php
     */
    private array $descripcionACodigo;

    /**
     * Mapa: prefijo de codigo => categoria.
     * Ordenado del prefijo MAS ESPECIFICO al MAS GENERAL para que el
     * primer match (el mas largo) gane siempre, sin importar el orden
     * de declaracion en el archivo de config.
     */
    private array $prefijoACategoria;

    public function __construct()
    {
        $this->descripcionACodigo = config('descripcion_actividad');

        $mapa = config('categorias_por_codigo');
        uksort($mapa, fn ($a, $b) => strlen($b) <=> strlen($a));
        $this->prefijoACategoria = $mapa;
    }

    public function clasificar(?string $actividadEconomica): string
    {
        if (blank($actividadEconomica)) {
            return self::SIN_CLASIFICAR;
        }

        $codigo = $this->obtenerCodigo($actividadEconomica);

        if ($codigo === null) {
            return self::SIN_CLASIFICAR;
        }

        return $this->clasificarPorCodigo($codigo);
    }

    /**
     * Busca el codigo CIIU+SRI exacto a partir del texto que entrega el SRI
     * (campo actividadEconomicaPrincipal). Ese texto es identico, palabra
     * por palabra, al del catalogo oficial, asi que un match exacto sobre
     * el texto normalizado es confiable en la inmensa mayoria de los casos.
     */
    private function obtenerCodigo(string $actividadEconomica): ?string
    {
        $normalizada = $this->normalizar($actividadEconomica);

        return $this->descripcionACodigo[$normalizada] ?? null;
    }

    /**
     * Encuentra la categoria cuyo prefijo de codigo coincide con el inicio
     * del codigo real de la actividad. Al estar ordenado de mas especifico
     * a mas general, "K6419" (si existiera) le ganaria a "K64", y "K64" le
     * gana a un eventual prefijo generico como "K".
     */
    private function clasificarPorCodigo(string $codigo): string
    {
        foreach ($this->prefijoACategoria as $prefijo => $categoria) {
            if (Str::startsWith($codigo, $prefijo)) {
                return $categoria;
            }
        }

        return self::SIN_CLASIFICAR;
    }

    private function normalizar(string $texto): string
    {
        $texto = Str::of($texto)->ascii()->lower()->toString();

        return trim(preg_replace('/\s+/', ' ', $texto));
    }
}
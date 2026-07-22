<?php
namespace App\Http\Controllers;

use App\Services\SriConsultaService;
use Illuminate\Http\JsonResponse;

class SriController extends Controller
{
    public function __construct(private SriConsultaService $sriService) {}

    public function validar(string $ruc): JsonResponse
    {
        $data = $this->sriService->validar($ruc);

        if ($data === false) {
            return response()->json(['error' => 'RUC no válido o RUC no encontrado'], 404);
        }

        return response()->json(['success' => 'RUC válido'], 200);
    }

    public function consultar(string $ruc): JsonResponse
    {
        $data = $this->sriService->consultar($ruc);

        if ($data === null) {
            return response()->json(['error' => 'RUC no encontrado o SRI no respondió'], 404);
        }

        return response()->json($data);
    }
}
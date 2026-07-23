<?php

use App\Http\Controllers\LoteController;
use App\Http\Controllers\SriController;
use Illuminate\Support\Facades\Route;


Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

Route::middleware('api.key')->group(
    function () {
        Route::get('/sri/validar/{ruc}', [SriController::class, 'validar']);
        Route::get('/sri/consultar/{ruc}', [SriController::class, 'consultar']);

        Route::post('/lotes', [LoteController::class, 'store']);
        Route::get('/lotes/{batchId}', [LoteController::class, 'show']);
        Route::get('/lotes/{batchId}/descargar', [LoteController::class, 'descargar']);
        Route::post('/lotes/{batchId}/cancelar', [LoteController::class, 'cancelar']);
    }
);

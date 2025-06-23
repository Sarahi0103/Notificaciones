<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MultaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para multas protegidas con autenticación y roles
Route::middleware(['auth:sanctum'])->group(function () {

    // Todos los usuarios autenticados pueden ver multas
    Route::get('/multas', [MultaController::class, 'index']);

    // Solo admin puede crear multas
    Route::middleware('role:admin')->post('/multas', [MultaController::class, 'store']);
});

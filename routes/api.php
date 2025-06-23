<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MultaController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

// Login con sesión (usa AuthController)
Route::post('/login', [AuthController::class, 'login']);

// CSRF cookie (necesario para Sanctum)
Route::get('/sanctum/csrf-cookie', function () {
    return response()->json(['csrf' => true]);
});

/*
|--------------------------------------------------------------------------
| Rutas protegidas con Sanctum
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Obtener usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada']);
    });

    // Ver multas (todos los usuarios autenticados)
    Route::get('/multas', [MultaController::class, 'index']);

    // Registrar multa (solo admin)
    Route::middleware('role:admin')->post('/multas', [MultaController::class, 'store']);
});
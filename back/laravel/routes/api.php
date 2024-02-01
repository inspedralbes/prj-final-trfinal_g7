<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CancionesController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/mostrar-canciones', [CancionesController::class, 'index']);
Route::post('/crear-cancion', [CancionesController::class, 'store']);
Route::get('buscar-cancion/{id}', [CancionesController::class, 'show']);
Route::put('actualizar-cancion/{id}', [CancionesController::class, 'update']);
Route::delete('eliminar-cancion/{id}', [CancionesController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

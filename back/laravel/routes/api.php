<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CancionesController;
use App\Http\Controllers\CategoriasController;
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
/**RUTAS CRUD CANCIONES*/
Route::get('/mostrar-canciones', [CancionesController::class, 'index']);
Route::post('/crear-cancion', [CancionesController::class, 'store']);
Route::get('buscar-cancion/{id}', [CancionesController::class, 'show']);
Route::put('actualizar-cancion/{id}', [CancionesController::class, 'update']);
Route::delete('eliminar-cancion/{id}', [CancionesController::class, 'destroy']);


/**RUTAS CRUD CATEGORIAS */
Route::get('/mostrar-categorias', [CategoriasController::class, 'index']);
Route::post('/crear-categoria', [CategoriasController::class, 'store']);
Route::get('buscar-categoria/{id}', [CategoriasController::class, 'show']);
Route::put('actualizar-categoria/{id}', [CategoriasController::class, 'update']);
Route::delete('eliminar-categoria/{id}', [CategoriasController::class, 'destroy']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

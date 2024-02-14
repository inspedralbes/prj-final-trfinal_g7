<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CancionesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ListaSemanalController;
use App\Http\Controllers\VotesController;
use App\Http\Controllers\Canciones_Categorias;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Cors;
use App\Http\Controllers\UserController;

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
Route::get('/categoria_por_id/{id}', [CategoriasController::class, 'categoriaPorId']);

/**RUTAS CANCIONES-CATEGORIAS */
Route::post('/assign-categories', [Canciones_Categorias::class, 'assignCategories']);
Route::get('/mostrar-canciones-con-categorias', [Canciones_Categorias::class, 'mostrarCancionesConCategorias']);
Route::get('/lista_canciones_categoria/{id}', [Canciones_Categorias::class, 'listaCancionesCategoria']);

/**RUTAS LISTA SEMANAL */
Route::post('/aceptar-lista-semanal', [ListaSemanalController::class, 'aceptarListaSemanal']);
Route::get('/lista-semanal', [ListaSemanalController::class,'obtenerListaSemanal']);
Route::post('/votar', [VotesController::class, 'vote']);

/**RUTAS USUARIOS */
Route::get('/users', [UserController::class, 'index']);
Route::put('/users/{user}', [UserController::class, 'update']);



/**RUTAS LOGIN-REGISTER USERS */
Route::group(['middleware' => 'Cors'], function () {
    Route::post('/login', [AuthController::class, 'login']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);




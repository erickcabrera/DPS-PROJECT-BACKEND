<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropuestaController;
use App\Http\Controllers\PlazaTrabajoController;
use App\Http\Controllers\EnvioCvController;
use App\Http\Controllers\FiltracionEntrevistaController;
use App\Http\Controllers\HistorialAsignacionController;


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

Route::middleware('auth:api')->get('/usuario', function () {
    return Auth::user();
});
//Rutas Clientes
Route::get('/clientes', [ClienteController::class, 'index']);
Route::get('/clientes/{id}', [ClienteController::class, 'show']);
Route::post('/clientes', [ClienteController::class, 'store']);
Route::put('/clientes/{id}', [ClienteController::class, 'update']);
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);
//Rutas candidatos
Route::get('/candidatos', [CandidatoController::class, 'index']);
Route::get('/candidatos/{id}', [CandidatoController::class, 'show']);
Route::post('/candidatos', [CandidatoController::class, 'store']);
Route::put('/candidatos/{id}', [CandidatoController::class, 'update']);
Route::delete('/candidatos/{id}', [CandidatoController::class, 'destroy']);
//Rutas usuarios
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
//
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//Rutas para propuestas
Route::get('/propuestas', [PropuestaController::class, 'index']);
Route::get('/propuestas/{id}', [PropuestaController::class, 'show']);
Route::post('/propuestas', [PropuestaController::class, 'store']);
Route::put('/propuestas/{id}', [PropuestaController::class, 'update']);
Route::delete('/propuestas/{id}', [PropuestaController::class, 'destroy']);
//Rutas para Plazas trabajo
Route::get('/plazas-trabajo', [PlazaTrabajoController::class, 'index']);
Route::get('/plazas-trabajo/{id}', [PlazaTrabajoController::class, 'show']);
Route::post('/plazas-trabajo', [PlazaTrabajoController::class, 'store']);
Route::put('/plazas-trabajo/{id}', [PlazaTrabajoController::class, 'update']);
Route::delete('/plazas-trabajo/{id}', [PlazaTrabajoController::class, 'destroy']);
//Rutas para Cv
Route::get('/envio-cvs', [EnvioCvController::class, 'index']);
Route::get('/envio-cvs/{id}', [EnvioCvController::class, 'show']);
Route::post('/envio-cvs', [EnvioCvController::class, 'store']);
Route::put('/envio-cvs/{id}', [EnvioCvController::class, 'update']);
Route::delete('/envio-cvs/{id}', [EnvioCvController::class, 'destroy']);
//Rutas para filtraciones
Route::get('/filtraciones-entrevistas', [FiltracionEntrevistaController::class, 'index']);
Route::get('/filtraciones-entrevistas/{id}', [FiltracionEntrevistaController::class, 'show']);
Route::post('/filtraciones-entrevistas', [FiltracionEntrevistaController::class, 'store']);
Route::put('/filtraciones-entrevistas/{id}', [FiltracionEntrevistaController::class, 'update']);
Route::delete('/filtraciones-entrevistas/{id}', [FiltracionEntrevistaController::class, 'destroy']);
//Ruta para historial
Route::get('/historial-asignaciones', [HistorialAsignacionController::class, 'index']);
Route::get('/historial-asignaciones/{id}', [HistorialAsignacionController::class, 'show']);
Route::post('/historial-asignaciones', [HistorialAsignacionController::class, 'store']);
Route::put('/historial-asignaciones/{id}', [HistorialAsignacionController::class, 'update']);
Route::delete('/historial-asignaciones/{id}', [HistorialAsignacionController::class, 'destroy']);

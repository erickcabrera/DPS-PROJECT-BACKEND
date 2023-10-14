<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CandidatoController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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


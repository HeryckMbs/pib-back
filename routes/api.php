<?php

use App\Http\Controllers\CultoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DepartamentoFuncaoController;
use App\Http\Controllers\DepartamentoIntegranteController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\IgrejaController;
use App\Http\Controllers\UserController;
use App\Models\Departamento;
use App\Models\Equipe;
use App\Models\Membro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/login', [UserController::class, 'register'])->name('login');
Route::post('/register',[UserController::class,'register']);

Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::post('/equipe',[EquipeController::class,'create']);
    Route::get('/listEquipe',[EquipeController::class,'listEquipe']);
    Route::get('/getEquipe/{cod_equipe}',[EquipeController::class, 'getEquipeBycode']);
    Route::get('/equipe/{equipe_id}',[EquipeController::class,'getEquipe']);
    Route::get('/equipeIntegrantes/{equipe_id}',[EquipeController::class,'getIntegrantes']);
});


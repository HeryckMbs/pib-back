<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DepartamentoFuncaoController;
use App\Http\Controllers\DepartamentoIntegranteController;
use App\Http\Controllers\IgrejaController;
use App\Http\Controllers\UserController;
use App\Models\Departamento;
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
Route::get('/login', [IgrejaController::class, 'index'])->name('login');

Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::post('/mount_user',[UserController::class,'mountUser']);

    Route::group(['prefix' => 'church'],function(){
        Route::get('/{id_church}/members',[IgrejaController::class,'getAllMembersOfChurch'])->name('church.members');
        Route::post('/store',[IgrejaController::class, 'create'])->name('church.create');
        Route::get('/{id_igreja}',[IgrejaController::class,'getDetail'])->name('church.get');
    });

    Route::group(['prefix' => 'department'],function(){
        Route::get('/getDepartmentsOfChurch/{id_church}',[DepartamentoController::class, 'getDepartmentsOfChurch'])->name('department.church');
        Route::post('/store',[DepartamentoController::class,'create'])->name('department.create');
        Route::get('/{id_departamento}',[DepartamentoController::class,'getDetail'])->name('department.get');
        Route::get('/{id_departamento}/membros',[DepartamentoController::class,'getMembers'])->name('department.get');
        Route::get('/{id_departamento}/membrosWithoutDepartment',[DepartamentoController::class,'getMembersWithoutDeparment'])->name('department.get');
        Route::post('/{id_departamento}/addMembros',[DepartamentoController::class,'addMembers'])->name('department.addMembers');
        Route::get('/{id_departamento}/funcoes',[DepartamentoFuncaoController::class, 'getFuncoes'])->name('department.funcoes.get');
        Route::post('/{id_departamento}/addFuncao',[DepartamentoFuncaoController::class, 'storeFuncao'])->name('department.funcoes.store');
        Route::put('/{id_departamento}/updateFuncaoMember',[DepartamentoIntegranteController::class,'updateFuncao']);
        Route::delete('/deleteMember',[DepartamentoIntegranteController::class,'deleteIntegrante']);
    });

});

Route::get('/getChurchs',[IgrejaController::class,'getAllChurch'])->name('church.getAll');
Route::post('/register',[UserController::class,'register']);

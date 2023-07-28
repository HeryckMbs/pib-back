<?php

use App\Http\Controllers\UserController;
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

Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::post('/mount_user',[UserController::class,'mountUser']);
});

Route::post('/register',function(Request $request){
    try{
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
       $user =  User::create($input);
        Membro::create([
            'nome' => $user->name,
            'url_photo' => null,
            'dt_aniversario' => null,
            'user_id' => $user->id,
        ]);
        return response()->json(['message' => 'Sucesso']);
    }catch(\Exception $e){
        return response()->json(['message' => $e->getMessage(), 'data' => $request]);
    }
});

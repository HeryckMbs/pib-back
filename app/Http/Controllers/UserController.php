<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

            'email' => 'required|unique:users',

            'password' => 'required|min:6',
        ], [
            'name.required' => 'The first name field is required.',
            'email.required' => 'The last name field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => "Couldn't validate"], 403);
        }
        $user = User::create([
            'name' => $request->name,

            'email' => $request->email,

            'password' => bcrypt($request->password),
        ]);




        return response()->json(['message' => 'Usuário criado com sucesso'], 200);
    }


}

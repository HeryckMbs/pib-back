<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function mountUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email obrigatório',
            'password.required' => 'Senha obrigatória',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 403);
        }
        try{


            $entities = [
                'igreja',
                'campanha',
                'campanha_culto',
                'evento',
                'evento_musicas',
                'evento_integrantes',
                'culto',
                'departamento',
                'departamento_integrantes',
                'departamento_avisos',
                'musicas',
                'pedidos_oracao',
                'pedidos_musica',
                'pastas',
                'cifras',
                'categorias',
                'membros',
            ];

            $permissions = [
                'can_create',
                'can_read',
                'can_update',
                'can_delete',
            ];
            $originalPermissions = [];

            $user = Auth::user();
            $userPermissions = [];

            foreach($user->getPermissionsViaRoles() as $permissionsUser){
                $userPermissions[] = $permissionsUser->name;
            }
            foreach($entities as $entity){
                foreach($permissions as $permission){
                    $permissionName = $entity. '_'. $permission;
                    $originalPermissions[$entity][$permission] = in_array($permissionName, $userPermissions) ?? false;
                }
            }
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 200);

        }

        return response()->json(['user' => $user,'permissions'=> $originalPermissions], 200);
    }

        // ignore: use_build_context_synchronously
}

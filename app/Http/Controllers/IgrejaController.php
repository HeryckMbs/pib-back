<?php

namespace App\Http\Controllers;

use App\Models\Igreja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IgrejaController extends Controller
{

    public function index(){

    }
    public function getAllChurch()
    {
        try {
            $churchrs = Igreja::all();
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'churchs' => $e->getMessage()]);
        }
        return response()->json(['success' => true, 'churchs' => $churchrs]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'telefone' => 'required'
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'telefone.required' => 'O campo telefone é obrigatório'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, $validator->messages()], 400);
        }

        try {
            DB::beginTransaction();
            Igreja::create([
                'nome' => $request->nome,
                'telefone' => $request->telefone,
            ]);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Igreja criada com sucesso!'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Não foi possível criar a igreja!', 'errors' => $e->getMessage()], 400);
        }
    }

    public function getAllMembersOfChurch($id_church){
        try{
            $membros = Igreja::findOrFail($id_church)->members;
            return response()->json(['success' => true, 'members' => $membros]);
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Não foi possível completar a requisição', 'errors' => $e->getMessage()], 400);
        }
    }

    public function getDetail($id_church){
        try{
            $igreja = Igreja::findOrFail($id_church);
            return response()->json(['success' => true, 'church' => $igreja]);
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'Não foi possível completar a requisição', 'errors' => $e->getMessage()], 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\DepartamentoFuncao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartamentoFuncaoController extends Controller
{
    public function getFuncoes($id_departamento)
    {
        try {
            $funcoes = Departamento::findOrFail($id_departamento)->functions;
            return response()->json(['success' => true, 'funcoes' => $funcoes], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 400);
        }
    }

    public function storeFuncao(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'descricao' => 'required',
            'id_departamento' => 'required'
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'descricao.required' => 'O campo nome é obrigatório',
            'id_departamento.required' => 'Requisição inválida',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => json_encode($validator->messages())], 400);
        }

        try{
            DepartamentoFuncao::create($request->all());
            return response()->json(['success' => true,'message' => 'Função criada com sucesso!' ]);
        }catch(\Exception $e){
            return response()->json(['success' => false,'errors' =>$e->getMessage() ]);
        }
    }

}

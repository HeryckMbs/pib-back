<?php

namespace App\Http\Controllers;

use App\Models\DepartamentoIntegrante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartamentoIntegranteController extends Controller
{
    public function updateFuncao(Request $request, $id_departamento)
    {
        $validator = Validator::make($request->all(), [
            'id_membro' => 'required',
        ], [
            'id_membro.required' => 'Requisição inválida',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => json_encode($validator->messages())], 400);
        }
        try {
            $departamentoIntegrante = DepartamentoIntegrante::where([['id_departamento', '=', $id_departamento,], ['id_membro', '=', $request->id_membro]])->first();
            $departamentoIntegrante->id_funcao = $request->id_nova_funcao;
            $departamentoIntegrante->save();
            return response()->json(['success' => true, 'message' => 'Função atualizada com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Não foi possível concluir a operação!', 'errors' => $e->getMessage()], 400);
        }
    }

    public function deleteIntegrante(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_membro' => 'required',
            'id_departamento' => 'required'
        ], [
            'id_membro.required' => 'Requisição inválida',
            'id_departamento.required' => 'Requisição inválida',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => json_encode($validator->messages())], 400);
        }
        try {
            $departamentoIntegrante = DepartamentoIntegrante::where([['id_departamento', '=', $request->id_departamento], ['id_membro', '=', $request->id_membro]])->first();
            $departamentoIntegrante->delete();
            return response()->json(['success' => true, 'message' => 'Membro excluído com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Não foi possível concluir a operação!', 'errors' => $e->getMessage()], 400);
        }
    }
}

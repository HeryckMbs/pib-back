<?php

namespace App\Http\Controllers;

use App\Models\Culto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CultoController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'descricao' => 'required',
            'data_inicio' => 'required',
            'id_igreja' => 'required'
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
            'data_inicio.required' => 'O campo data de início é obrigatório!',
            'id_igreja.required' => 'Requisição inválida'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => json_encode($validator->getMessageBag())]);
        }

        try {
            $data = [ 'id_igreja' => $request->id_igreja,'nome' => $request->nome, 'descricao' => $request->descricao, 'dt_inicio' => Carbon::parse($request->data_inicio), ];

            Culto::create($data);
            return response()->json(['success' => true, 'message' => 'Culto criado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => 'Não foi possível completar a requisição', 'errors' => $e->getMessage()], 500);
        }

    }

    public function getCulto($id_igreja)
    {

        try {
            $cultos = Culto::where('id_igreja', '=', $id_igreja)->get();
            return response()->json(['success' => true, 'cultos' => $cultos], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 500);

        }
    }

}

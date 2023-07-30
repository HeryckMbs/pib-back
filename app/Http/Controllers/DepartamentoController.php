<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\DepartamentoIntegrante;
use App\Models\Igreja;
use App\Models\Membro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{
    public function getDepartmentsOfChurch($id_igreja)
    {
        try {
            $departmens = Departamento::where('id_igreja', $id_igreja)->get();

            return response()->json(['success' => true, 'departmens' => $departmens], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'errors' => $e->getMessage()], 400);
        }
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'descricao' => 'required',
            'objetivo' => 'required',
            'id_lider' => 'required',
            'id_igreja' => 'required'
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'descricao.required' => 'O campo descricao é obrigatório',
            'objetivo.required' => 'O campo objetivo é obrigatório',
            'id_lider.required' => 'O campo líder é obrigatório',
            'id_igreja.required' => 'Requisição inválida'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()], 400);
        }
        try {
            Departamento::create($request->all());
            return response()->json(['success' => true, 'message' => 'Departamento criado com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Não foi possível criar o departamento', 'errors' => $e->getMessage()], 200);
        }

    }
    public function addMembers(Request $request, $id_departamento)
    {
        $validator = Validator::make($request->all(), [
            'members' => 'required',
        ], [
            'members.required' => 'É necessário escolher ao menos um membro para adicionar a sua equipe',
        ]);

        if ($validator->fails()) {
            $message = implode($validator->messages()->toArray(), ' - ');
            return response()->json(['success' => false, 'message' => $message], 400);
        }
        try {
            foreach ($request->members as $membro) {
                DepartamentoIntegrante::create(['id_membro' => $membro, 'id_departamento' => (int) $id_departamento]);
            }
            return response()->json(['success' => true, 'message' => 'Integrantes adicionados ao departamento com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Não foi possível adicionar os integrantes ao o departamento', 'errors' => $e->getMessage()], 200);
        }

    }

    public function getDetail($id_departamento)
    {
        try {
            $departamento = Departamento::findOrFail($id_departamento);
            return response()->json(['success' => true, 'department' => $departamento]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Não foi possível completar a requisição', 'errors' => $e->getMessage()], 400);
        }
    }

    public function getMembers($id_departamento)
    {
        try {
            $members = Departamento::where('id', $id_departamento)->with(['members' => ['functions']])->first();
            return response()->json(['success' => true, 'members' => $members->members]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Não foi possível completar a requisição', 'errors' => $e->getMessage()], 400);
        }
    }

    public function getMembersWithoutDeparment($id_igreja)
    {
        try {
            $membersWithDepartment = DB::table('departamento_integrantes')->groupBy('id_membro')->pluck('id_membro');
            $membersWithoutDepartment = Membro::whereNotIn('id', $membersWithDepartment)->get();
            return response()->json(['success' => true, 'members' => $membersWithoutDepartment]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Não foi possível completar a requisição', 'errors' => $e->getMessage()], 400);
        }
    }
}

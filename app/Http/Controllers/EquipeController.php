<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Integrante;
use App\Models\IntegranteEquipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquipeController extends Controller
{
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
        ], [
            'nome.required' => 'Nome obrigatório',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 403);
        }

        try{
            $input = $request->all();

            do {
                $codigo = $this->gerarCodigoAleatorio();
            } while (Equipe::where('codigo', $codigo)->exists());

            $input['codigo'] = $codigo;

            $equipe =  Equipe::create($input);
            IntegranteEquipe::create(['equipe_id' => $equipe->id,'integrante_id' => Integrante::where('user_id',auth('api')->user()->id)->first()->id]);
            return response()->json(['success' => true,'message' => 'Sucesso','data'=> $equipe,]);
        }catch(\Exception $e){
            return response()->json(['success' => false,'message' => $e->getMessage(), 'data' => $request]);
        }
    }

    public function listEquipe(){
                
        try{
            $integrante = Integrante::where('user_id',auth('api')->user()->id)->first(); 
            $equipes =  $integrante->equipes;
            return response()->json(['success'=> true, 'data' => $equipes]);
        }catch(\Exception $e){
            return response()->json(['success'=> false, 'erro' => $e->getMessage()]);
        }
    }

    public function gerarCodigoAleatorio($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
      
        return $randomString;
    }

    public function getEquipeBycode( $cod_equipe){
        try{
            $equipe = Equipe::where('codigo',$cod_equipe)->first();
            
            if($equipe->open){
                $integrante = Integrante::where('user_id',auth('api')->user()->id)->first(); 
                if(IntegranteEquipe::where([['equipe_id','=',$equipe->id,],['integrante_id','=', $integrante->id]])->exists()){
                    return response()->json(['success'=> false, 'message' => 'Você já faz parte da equipe '.$equipe->nome,]);
                }
                $integracao = IntegranteEquipe::create(['equipe_id'=> $equipe->id,'integrante_id' => $integrante->id]);
                if($integracao != null){
                    return response()->json(['success'=> true, 'message' => 'Parabéns agora você faz parte da equipe '.$equipe->nome,'data'=> $equipe]);
                }
                return response()->json(['success'=> false, 'message' => 'Não foi possível integrar-se a equipe, entre em contato com o administrador do sistema']);

            }else{
            return response()->json(['success'=> false, 'message' => 'Equipe não se encontra aberta para inscrição de integrantes']);

            }
        }catch(\Exception $e){
            return response()->json(['success'=> false, 'message' => $e->getMessage()]);

        }
    }

    public function getEquipe($equipe_id){
        try{
            $equipe = Equipe::find($equipe_id);
            return response()->json(['success'=> true, 'data' => $equipe]);
        }catch(\Exception $e){
            return response()->json(['success'=> false, 'message' => $e->getMessage()]);

        }
    }
    
    public function getIntegrantes($equipe_id){
        try{
            $equipe = Equipe::find($equipe_id);
            return response()->json(['success'=> true, 'data' => $equipe->integrantes]);
        }catch(\Exception $e){
            return response()->json(['success'=> false, 'message' => $e->getMessage()]);

        }
    }

}

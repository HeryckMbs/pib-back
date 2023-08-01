<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    protected $fillable = [
        'nome',
        'url_photo',
        'dt_aniversario',
        'user_id',
        'id_igreja'
    ];
    use HasFactory;

    public function departments(){
        return $this->belongsToMany(Departamento::class,'departamento_integrantes','id_membro','id_departamento');
    }

    public function functions(){
        return $this->belongsToMany(DepartamentoFuncao::class, 'departamento_integrantes','id_membro','id_funcao','id','id');
    }

    public function participations(){
        return $this->hasMany(DepartamentoIntegrante::class,'id_membro','id');
    }
}

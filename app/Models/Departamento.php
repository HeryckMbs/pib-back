<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'descricao',
        'objetivo',
        'backgroundUrl',
        'louvor',
        'id_lider',
        'id_igreja'
    ];

    public function members(){
        return $this->belongsToMany(Membro::class,'departamento_integrantes','id_departamento','id_membro','id');
    }

    public function functions(){
        return $this->hasMany(DepartamentoFuncao::class,'id_departamento');
    }
}

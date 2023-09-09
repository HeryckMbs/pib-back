<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrante extends Model
{
    use HasFactory;
    protected $fillable = ['nome','apelido','user_id'];

    public function equipes(){
       return $this->hasManyThrough(Equipe::class,IntegranteEquipe::class,'','id','','equipe_id');
    } 
}


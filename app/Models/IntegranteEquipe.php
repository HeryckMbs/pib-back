<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegranteEquipe extends Model
{
    use HasFactory;
    protected $fillable = ['equipe_id','integrante_id'];

    public function equipes(){
        return $this->hasMany(Equipe::class);
    }
}

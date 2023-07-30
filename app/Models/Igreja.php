<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Igreja extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'telefone',
        'id_pastor',
    ];

    public function members(){
        return $this->hasMany(Membro::class,'id_igreja');
    }

}

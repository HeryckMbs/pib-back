<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Culto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'dt_inicio',
        'dt_fim',
        'descricao',
        'coordenadas',
    ];

}

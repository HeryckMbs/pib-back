<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campanha extends Model
{
    use HasFactory;
    protected $fillable = ['id_departamento', 'nome', 'descricao', 'objetivo', 'dt_inicio', 'dt_fim'];

}

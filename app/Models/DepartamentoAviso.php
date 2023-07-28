<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentoAviso extends Model
{
    use HasFactory;
    protected $fillable = ['id_departamento', 'id_membro', 'nome', 'aviso', 'titulo'];

}

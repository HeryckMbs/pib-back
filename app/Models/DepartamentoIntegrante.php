<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentoIntegrante extends Model
{
    use HasFactory;
    protected $fillable = ['id_departamento', 'id_membro', 'id_funcao'];




}

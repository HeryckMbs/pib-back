<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoOracao extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'pedido',
        'telefone',
        'email',
        'id_membro',
    ];
}

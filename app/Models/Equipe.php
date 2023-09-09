<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Equipe extends Model
{
    use HasFactory, AuditableTrait;
    protected $fillable = [
        'nome',
        'codigo',
        'open',
        'descricao'
    ];

    public function integrantes()
    {
        return $this->hasManyThrough(Integrante::class,IntegranteEquipe::class,'','id','id','integrante_id');
    }
}
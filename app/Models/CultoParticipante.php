<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultoParticipante extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_culto',
        'id_membro',
    ];
}

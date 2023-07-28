<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membro extends Model
{
    protected $fillable = [
        'nome',
        'url_photo',
        'dt_aniversario',
        'user_id',
    ];
    use HasFactory;
}

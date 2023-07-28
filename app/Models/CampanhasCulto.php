<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampanhasCulto extends Model
{
    use HasFactory;
    protected $fillable = ['id_culto', 'id_campanha'];

}

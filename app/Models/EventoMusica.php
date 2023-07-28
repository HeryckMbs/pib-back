<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventoMusica extends Model
{
    use HasFactory;
    protected $fillable = ['id_evento', 'id_musica', 'ordem'];




}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cifra extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'tom', 'id_musica', 'urlNuvem'];




}


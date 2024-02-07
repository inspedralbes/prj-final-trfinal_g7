<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class listaSemanal extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'artista',
        'url',
        'urlPlayer'
    ];
}

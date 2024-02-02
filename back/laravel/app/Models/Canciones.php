<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canciones extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre',
        'artista',
        'url',
        'urlPlayer'
    ];
    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categorias', 'cancion_categoria', 'cancion_id', 'categoria_id');
    }
}

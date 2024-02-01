<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre'
    ];
    public function canciones()
    {
        return $this->belongsToMany('App\Models\Canciones', 'cancion_categoria');
    }
}

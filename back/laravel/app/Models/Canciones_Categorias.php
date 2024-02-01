<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canciones_Categorias extends Model
{
    use HasFactory;

public function categorias()
{
    return $this->belongsToMany(Categorias::class, 'canciones_categorias');
}

}

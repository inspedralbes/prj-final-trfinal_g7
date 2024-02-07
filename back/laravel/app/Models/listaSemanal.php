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
        'categoria_id',  
        'semana'  
    ];
   protected $table = 'lista_semanal';

}
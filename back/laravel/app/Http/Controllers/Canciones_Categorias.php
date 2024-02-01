<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canciones;
use App\Models\Categorias;

class Canciones_Categorias extends Controller
{
    public function assignCategories(Request $request)
    {
        $cancion = Canciones::find($request->input('idCancion'));
        $cancion->categorias()->sync($request->input('idsCategorias'));

        return response()->json(['message' => 'Categories assigned successfully']);
    }
}
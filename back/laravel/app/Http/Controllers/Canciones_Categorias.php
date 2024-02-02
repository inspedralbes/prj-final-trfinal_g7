<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canciones;

class Canciones_Categorias extends Controller
{
    public function mostrarCancionesConCategorias()
    {
        $canciones = Canciones::with('categorias')->get();

        return response()->json(['canciones' => $canciones]);
    }

    public function assignCategories(Request $request)
    {
        $cancion = Canciones::find($request->input('idCancion'));
        $cancion->categorias()->syncWithoutDetaching($request->input('idsCategorias'));

        return response()->json(['message' => 'Categories assigned successfully']);
    }
}
<?php

namespace App\Http\Controllers;
use App\Models\listaSemanal; 
use Illuminate\Http\Request;

class listaSemanalController extends Controller
{
    public function index()
    {
        $canciones = listaSemanal::all();
        return response()->json(['cancionesSemanales' => $canciones]);
    }

    
    public function store(Request $request)
    {
        $cancion = listaSemanal::create($request->all());
        return response()->json(['cancionesSemanales' => $cancion]);
    }

   
    public function update(Request $request, $id)
    {

    $request->validate([
        'nombre' => '',
        'artista' => '',
        'url' => '',
    ]);
    $cancion = listaSemanal::find($id);
   
        $cancion->nombre = $request->input('nombre', $cancion->nombre);
        $cancion->artista = $request->input('artista', $cancion->artista);
        $cancion->url = $request->input('url', $cancion->url);
        $cancion->urlPlayer = $request->input('urlPlayer', $cancion->urlPlayer);
        $cancion->save();

        return response()->json(['cancionesSemanales' => $cancion]);
    
    }
    
    public function destroy($id)
    {
        listaSemanal::destroy($id);
        return response()->json(['message' => 'Cancion deleted successfully']);
    }
}

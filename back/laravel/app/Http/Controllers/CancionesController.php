<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log; 
use Illuminate\Http\Request;
use App\Models\Canciones; 
use Illuminate\Log\LogManager;
class CancionesController extends Controller
{
    
    public function index()
    {
        $canciones = Canciones::all();
        return response()->json(['canciones' => $canciones]);
    }

    
    public function store(Request $request)
    {
        $cancion = Canciones::create($request->all());
        return response()->json(['cancion' => $cancion]);
    }

  
    public function show($id)
    {
        $cancion = Canciones::find($id);
        return response()->json(['cancion' => $cancion]);
    }

   
    public function update(Request $request, $id)
{
    
    

    $request->validate([
        'nombre' => '',
        'artista' => '',
        'url' => '',
    ]);
    $cancion = Canciones::find($id);
   
        $cancion->nombre = $request->input('nombre', $cancion->nombre);
        $cancion->artista = $request->input('artista', $cancion->artista);
        $cancion->url = $request->input('url', $cancion->url);
        $cancion->save();

        return response()->json(['cancion' => $cancion]);
    
}

    
    public function destroy($id)
    {
        Canciones::destroy($id);
        return response()->json(['message' => 'Cancion deleted successfully']);
    }
}
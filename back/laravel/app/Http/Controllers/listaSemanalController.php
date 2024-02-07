<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListaSemanal;

class ListaSemanalController extends Controller
{
    public function aceptarListaSemanal(Request $request)
    {
        $semana = date('W');
    
        foreach ($request->canciones as $cancion) {
            $lista = new ListaSemanal;
            $lista->nombre = $cancion['nombre'];
            $lista->artista = $cancion['artista'];
            $lista->url = $cancion['url'];
            $lista->urlPlayer = $cancion['urlPlayer'];
            $lista->categoria_id = $request->categoriaId;
            $lista->semana = $semana;
            $lista->save();
        }
    
        return response()->json(['message' => 'Lista semanal aceptada'], 201);
    }
}
?>
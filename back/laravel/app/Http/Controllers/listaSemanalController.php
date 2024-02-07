<?php 
namespace App\Http\Controllers;
use Carbon\Carbon;
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
            $lista->categoria_id = $request->categoriaId; 
            $lista->semana = $semana;
            $lista->save();
        }
    
        return response()->json(['message' => 'Lista semanal aceptada'], 201);
    }
    public function obtenerListaSemanal(Request $request)
    {
        $semanaActual = Carbon::now()->weekOfYear;
        $canciones = ListaSemanal::where('semana', $semanaActual)->get();

        return response()->json($canciones);
    }
}
?>
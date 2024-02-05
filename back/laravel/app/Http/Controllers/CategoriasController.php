<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Categorias; 
class CategoriasController extends Controller
{
    public function index()
    {
        $categoria = Categorias::all();
        return response()->json(['categoria' => $categoria]);
    }

    
    public function store(Request $request)
    {
        $categoria = Categorias::create($request->all());
        return response()->json(['categoria' => $categoria]);
    }

  
    public function show($id)
    {
        $categoria = Categorias::find($id);
        return response()->json(['categoria' => $categoria]);
    }

   
    public function update(Request $request, $id)
    {

    $request->validate([
        'nombre' => '',  
    ]);

        $categoria = Categorias::find($id);
        $categoria->nombre = $request->input('nombre', $categoria->nombre);
        $categoria->save();

        return response()->json(['categoria' => $categoria]);
    
    }
    public function categoriaPorId($id)
    {
        $categoria = Categorias::find($id);
    
        if (!$categoria) {
            return response()->json(['error' => 'Categoria not found'], 404);
        }
    
        return response()->json($categoria);
    }
    
    public function destroy($id)
    {
        Categorias::destroy($id);
        return response()->json(['message' => 'Categoria deleted successfully']);
    }
}

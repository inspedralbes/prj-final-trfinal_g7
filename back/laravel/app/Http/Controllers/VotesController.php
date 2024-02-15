<?php

namespace App\Http\Controllers;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class VotesController extends Controller
{
    public function vote(Request $request)
    {
        $user = auth('sanctum')->user();
        if (!$user) {
            \Log::warning('El usuario no está autenticado');
            return response()->json(['error' => 'USUARIO NO AUTORIZADO'], 401);
        }
        $cancionId = $request->input('cancionId');
    
        
        $existingVote = Vote::where('user_id', $user->id)->where('cancion_id', $cancionId)->first();
        if ($existingVote) {
            return response()->json(['message' => 'Ya has votado por esta canción'], 400);
        }
    
        // Comprueba si el usuario ya ha votado 7 veces
        $voteCount = Vote::where('user_id', $user->id)->count();
        if ($voteCount >= 7) {
            return response()->json(['message' => 'Ya has votado 7 veces'], 400);
        }
        
        $vote = new Vote;
        $vote->user_id = $user->id;
        $vote->cancion_id = $cancionId;
        $vote->save();
    
        return response()->json(['message' => 'Voto registrado con éxito']);
    }
    
}
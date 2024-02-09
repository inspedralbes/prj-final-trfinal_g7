<?php

namespace App\Http\Controllers;
use App\Models\Vote;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function vote(Request $request)
    {
        $user = $request->user();
        $cancionId = $request->input('cancionId');
    
        // Comprueba si el usuario ya ha votado por esta canción
        $existingVote = Vote::where('user_id', $user->id)->where('cancion_id', $cancionId)->first();
        if ($existingVote) {
            return response()->json(['message' => 'Ya has votado por esta canción'], 400);
        }
    
        // Comprueba si el usuario ya ha votado 7 veces
        $voteCount = Vote::where('user_id', $user->id)->count();
        if ($voteCount >= 7) {
            return response()->json(['message' => 'Ya has votado 7 veces'], 400);
        }
    
        // Crea un nuevo voto
        $vote = new Vote;
        $vote->user_id = $user->id;
        $vote->cancion_id = $cancionId;
        $vote->save();
    
        return response()->json(['message' => 'Voto registrado con éxito']);
    }
}
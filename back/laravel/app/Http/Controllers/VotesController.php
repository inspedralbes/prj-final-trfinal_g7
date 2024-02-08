<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class VotesController extends Controller
{
    public function vote(Request $request)
    {
        $user = $request->user();
        $songId = $request->input('songId');
    
        // Comprueba si el usuario ya ha votado por esta canción
        $existingVote = Vote::where('user_id', $user->id)->where('song_id', $songId)->first();
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
        $vote->song_id = $songId;
        $vote->save();
    
        return response()->json(['message' => 'Voto registrado con éxito']);
    }
}

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
    
        
        $vote = new Vote;
        $vote->user_id = $user->id;
        $vote->cancion_id = $cancionId;
        $vote->save();
    
        return response()->json(['message' => 'Voto registrado con éxito']);
    }
    public function getVotesForSong(Request $request, $cancionId)
    {
        $votes = Vote::where('cancion_id', $cancionId)->count();

        return response()->json(['votes' => $votes]);
    }
    public function hasVotedForSong(Request $request)
    {
    $user = auth('sanctum')->user();
    if (!$user) {
        \Log::warning('El usuario no está autenticado');
        return response()->json(['error' => 'USUARIO NO AUTORIZADO'], 401);
    }
    $userId = $user->id;
    $cancionId = $request->input('cancion_id');

    $vote = Vote::where('user_id', $userId)->where('cancion_id', $cancionId)->first();

    $hasVoted = $vote ? true : false;

    return response()->json(['has_voted' => $hasVoted]);
    }
}
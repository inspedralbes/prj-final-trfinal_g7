<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the vote.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the cancion that the vote is for.
     */
    public function cancion()
    {
        return $this->belongsTo(Cancion::class);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
{
    $token = $request->bearerToken();
    Log::info('Handle-Token: ' . $token);
    if (Auth::guard('sanctum')->check()) {
        $user = Auth::guard('sanctum')->user();
        Log::info('Handle-User: ', ['user' => $user]); // Aquí se registra el usuario
        return $next($request);
    }

    Log::info('Handle-authenticated', ['message' => 'El usuario no está autenticado']);
    
    $ret = ['message' => 'Unauthorized',
            'custom' => 'El usuario no está autenticado',
            'token' => $token,
            ];

    return response()->json($ret, 401);
}
}
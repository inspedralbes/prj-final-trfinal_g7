<?php

namespace App\Http\Middleware;

use Closure;

class Cors{
    private $headers = [
        'Access-Control-Allow-Origin' => 'http://localhost:3000',
        'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization, X-Requested-With',
        'Access-Control-Allow-Credentials' => 'true',
    ];
    public function handle($request, Closure $next)
{
    if ($request->isMethod('OPTIONS')) {
        return response()->json('{"method":"OPTIONS"}', 200, $this->headers);
    }

    $response = $next($request);
    foreach($this->headers as $key => $value) {
        $response->header($key, $value);
    }

    return $response;
}
}
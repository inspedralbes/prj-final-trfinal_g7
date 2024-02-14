<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
    /**public function handle($request, Closure $next, $role)
{
    if (! $request->user() || ! $request->user()->hasRole($role)) {
        abort(403);
    }

    return $next($request);
} */
}

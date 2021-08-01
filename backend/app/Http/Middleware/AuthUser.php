<?php

namespace App\Http\Middleware;

use Closure;

class AuthUser
{
    public function handle($request, Closure $next)
    {
        error_if(!currentUser(), 'UNAUTHORIZED_ACTION');

        return $next($request);
    }
}

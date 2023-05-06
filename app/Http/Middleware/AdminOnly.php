<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdminOnly extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->user()->is_admin === 1) {
            return $next($request);
        }

        abort(ResponseAlias::HTTP_FORBIDDEN);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountActive
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()->is_active) {
            abort(423);
        }

        return $next($request);
    }
}

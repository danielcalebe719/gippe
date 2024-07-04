<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotCliente
{
    public function handle($request, Closure $next, $guard = 'cliente')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('/website/login');
        }

        return $next($request);
    }
}

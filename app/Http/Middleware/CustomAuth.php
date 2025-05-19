<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está logueado
        if (!session()->has('logged_user')) {
            return redirect('/')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }

        return $next($request);
    }
}

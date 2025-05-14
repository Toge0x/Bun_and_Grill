<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
      {
        $user = Auth::user();
        
        if (!$user || $user->email !== 'pacop@gmail.com') {
            abort(403, 'Solo admins pueden entrar.');
        }

        return $next($request);
    }
}

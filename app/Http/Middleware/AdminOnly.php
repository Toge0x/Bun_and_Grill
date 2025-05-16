<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        $user = session('logged_user');
        if (! $user) {
            return redirect()->route('home');
        }

        if (($user['email'] ?? null) !== 'pacop@gmail.com') {
            abort(403, 'No tienes permiso para acceder.');
        }

        
        return $next($request);
    }
}

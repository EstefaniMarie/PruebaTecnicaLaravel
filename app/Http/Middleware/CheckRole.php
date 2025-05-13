<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (auth()->check()) {
            $userRoleId = auth()->user()->roles_id;
    
            foreach ($roles as $role) {
                if ($userRoleId == $role) {
                    return $next($request);
                }
            }
        }

        return redirect('home')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}




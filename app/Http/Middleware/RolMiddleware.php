<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        $usuario = Auth::user();

        if (!$usuario || !$usuario->hasRole($role)) {
            abort(403, 'No tiene el rol requerido.');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $permiso)
    {
        $usuario = Auth::user();

        if (!$usuario || !$usuario->tienePermiso($permiso)) {
            abort(403, 'No tiene permiso para realizar esta acción.');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, string $permiso)
    {
        if (!Auth::check() || !Auth::user()->tienePermiso($permiso)) {
            abort(403);
        }

        return $next($request);
    }
}

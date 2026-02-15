<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'rol' => \App\Http\Middleware\RolMiddleware::class,
            'permiso' => \App\Http\Middleware\PermissionMiddleware::class,
        ]);

    })

    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (\Throwable $e, $request) {

            if ($request->is('api/*')) {

                // 🔐 No autenticado (401)
                if ($e instanceof AuthenticationException) {
                    return response()->json([
                        'success' => false,
                        'code' => 'AUTH_NOT_AUTHENTICATED',
                        'message' => 'No autenticado',
                        'errors' => null,
                    ], 401);
                }

                // 🔹 Error de validación
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'success' => false,
                        'code' => 'VALIDATION_ERROR',
                        'message' => 'Error de validación',
                        'errors' => $e->errors(),
                    ], 422);
                }

                // 🔹 Error HTTP (404, 403, etc.)
                if ($e instanceof HttpExceptionInterface) {
                    return response()->json([
                        'success' => false,
                        'code' => 'HTTP_ERROR',
                        'message' => $e->getMessage() ?: 'Error HTTP',
                        'errors' => null,
                    ], $e->getStatusCode());
                }

                // 🔥 Error no controlado
                Log::error('Error no controlado API', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'url' => $request->fullUrl(),
                    'ip' => $request->ip(),
                    'user_id' => optional($request->user())->id,
                ]);

                return response()->json([
                    'success' => false,
                    'code' => 'SERVER_ERROR',
                    'message' => 'Error interno del servidor',
                    'errors' => null,
                ], 500);
            }

            return null;
        });

    })

    ->create();

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        $usuario = \App\Models\Usuario::where('email', $request->email)->first();

        // Usuario no existe
        if (!$usuario) {
            return back()->withErrors([
                'email' => 'El usuario no existe.',
            ]);
        }

        // Usuario bloqueado
        if ($usuario->bloqueado_hasta && Carbon::parse($usuario->bloqueado_hasta)->isFuture()) {

            $fechaBloqueo = Carbon::parse($usuario->bloqueado_hasta);

            $tiempoRestante = Carbon::now()->diffForHumans($fechaBloqueo, [
                'parts' => 2,      // máximo 2 unidades (ej: 1 hora 20 minutos)
                'short' => true,   // formato corto (1h 20m)
            ]);

            return response()->json([
                'success' => false,
                'message' => "Cuenta bloqueada por $tiempoRestante más (hasta " .
                    $fechaBloqueo->format('d/m/Y H:i') . ")"
            ], 403);
        }

        // Contraseña incorrecta
        if (!\Illuminate\Support\Facades\Hash::check($request->password, $usuario->password)) {
            return back()->withErrors([
                'email' => 'Contraseña incorrecta.',
            ]);
        }

        // Login correcto
        Auth::login($usuario, $request->boolean('remember'));
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}
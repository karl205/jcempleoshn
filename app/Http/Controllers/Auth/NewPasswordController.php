<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class NewPasswordController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.reset-password', [
            'token' => $request->route('token'),
            'email' => $request->email,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:10',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ], [
            'password.regex' => 'La contraseña debe contener al menos una mayúscula y un número.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($usuario, $password) {
                $usuario->password = Hash::make($password);
                $usuario->save();

                event(new PasswordReset($usuario));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')
                ->with('status', 'Contraseña restablecida correctamente. Ya puedes iniciar sesión.')
            : back()->withErrors([
                'email' => 'El enlace de restablecimiento no es válido o ya expiró.',
            ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class NewPasswordController extends Controller
{
    /**
     * Muestra el formulario para colocar nueva contraseña.
     */
    public function create(Request $request)
    {
        return view('auth.reset-password', [
            'request' => $request,
            'token' => $request->route('token'),
            'email' => $request->email,
        ]);
    }

    /**
     * Procesa y guarda la nueva contraseña.
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required', 
                'confirmed', 
                'min:10',
                'regex:/[A-Z]/',    // Al menos una mayúscula
                'regex:/[0-9]/',    // Al menos un número
            ],
        ], [
            'password.regex' => 'La contraseña debe contener al menos una mayúscula y un número.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}

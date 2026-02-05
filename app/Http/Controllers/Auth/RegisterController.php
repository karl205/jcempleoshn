<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $usuario = Usuario::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Enviar correo de verificacion (NO iniciar sesion)
        $usuario->sendEmailVerificationNotification();

        return redirect()->route('login')
        ->with('success', 'Cuenta creada. Revisa tu correo para verificarla antes de iniciar sesión.');
    }
}

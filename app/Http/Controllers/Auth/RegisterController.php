<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Mostrar formulario
    public function create()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function store(RegisterRequest $request)
{
    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Se envía el correo, pero NO se inicia sesión
    $user->sendEmailVerificationNotification();

    return redirect()->route('login')
        ->with('success', 'Cuenta creada. Revisa tu correo para verificarla antes de iniciar sesión.');
}

}

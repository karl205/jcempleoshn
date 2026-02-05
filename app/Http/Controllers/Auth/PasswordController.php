<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'password_actual' => ['required'],
            'password' => ['required', 'confirmed', 'min:10'],
        ]);

        // Verificar contraseña actual
        if (! Hash::check($validated['password_actual'], $request->user()->password)) {
            return back()->withErrors([
                'password_actual' => 'La contrasena actual no es correcta.',
            ], 'updatePassword');
        }

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-actualizada');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Support\ApiResponse;

class ProfileSecurityController extends Controller
{
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_actual' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = $request->user();

        // validar contraseña actual
        if (!Hash::check($request->password_actual, $user->password)) {
            return ApiResponse::error(
                'La contraseña actual no es correcta.',
                'INVALID_PASSWORD',
                422
            );
        }

        // actualizar
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return ApiResponse::success(
            null,
            'Contraseña actualizada correctamente.',
            'PASSWORD_UPDATED'
        );
    }
}
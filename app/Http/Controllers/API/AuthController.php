<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $result = DB::select('CALL sp_usuario_por_email(?)', [
            $request->email,
        ]);

        if (empty($result)) {
            Log::warning('Login failed - usuario no encontrado', [
                'email' => $request->email,
            ]);

            return ApiResponse::error(
                'Credenciales inválidas',
                'AUTH_INVALID_CREDENTIALS',
                401
            );
        }

        $user = Usuario::find($result[0]->id);

        if (! $user || ! Hash::check($request->password, $user->password)) {

            Log::warning('Login failed - password incorrecto', [
                'user_id' => $result[0]->id,
            ]);

            return ApiResponse::error(
                'Credenciales inválidas',
                'AUTH_INVALID_CREDENTIALS',
                401
            );
        }

        $token = $user->createToken(
            'api-token',
            ['*'] // temporal mientras definimos permisos finos
        )->plainTextToken;

        Log::info('Login exitoso', [
            'user_id' => $user->id,
        ]);

        return ApiResponse::success(
            [
                'user' => $user,
                'token' => $token,
            ],
            'Inicio de sesión exitoso',
            'AUTH_LOGIN_SUCCESS'
        );
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if (! $user || ! $request->user()->currentAccessToken()) {
            return ApiResponse::error(
                'No autenticado',
                'AUTH_NOT_AUTHENTICATED',
                401
            );
        }

        $request->user()->currentAccessToken()->delete();

        Log::info('Logout exitoso', [
            'user_id' => $user->id,
        ]);

        return ApiResponse::success(
            null,
            'Sesión cerrada correctamente',
            'AUTH_LOGOUT_SUCCESS'
        );
    }

    public function me(Request $request)
    {
        $user = $request->user();
    
        return ApiResponse::success(
            [
                'user' => $user
            ],
            'Usuario autenticado',
            'AUTH_ME_SUCCESS'
        );
    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
    
        $user = $request->user();
    
        // Verificar contraseña actual
        if (! Hash::check($request->current_password, $user->password)) {
    
            Log::warning('Cambio de contraseña fallido - contraseña actual incorrecta', [
                'user_id' => $user->id,
            ]);
    
            return ApiResponse::error(
                'La contraseña actual es incorrecta',
                'AUTH_INVALID_CURRENT_PASSWORD',
                422
            );
        }
    
        // Actualizar contraseña
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        // 🔥 Revocar todos los tokens
        $user->tokens()->delete();
    
        Log::info('Contraseña actualizada y sesiones revocadas', [
            'user_id' => $user->id,
        ]);
    
        return ApiResponse::success(
            null,
            'Contraseña actualizada correctamente. Inicie sesión nuevamente.',
            'AUTH_PASSWORD_CHANGED'
        );
    }


}

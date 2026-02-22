<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login de usuario",
     *     tags={"Autenticación"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="admin@correo.com"),
     *             @OA\Property(property="password", type="string", example="123456")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Login exitoso"),
     *     @OA\Response(response=401, description="Credenciales inválidas")
     * )
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $result = DB::select('CALL usp_autenticacion_login(?)', [
            $request->email,
        ]);
    
        if (empty($result)) {
            return ApiResponse::error(
                'Credenciales inválidas',
                'AUTH_INVALID_CREDENTIALS',
                401
            );
        }
    
        if (!$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message,
                'AUTH_INVALID_CREDENTIALS',
                401
            );
        }
    
        $userData = json_decode($result[0]->data);
    
        // Password incorrecto
        if (!Hash::check($request->password, $userData->password)) {
    
            DB::select('CALL usp_autenticacion_intento_fallido(?)', [
                $userData->id
            ]);
    
            return ApiResponse::error(
                'Credenciales inválidas',
                'AUTH_INVALID_CREDENTIALS',
                401
            );
        }
    
        $user = Usuario::find($userData->id);
    
        $token = $user->createToken('api-token', ['*'])->plainTextToken;
    
        // Login exitoso
        DB::select('CALL usp_autenticacion_registrar_login(?)', [
            $user->id
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

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Cerrar sesión",
     *     tags={"Autenticación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Logout exitoso"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function logout(Request $request)
    {
        $user = $request->user();

        if (!$user || !$user->currentAccessToken()) {
            return ApiResponse::error(
                'No autenticado',
                'AUTH_NOT_AUTHENTICATED',
                401
            );
        }

        $request->user()->currentAccessToken()->delete();

        DB::select('CALL usp_autenticacion_registrar_logout(?)', [
            $user->id
        ]);

        Log::info('Logout exitoso', [
            'user_id' => $user->id,
        ]);

        return ApiResponse::success(
            null,
            'Sesión cerrada correctamente',
            'AUTH_LOGOUT_SUCCESS'
        );
    }

    /**
     * @OA\Get(
     *     path="/api/me",
     *     summary="Obtener usuario autenticado",
     *     tags={"Autenticación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Usuario autenticado"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function me(Request $request)
    {
        $user = $request->user();

        $result = DB::select('CALL usp_autenticacion_obtener_usuario(?)', [
            $user->id
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                'No autenticado',
                'AUTH_NOT_AUTHENTICATED',
                401
            );
        }

        return ApiResponse::success(
            json_decode($result[0]->data),
            'Usuario autenticado',
            'AUTH_ME_SUCCESS'
        );
    }

    /**
     * @OA\Post(
     *     path="/api/change-password",
     *     summary="Cambiar contraseña",
     *     tags={"Autenticación"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Contraseña actualizada"),
     *     @OA\Response(response=422, description="Error de validación"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return ApiResponse::error(
                'La contraseña actual es incorrecta',
                'AUTH_INVALID_CURRENT_PASSWORD',
                422
            );
        }

        $hashedPassword = Hash::make($request->new_password);

        DB::select('CALL usp_autenticacion_cambiar_clave(?, ?)', [
            $user->id,
            $hashedPassword
        ]);

        $user->tokens()->delete();

        Log::info('Contraseña actualizada', [
            'user_id' => $user->id,
        ]);

        return ApiResponse::success(
            null,
            'Contraseña actualizada correctamente. Inicie sesión nuevamente.',
            'AUTH_PASSWORD_CHANGED'
        );
    }

    /**
    * @OA\Post(
    *     path="/api/register",
    *     summary="Registro de usuario postulante",
    *     tags={"Autenticación"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"nombre","apellido","email","password","password_confirmation"},
    *             @OA\Property(property="nombre", type="string", example="Juan"),
    *             @OA\Property(property="apellido", type="string", example="Pérez"),
    *             @OA\Property(property="email", type="string", example="juan@email.com"),
    *             @OA\Property(property="password", type="string", example="Password123"),
    *             @OA\Property(property="password_confirmation", type="string", example="Password123")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Usuario creado correctamente"
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Error de validación o correo duplicado"
    *     )
    * )
    */
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $hashedPassword = Hash::make($request->password);

        $rolPostulante = 2; // ID real del rol postulante
        $ejecutorId = auth()->id() ?? 1;

        $result = DB::select('CALL usp_usuario_crear(?, ?, ?, ?, ?, ?)', [
            $request->nombre,
            $request->apellido,
            $request->email,
            $hashedPassword,
            $rolPostulante,
            $ejecutorId
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al crear usuario.',
                'USER_CREATE_ERROR',
                422
            );
        }

        return ApiResponse::success(
            json_decode($result[0]->data),
            'Usuario creado correctamente.',
            'USER_CREATED'
        );
    }
}
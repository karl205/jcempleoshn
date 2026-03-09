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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;

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
    
        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                'Credenciales inválidas',
                'AUTH_INVALID_CREDENTIALS',
                401
            );
        }
    
        $userData = json_decode($result[0]->data);
    
        // Validar contraseña
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
    
        // Verificar email
        if (is_null($userData->email_verified_at)) {
            return ApiResponse::error(
                'Debes verificar tu correo antes de iniciar sesión.',
                'EMAIL_NOT_VERIFIED',
                403
            );
        }
    
        $user = Usuario::find($userData->id);
    
        $token = $user->createToken('api-token', ['*'])->plainTextToken;
    
        // Registrar login exitoso
        DB::select('CALL usp_autenticacion_registrar_login(?)', [
            $user->id
        ]);
    
        // 🔐 Obtener permisos del usuario
        $permisos = DB::table('usuarios_roles as ur')
            ->join('roles_permisos as rp', 'rp.rol_id', '=', 'ur.rol_id')
            ->join('permisos as p', 'p.id', '=', 'rp.permiso_id')
            ->where('ur.usuario_id', $user->id)
            ->pluck('p.nombre')
            ->toArray();
    
        return ApiResponse::success(
        [
            'user' => $user,
            'roles' => $user->getRoles(),
            'permisos' => $permisos,
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

        $data = json_decode($result[0]->data) ?? new \stdClass();
        $data->roles = $user->getRoles();

        return ApiResponse::success(
            $data,
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
    *             @OA\Property(property="password", type="string", example="Password123!"),
    *             @OA\Property(property="password_confirmation", type="string", example="Password123!")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Usuario creado correctamente, correo de verificación enviado"
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

        $rolPostulante = 2;
        $ejecutorId = auth()->id() ?? 1;

        // 1️⃣ Crear usuario vía SP
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

       $usuario = json_decode($result[0]->data);

        $token = (string) Str::uuid();
        $expira = now()->addMinutes(30)->format('Y-m-d H:i:s');

        $resultVerificacion = DB::select(
            'CALL usp_usuario_generar_verificacion(?, ?, ?)',
            [
                $usuario->usuario_id,
                $token,
                $expira
            ]
        );
        
        // 4️⃣ Construir enlace
        $frontendUrl = config('app.frontend_url');
        $link = "{$frontendUrl}/verify-email?token={$token}";

        // 5️⃣ Enviar correo HTML profesional
        Mail::to($request->email)
            ->send(new VerifyEmailMail($token));

        return ApiResponse::success(
            null,
            'Usuario creado correctamente. Revisa tu correo para verificar tu cuenta.',
            'USER_CREATED'
        );
    }

    /**
     * @OA\Get(
     *     path="/api/verify-email",
     *     summary="Verifica el correo del usuario",
     *     tags={"Autenticación"},
     *     @OA\Parameter(
     *         name="token",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Correo verificado correctamente"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Token inválido o expirado"
     *     )
     * )
     */
    public function verifyEmail(Request $request)
    {
        $token = $request->token;

        $result = DB::select('CALL usp_usuario_verificar_email(?)', [$token]);

        if (!empty($result) && $result[0]->success) {
            return ApiResponse::success(
                null,
                'Correo verificado correctamente.',
                'EMAIL_VERIFIED'
            );
        }

        return ApiResponse::error(
            'Token inválido o expirado.',
            'INVALID_TOKEN',
            400
        );
    }

    /**
    * @OA\Post(
    *     path="/api/resend-verification",
    *     summary="Reenviar correo de verificación",
    *     tags={"Autenticación"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"email"},
    *             @OA\Property(property="email", type="string", example="usuario@email.com")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Correo reenviado correctamente"
    *     ),
    *     @OA\Response(
    *         response=400,
    *         description="Correo ya verificado"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Usuario no encontrado"
    *     )
    * )
    */
    public function resendVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario) {
            return ApiResponse::error(
                'Usuario no encontrado.',
                'USER_NOT_FOUND',
                404
            );
        }

        if (!is_null($usuario->email_verified_at)) {
            return ApiResponse::error(
                'El correo ya está verificado.',
                'EMAIL_ALREADY_VERIFIED',
                400
            );
        }

        // 🔹 Invalidar tokens anteriores
        DB::statement('CALL usp_usuario_invalidar_tokens(?)', [
            $usuario->id
        ]);

        // 🔹 Generar nuevo token
        $token = (string) Str::uuid();
        $expira = now()->addMinutes(30)->format('Y-m-d H:i:s');

        DB::select('CALL usp_usuario_generar_verificacion(?, ?, ?)', [
            $usuario->id,
            $token,
            $expira
        ]);

        // 🔹 Enviar correo
        Mail::raw(
            "Confirma tu cuenta aquí: http://localhost:5173/verify-email?token=$token",
            function ($message) use ($usuario) {
                $message->to($usuario->email)
                        ->subject('Verifica tu cuenta - JC Empleos');
            }
        );

        return ApiResponse::success(
            null,
            'Correo de verificación reenviado.',
            'EMAIL_RESENT'
        );
    }

    /**
    * @OA\Post(
    *     path="/api/forgot-password",
    *     summary="Enviar código de recuperación de contraseña",
    *     tags={"Autenticación"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"email"},
    *             @OA\Property(property="email", type="string", example="usuario@email.com")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Código enviado correctamente"
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Correo no registrado"
    *     )
    * )
    */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $codigo = rand(100000, 999999);

        $result = DB::select('CALL usp_autenticacion_generar_codigo_reset(?, ?)', [
            $request->email,
            $codigo
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                'El correo no está registrado.',
                'EMAIL_NOT_FOUND',
                404
            );
        }

        Mail::raw("Tu código de recuperación es: {$codigo}", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Código de recuperación - JC Empleos');
        });

        return ApiResponse::success(
            null,
            'Código enviado al correo.',
            'RESET_CODE_SENT'
        );
    }

    /**
    * @OA\Post(
    *     path="/api/verify-code",
    *     summary="Verificar código de recuperación",
    *     tags={"Autenticación"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"email","code"},
    *             @OA\Property(property="email", type="string", example="usuario@email.com"),
    *             @OA\Property(property="code", type="string", example="123456")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Código verificado correctamente"
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Código inválido"
    *     )
    * )
    */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required'
        ]);

        $result = DB::select('CALL usp_autenticacion_verificar_codigo_reset(?, ?)', [
            $request->email,
            $request->code
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                'Código inválido.',
                'INVALID_CODE',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Código verificado correctamente.',
            'CODE_VERIFIED'
        );
    }

    /**
    * @OA\Post(
    *     path="/api/reset-password",
    *     summary="Restablecer contraseña",
    *     tags={"Autenticación"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(
    *             required={"email","password","password_confirmation"},
    *             @OA\Property(property="email", type="string", example="usuario@email.com"),
    *             @OA\Property(property="password", type="string", example="Password123!"),
    *             @OA\Property(property="password_confirmation", type="string", example="Password123!")
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Contraseña actualizada correctamente"
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Error de validación o fallo en actualización"
    *     )
    * )
    */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        $hashedPassword = Hash::make($request->password);

        $result = DB::select('CALL usp_autenticacion_reset_password(?, ?)', [
            $request->email,
            $hashedPassword
        ]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                'No se pudo actualizar la contraseña.',
                'RESET_FAILED',
                422
            );
        }

        return ApiResponse::success(
            null,
            'Contraseña actualizada correctamente.',
            'PASSWORD_UPDATED'
        );
    }
}
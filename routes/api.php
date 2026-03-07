<?php

use App\Http\Controllers\API\Admin\AdminUsuarioController;
use App\Http\Controllers\API\Admin\AdminPermisoController;
use App\Http\Controllers\API\Admin\AdminRolController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PerfilController;
use App\Http\Controllers\API\PerfilCvController;
use App\Http\Controllers\API\PerfilEducacionController;
use App\Http\Controllers\API\PerfilExperienciaController;
use App\Http\Controllers\API\PerfilIdiomaController;
use App\Http\Controllers\API\PlazaController;
use App\Http\Controllers\API\UsuarioController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::post('verify-email', [AuthController::class, 'verifyEmail']);
Route::post('resend-verification', [AuthController::class, 'resendVerification']);

Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('verify-code', [AuthController::class, 'verifyCode']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

Route::get('ping', function () {
    return response()->json([
        'success' => true,
        'message' => 'API conectada correctamente',
    ]);
});


/*
|--------------------------------------------------------------------------
| Rutas administrativas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', 'rol:admin'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Usuarios (Admin)
        |--------------------------------------------------------------------------
        */

        Route::get('usuarios', [AdminUsuarioController::class, 'index']);
        Route::post('usuarios', [AdminUsuarioController::class, 'store']);
        Route::put('usuarios/{id}', [AdminUsuarioController::class, 'update']);
        Route::patch('usuarios/{id}/desactivar', [AdminUsuarioController::class, 'deactivate']);


        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        Route::get('roles', [AdminRolController::class, 'index']);
        Route::post('roles', [AdminRolController::class, 'store']);
        Route::put('roles/{id}', [AdminRolController::class, 'update']);
        Route::patch('roles/{id}/desactivar', [AdminRolController::class, 'deactivate']);


        /*
        |--------------------------------------------------------------------------
        | Permisos (CRUD)
        |--------------------------------------------------------------------------
        */

        Route::get('permisos', [AdminPermisoController::class, 'index']);
        Route::post('permisos', [AdminPermisoController::class, 'store']);
        Route::put('permisos/{id}', [AdminPermisoController::class, 'update']);
        Route::patch('permisos/{id}/desactivar', [AdminPermisoController::class, 'deactivate']);


        /*
        |--------------------------------------------------------------------------
        | Permisos por Rol (Matriz de permisos)
        |--------------------------------------------------------------------------
        */

        Route::get('permisos-roles', [AdminPermisoController::class, 'permisosRoles']);
        Route::post('permisos-roles', [AdminPermisoController::class, 'guardarPermisoRol']);

    });


/*
|--------------------------------------------------------------------------
| Rutas autenticadas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Autenticación
    |--------------------------------------------------------------------------
    */

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::post('change-password', [AuthController::class, 'changePassword']);


    /*
    |--------------------------------------------------------------------------
    | Usuario
    |--------------------------------------------------------------------------
    */

    Route::put('usuarios/{id}', [UsuarioController::class, 'update']);


    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */

    Route::get('perfil', [PerfilController::class, 'show']);
    Route::put('perfil', [PerfilController::class, 'update']);

    Route::get('perfil/cv', [PerfilCvController::class, 'show']);


    /*
    |--------------------------------------------------------------------------
    | Educación
    |--------------------------------------------------------------------------
    */

    Route::get('perfil/educacion', [PerfilEducacionController::class, 'index']);
    Route::post('perfil/educacion', [PerfilEducacionController::class, 'store']);
    Route::put('perfil/educacion/{id}', [PerfilEducacionController::class, 'update']);
    Route::delete('perfil/educacion/{id}', [PerfilEducacionController::class, 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | Experiencia
    |--------------------------------------------------------------------------
    */

    Route::get('perfil/experiencia', [PerfilExperienciaController::class, 'index']);
    Route::post('perfil/experiencia', [PerfilExperienciaController::class, 'store']);
    Route::put('perfil/experiencia/{id}', [PerfilExperienciaController::class, 'update']);
    Route::delete('perfil/experiencia/{id}', [PerfilExperienciaController::class, 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | Idiomas
    |--------------------------------------------------------------------------
    */

    Route::get('perfil/idioma', [PerfilIdiomaController::class, 'index']);
    Route::post('perfil/idioma', [PerfilIdiomaController::class, 'store']);
    Route::put('perfil/idioma/{id}', [PerfilIdiomaController::class, 'update']);
    Route::delete('perfil/idioma/{id}', [PerfilIdiomaController::class, 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | Plazas
    |--------------------------------------------------------------------------
    */

    Route::get('plazas', [PlazaController::class, 'index']);
    Route::get('plazas/{id}', [PlazaController::class, 'show']);

    Route::post('plazas', [PlazaController::class, 'store'])
        ->middleware('permiso:plazas.crear');

});
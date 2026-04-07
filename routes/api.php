<?php

use App\Http\Controllers\API\Admin\AdminMenuController;
use App\Http\Controllers\API\Admin\AdminPermisoController;
use App\Http\Controllers\API\Admin\AdminRolController;
use App\Http\Controllers\API\Admin\AdminUsuarioController;
use App\Http\Controllers\API\Admin\AdminTestimonioController;
use App\Http\Controllers\API\Admin\BitacoraController;
use App\Http\Controllers\API\Admin\BackupController;
use App\Http\Controllers\API\Admin\CategoriaLaboralController;
use App\Http\Controllers\API\Admin\CatalogosController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CatalogoController;
use App\Http\Controllers\API\PerfilController;
use App\Http\Controllers\API\ProfileSecurityController;
use App\Http\Controllers\API\PerfilCvController;
use App\Http\Controllers\API\PerfilEducacionController;
use App\Http\Controllers\API\PerfilExperienciaController;
use App\Http\Controllers\API\PerfilIdiomaController;
use App\Http\Controllers\API\PlazaController;
use App\Http\Controllers\API\ProfileApiController;
use App\Http\Controllers\API\PublicPlazaController;
use App\Http\Controllers\API\UsuarioController;
use App\Http\Controllers\API\TestimonioController;
use App\Http\Controllers\API\PostulacionController;
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

Route::get('plazas/ultimas', [PlazaController::class, 'ultimas']);
Route::get('/testimonios', [TestimonioController::class, 'index']);

Route::get('/admin/backups/{file}', [BackupController::class, 'download']);

/*
|--------------------------------------------------------------------------
| Catálogos públicos (NO requieren autenticación)
|--------------------------------------------------------------------------
*/

Route::get('catalogos/ciudades', [CatalogoController::class, 'ciudades']);
Route::get('catalogos/cargos', [CatalogoController::class, 'cargos']);
Route::get('catalogos/categorias', [CatalogoController::class, 'categorias']);
Route::get('catalogos/actividades', [CatalogoController::class, 'actividades']);
Route::get('catalogos/niveles-educativos', [CatalogoController::class, 'nivelesEducativos']);
Route::get('catalogos/sexos', [CatalogoController::class, 'sexos']);
Route::get('catalogos/departamentos', [CatalogoController::class, 'departamentos']);
Route::get('catalogos/paises', [CatalogoController::class, 'paises']);

/*
|--------------------------------------------------------------------------
| Plazas públicas
|--------------------------------------------------------------------------
*/
Route::prefix('public')->group(function () {
    Route::get('plazas', [PublicPlazaController::class, 'index']);
    Route::get('plazas/ultimas', [PublicPlazaController::class, 'ultimas']);
    Route::get('plazas/{id}', [PublicPlazaController::class, 'show']);
});

/*
|--------------------------------------------------------------------------
| Rutas administrativas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Menú dinámico
        |--------------------------------------------------------------------------
        */

        Route::get('menu', [AdminMenuController::class, 'index'])
            ->middleware('permiso:ver_dashboard');

        /*
        |--------------------------------------------------------------------------
        | Usuarios
        |--------------------------------------------------------------------------
        */

        Route::get('usuarios', [AdminUsuarioController::class, 'index'])
            ->middleware('permiso:usuarios.ver');

        Route::post('usuarios', [AdminUsuarioController::class, 'store'])
            ->middleware('permiso:usuarios.crear');

        Route::put('usuarios/{id}', [AdminUsuarioController::class, 'update'])
            ->middleware('permiso:usuarios.editar');

        Route::patch('usuarios/{id}/desactivar', [AdminUsuarioController::class, 'deactivate'])
            ->middleware('permiso:usuarios.eliminar');

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        Route::get('roles', [AdminRolController::class, 'index'])
            ->middleware('permiso:roles.ver');

        Route::post('roles', [AdminRolController::class, 'store'])
            ->middleware('permiso:roles.crear');

        Route::put('roles/{id}', [AdminRolController::class, 'update'])
            ->middleware('permiso:roles.editar');

        Route::patch('roles/{id}/desactivar', [AdminRolController::class, 'deactivate'])
            ->middleware('permiso:roles.eliminar');

        /*
        |--------------------------------------------------------------------------
        | Permisos
        |--------------------------------------------------------------------------
        */

        Route::get('permisos', [AdminPermisoController::class, 'index'])
            ->middleware('permiso:permisos.ver');

        Route::post('permisos', [AdminPermisoController::class, 'store'])
            ->middleware('permiso:permisos.crear');

        Route::put('permisos/{id}', [AdminPermisoController::class, 'update'])
            ->middleware('permiso:permisos.editar');

        Route::patch('permisos/{id}/desactivar', [AdminPermisoController::class, 'deactivate'])
            ->middleware('permiso:permisos.eliminar');

        /*
        |--------------------------------------------------------------------------
        | Matriz permisos por rol
        |--------------------------------------------------------------------------
        */

        Route::get('permisos-roles', [AdminPermisoController::class, 'permisosRoles'])
            ->middleware('permiso:permisos.ver');

        Route::post('permisos-roles', [AdminPermisoController::class, 'guardarPermisoRol'])
            ->middleware('permiso:permisos.asignar');

        /*
        |--------------------------------------------------------------------------
        | Plazas (ADMIN)
        |--------------------------------------------------------------------------
        */

        Route::get('plazas', [PlazaController::class, 'index'])
            ->middleware('permiso:plazas.ver');

        Route::get('plazas/{id}', [PlazaController::class, 'show'])
            ->middleware('permiso:plazas.ver');

        Route::post('plazas', [PlazaController::class, 'store'])
            ->middleware('permiso:plazas.crear');

        Route::put('plazas/{id}', [PlazaController::class, 'update'])
            ->middleware('permiso:plazas.editar');

        Route::patch('plazas/{id}/cerrar', [PlazaController::class, 'cerrar'])
            ->middleware('permiso:plazas.eliminar');

        Route::get('postulaciones', [PostulacionController::class, 'adminListado'])
            ->middleware('permiso:postulaciones.ver');

        Route::get('postulaciones/{plaza_id}', [PostulacionController::class, 'porPlaza'])
            ->middleware('permiso:postulaciones.ver');

        Route::patch('postulaciones/{id}/estado', [PostulacionController::class, 'cambiarEstado'])
            ->middleware('permiso:postulaciones.evaluar');

        Route::get('postulantes/{id}', [PostulacionController::class, 'verPerfil'])
            ->middleware('permiso:postulaciones.ver');
        /*
        |--------------------------------------------------------------------------
        | Comentarios (ADMIN)
        |--------------------------------------------------------------------------
        */
        Route::get('testimonios', [AdminTestimonioController::class, 'index'])
            ->middleware('permiso:testimonios.ver');

        Route::put('testimonios/{id}/aprobar', [AdminTestimonioController::class, 'aprobar'])
            ->middleware('permiso:testimonios.editar');

        Route::put('testimonios/{id}/destacar', [AdminTestimonioController::class, 'destacar'])
            ->middleware('permiso:testimonios.editar');

        Route::delete('testimonios/{id}', [AdminTestimonioController::class, 'destroy'])
            ->middleware('permiso:testimonios.eliminar');

        /*
        |--------------------------------------------------------------------------
        | Bitácora (ADMIN)
        |--------------------------------------------------------------------------
        */
        Route::get('bitacora', [BitacoraController::class, 'index'])
            ->middleware('permiso:bitacora.ver');

        /*
        |--------------------------------------------------------------------------
        | Backups (ADMIN)
        |--------------------------------------------------------------------------
        */
        Route::get('backups', [BackupController::class, 'index'])
            ->middleware('permiso:backups.ver');

        Route::post('backups', [BackupController::class, 'create'])
            ->middleware('permiso:backups.crear');

        // Route::get('backups/{file}', [BackupController::class, 'download'])
        //     ->middleware('permiso:backups.descargar');
    
        Route::delete('backups/{file}', [BackupController::class, 'delete'])
            ->middleware('permiso:backups.eliminar');

        /*
        |--------------------------------------------------------------------------
        | Categorías Laborales (ADMIN)
        |--------------------------------------------------------------------------
        */
        Route::get('/categorias-laborales', [CategoriaLaboralController::class, 'index']);
        Route::post('/categorias-laborales', [CategoriaLaboralController::class, 'store']);
        Route::put('/categorias-laborales/{id}', [CategoriaLaboralController::class, 'update']);
        Route::put('/categorias-laborales/{id}/toggle', [CategoriaLaboralController::class, 'toggle']);
        Route::delete('/categorias-laborales/{id}', [CategoriaLaboralController::class, 'destroy']);

        /*
        |--------------------------------------------------------------------------
        | Mantenimientos (ADMIN)
        |--------------------------------------------------------------------------
        */
        Route::prefix('catalogos')->group(function () {
            Route::get('{catalogo}', [CatalogosController::class, 'index']);
            Route::post('{catalogo}', [CatalogosController::class, 'store']);
            Route::put('{catalogo}/{id}', [CatalogosController::class, 'update']);
            Route::put('{catalogo}/{id}/toggle', [CatalogosController::class, 'toggle']);
            Route::delete('{catalogo}/{id}', [CatalogosController::class, 'destroy']);
        });
    });

/*
|--------------------------------------------------------------------------
| Rutas autenticadas (usuario normal)
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
    Route::put('/profile/password', [ProfileSecurityController::class, 'updatePassword']);

    /*
    |--------------------------------------------------------------------------
    | Plazas
    |--------------------------------------------------------------------------
    */

    Route::post('plazas/{id}/postular', [PostulacionController::class, 'postular']);

    /*
    |--------------------------------------------------------------------------
    | Postulaciones
    |--------------------------------------------------------------------------
    */

    Route::get('mis-postulaciones', [PostulacionController::class, 'misPostulaciones']);

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

    Route::get('/profile', [ProfileApiController::class, 'show']);
    // Route::post('/profile', [ProfileApiController::class, 'store']);
    Route::post('/profile', [ProfileApiController::class, 'update']);
    Route::put('/profile/basic', [ProfileApiController::class, 'updateBasic']);
    Route::post('/profile/delete', [ProfileApiController::class, 'destroy']);

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
    | Comentarios
    |--------------------------------------------------------------------------
    */

    Route::post('/testimonios', [TestimonioController::class, 'store']);

});

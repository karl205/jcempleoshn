<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\PlazaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPostulacionesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Página pública
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| Pruebas de roles y permisos
|--------------------------------------------------------------------------
*/

Route::get('/test-open', function () {
    return 'RUTA ABIERTA OK';
});

Route::middleware(['auth', 'rol:admin'])->get('/admin-test', function () {
    return 'ADMIN OK';
});

Route::middleware(['auth', 'permiso:postular_empleo'])->get('/postular-test', function () {
    return 'POSTULAR OK';
});

/*
|--------------------------------------------------------------------------
| Autenticación - Login / Logout
|--------------------------------------------------------------------------
*/

// Mostrar formulario de login
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// Procesar login
Route::post('/login', [LoginController::class, 'authenticate'])
    ->middleware('guest')
    ->name('login.authenticate');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Registro
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');

/*
|--------------------------------------------------------------------------
| Recuperación y reset de contraseña
|--------------------------------------------------------------------------
*/

// Solicitar enlace de recuperación
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

// Formulario para nueva contraseña
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

// Guardar nueva contraseña
Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| Verificación de correo
|--------------------------------------------------------------------------
*/

// Aviso: revisa tu correo
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Procesar verificación
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login')->with('verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');

// Reenviar correo
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Correo reenviado');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/*
|--------------------------------------------------------------------------
| Perfil de usuario
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'permiso:editar_perfil'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'index'])->name('perfil.index');
    Route::post('/perfil', [ProfileController::class, 'store'])->name('perfil.store');
});

/*
|--------------------------------------------------------------------------
| Usuario - vistas navegables
|--------------------------------------------------------------------------
*/

Route::get('/plazas', function () {
    return view('user.plazas');
})->name('user.plazas');

Route::get('/plazas/{id}', [PlazaController::class, 'show'])
    ->name('user.plazas.show');

Route::get('/mis-postulaciones', function () {
    return view('user.postulaciones');
})->name('user.postulaciones');

Route::prefix('cuenta')->group(function () {
    Route::get('cuenta/postulaciones', function () {
        return view('user.postulaciones');
    })->name('cuenta.postulaciones');
});

Route::get('/cuenta/configuracion', function () {
    return view('user.configuracion');
})->name('cuenta.configuracion');

/*
|--------------------------------------------------------------------------
| Dashboard (usuario autenticado y verificado)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin - vistas y gestión
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/catalogos', [AdminController::class, 'catalogos'])
    ->name('admin.catalogos');

Route::get('/admin/plazas', function () {
    return view('admin.plazas');
})->name('admin.plazas');

Route::get('/admin/plazas/crear', function () {
    return view('admin.crear');
})->name('admin.plazas.crear');

Route::get('/admin/plazas/{id}/editar', function ($id) {
    return view('admin.plazas_editar', ['id' => $id]);
})->name('admin.plazas.editar');

Route::get('/admin/mensajes', function () {
    return view('admin.mensajes');
})->name('admin.mensajes');

/*
|--------------------------------------------------------------------------
| Admin - postulaciones
|--------------------------------------------------------------------------
*/

Route::get('/admin/postulaciones', [AdminPostulacionesController::class, 'index'])
    ->name('admin.postulaciones.index');

Route::get('/admin/postulaciones/plazas', [AdminPostulacionesController::class, 'plazas'])
    ->name('admin.postulaciones.plazas');

Route::get('/admin/postulaciones/{id}', [AdminPostulacionesController::class, 'ver'])
    ->name('admin.postulaciones.ver');

/*
|--------------------------------------------------------------------------
| Admin - utilidades
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {

    Route::view('/usuarios', 'admin.usuarios.index')
        ->name('admin.usuarios')
        ->withoutMiddleware(['auth']);

    Route::view('/configuracion', 'admin.configuracion.index')
        ->name('admin.configuracion')
        ->withoutMiddleware(['auth']);

    Route::view('/bitacora', 'admin.bitacora.index')
        ->name('admin.bitacora');

    Route::view('/respaldo', 'admin.respaldo.index')
        ->name('admin.respaldo');

    Route::view('/errores', 'admin.errores.index')
        ->name('admin.errores');
});

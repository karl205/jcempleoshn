<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\AdminPostulacionesController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Authenticate;

// Página de inicio pública (usuario invitado)
Route::get('/', function () {
    return view('home');
})->name('home');

// Auth visual
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Usuario - vistas navegables
Route::get('/plazas', function () {
    return view('user.plazas');
})->name('user.plazas');

Route::get('/perfil', function () {
    return view('user.perfil');
})->name('user.perfil');

Route::get('/mis-postulaciones', function () {
    return view('user.postulaciones');
})->name('user.postulaciones');

// Admin - vistas navegables
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/plazas', function () {
    return view('admin.plazas');
})->name('admin.plazas');

Route::get('/admin/plazas/crear', function () {
    return view('admin.crear');
})->name('admin.plazas.crear');

Route::get('/admin/mensajes', function () {
    return view('admin.mensajes');
})->name('admin.mensajes');

// routes/web.php
Route::get('/admin/plazas/{id}/editar', function ($id) {
    return view('admin.plazas_editar', ['id' => $id]); // pasa el ID a la vista
})->name('admin.plazas.editar');



Route::get('/admin/postulaciones', function () {
    return view('admin.postulaciones');
})->name('admin.postulaciones');

Route::get('/admin/postulaciones/ver/{id}', function ($id) {
    return view('admin.postulaciones.lista', ['plazaId' => $id]);
})->name('admin.postulaciones.ver');

Route::get('/admin/filtrar-candidatos', function () {
    return view('admin.filtrar-candidatos');
})->name('admin.filtrar-candidatos');



Route::get('/plazas/{id}', [App\Http\Controllers\PlazaController::class, 'show'])->name('user.plazas.show');
Route::get('/admin/postulaciones', [AdminPostulacionesController::class, 'index'])->name('admin.postulaciones.index');
Route::get('/admin/postulaciones/plazas', [AdminPostulacionesController::class, 'plazas'])->name('admin.postulaciones.plazas');

Route::get('/admin/postulaciones/{id}', [AdminPostulacionesController::class, 'ver'])->name('admin.postulaciones.ver');
Route::get('/admin/catalogos', [AdminController::class, 'catalogos'])->name('admin.catalogos');



Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');

// Mostrar el formulario para solicitar enlace de recuperación
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

// Procesar el envío del formulario (manda el correo)
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

    // Mostrar formulario para ingresar nueva contraseña (llega desde correo con token)
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
->middleware('guest')
->name('password.reset');

// Guardar nueva contraseña en la base de datos
Route::post('reset-password', [NewPasswordController::class, 'store'])
->middleware('guest')
->name('password.update');

Route::prefix('cuenta')->group(function () {
    Route::get('/perfil', function () {
        return view('user.perfil');
    })->name('cuenta.perfil');

    Route::get('cuenta/postulaciones', function () {
        return view('user.postulaciones');
    })->name('cuenta.postulaciones');
});

Route::get('/cuenta/configuracion', function () {
    return view('user.configuracion');
})->name('cuenta.configuracion');

Route::prefix('admin')->middleware(['auth'])->group(function () {

    // ... tus otras rutas protegidas

    Route::view('/usuarios', 'admin.usuarios.index')
        ->name('admin.usuarios')
        ->withoutMiddleware(['auth']); // o ->withoutMiddleware([Authenticate::class])

    Route::view('/configuracion', 'admin.configuracion.index')
        ->name('admin.configuracion')
        ->withoutMiddleware(['auth']); // temporalmente sin login
});

// routes/web.php
Route::prefix('admin')->group(function () {
    Route::view('/bitacora', 'admin.bitacora.index')->name('admin.bitacora'); // nueva
});
// routes/web.php
Route::prefix('admin')->group(function () {
    Route::view('/respaldo', 'admin.respaldo.index')->name('admin.respaldo');
    // si te pide login y solo estás presentando:
    // ->withoutMiddleware('auth')
});

// routes/web.php
Route::prefix('admin')->group(function () {
    Route::view('/errores', 'admin.errores.index')->name('admin.errores');
    // ... (usuarios, configuracion, bitacora, respaldo)
});




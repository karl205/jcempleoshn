<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlazaController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\AdminPostulacionesController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;

// Página de inicio pública (usuario invitado)
Route::get('/', function () {
    return view('home');
})->name('home');

//ROLES Y PERMISOS
Route::get('/test-open', function () {
    return 'RUTA ABIERTA OK';
});

Route::middleware(['auth', 'role:admin'])->get('/admin-test', function () {
    return 'ADMIN OK';
});

Route::middleware(['auth', 'permission:postular_empleo'])->get('/postular-test', function () {
    return 'POSTULAR OK';
});

//ROLES Y PERMISOS

//INICIO DE SESION
// Mostrar formulario de login
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// Procesar login
Route::post('/login', [LoginController::class, 'authenticate'])
    ->middleware('guest')
    ->name('login.authenticate');

    

//INICIO DE SESION

// Auth visual
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Registro
Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');

// Route::get('/force-logout', function () {
//     Auth::logout();
//     request()->session()->invalidate();
//     request()->session()->regenerateToken();
//     return redirect('/login');
// });

// VERIFICACION DE CORREO
// Aviso: revisa tu correo
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Procesar verificación (cuando hacen clic en el correo)
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login')->with('verified', true);
})->middleware(['auth', 'signed'])->name('verification.verify');

// Reenviar correo
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Correo reenviado');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// VERIFICACION DE CORREO


// LOGIN CONTROLLER
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
// LOGIN CONTROLLER



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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

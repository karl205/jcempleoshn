<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UsuarioController;
use App\Http\Controllers\API\PerfilController;
use App\Http\Controllers\API\PerfilExperienciaController;
use App\Http\Controllers\API\PerfilEducacionController;
use App\Http\Controllers\API\PerfilIdiomaController;
use App\Http\Controllers\API\PerfilCvController;
use App\Http\Controllers\API\PlazaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
    Route::patch('/usuarios/{id}/desactivar', [UsuarioController::class, 'deactivate']);
    
    Route::put('/perfil', [PerfilController::class, 'update']);
    Route::get('/perfil', [PerfilController::class, 'show']);
    
    Route::get('/perfil/educacion', [PerfilEducacionController::class, 'index']);
    Route::post('/perfil/educacion', [PerfilEducacionController::class, 'store']);
    Route::put('/perfil/educacion/{id}', [PerfilEducacionController::class, 'update']);
    Route::delete('/perfil/educacion/{id}', [PerfilEducacionController::class, 'destroy']);

    Route::get('/perfil/experiencia', [PerfilExperienciaController::class, 'index']);
    Route::post('/perfil/experiencia', [PerfilExperienciaController::class, 'store']);
    Route::put('/perfil/experiencia/{id}', [PerfilExperienciaController::class, 'update']);
    Route::delete('/perfil/experiencia/{id}', [PerfilExperienciaController::class, 'destroy']);

    Route::get('/perfil/idioma', [PerfilIdiomaController::class, 'index']);
    Route::post('/perfil/idioma', [PerfilIdiomaController::class, 'store']);
    Route::put('/perfil/idioma/{id}', [PerfilIdiomaController::class, 'update']);
    Route::delete('/perfil/idioma/{id}', [PerfilIdiomaController::class, 'destroy']);

    Route::middleware('auth:sanctum')->get('/perfil/cv', [PerfilCvController::class, 'show']);

    Route::get('/plazas', [PlazaController::class, 'index']);
    Route::get('/plazas/{id}', [PlazaController::class, 'show']);
    Route::post('/plazas', [PlazaController::class, 'store']);
});

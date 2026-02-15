<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PlazaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    Route::get('/plazas', [PlazaController::class, 'index']);
    Route::get('/plazas/{id}', [PlazaController::class, 'show']);
    Route::post('/plazas', [PlazaController::class, 'store']);
});


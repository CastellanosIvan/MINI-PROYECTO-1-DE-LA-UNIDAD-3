<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas públicas (cualquier visitante, incluso anónimo)
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');
Route::view('/quienes-somos', 'quienes-somos')->name('quienes-somos');
Route::view('/mision-vision', 'mision-vision')->name('mision-vision');
Route::view('/ubicacion', 'ubicacion')->name('ubicacion');
Route::view('/contacto', 'contacto')->name('contacto');

/*
|--------------------------------------------------------------------------
| Solo invitados (no autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');

    Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/registro', [AuthController::class, 'register'])->name('register.store');
});

/*
|--------------------------------------------------------------------------
| Usuarios autenticados
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Redirige al dashboard que corresponde según el rol
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/cliente', [DashboardController::class, 'cliente'])
        ->middleware('role:cliente')->name('dashboard.cliente');

    Route::get('/dashboard/empleado', [DashboardController::class, 'empleado'])
        ->middleware('role:empleado')->name('dashboard.empleado');

    Route::middleware('role:gerente')->group(function () {
        Route::get('/dashboard/gerente', [DashboardController::class, 'gerente'])->name('dashboard.gerente');

        // CRUD de usuarios (solo Gerente)
        Route::resource('usuarios', UserController::class)
            ->parameters(['usuarios' => 'user'])
            ->except(['show']);
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ClientesIndex;
use App\Http\Controllers\Auth\LoginController;

// Rutas públicas
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Rutas protegidas con autenticación
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gestión de clientes (requiere permiso)
    Route::middleware(['permission:ver clientes'])->group(function () {
        Route::get('/clientes', ClientesIndex::class)->name('clientes.index');
    });

    // Rutas adicionales según roles
    Route::get('/turnos', function () {
        return view('turnos.index');
    })->name('turnos.index')->middleware('permission:ver turnos');

    Route::get('/mis-turnos', function () {
        return view('turnos.mis-turnos');
    })->name('mis-turnos');
});

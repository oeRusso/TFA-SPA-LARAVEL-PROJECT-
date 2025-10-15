<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ClientesIndex;

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Gestión de clientes
Route::get('/clientes', ClientesIndex::class)->name('clientes.index');

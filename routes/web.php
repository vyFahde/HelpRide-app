<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\PassageiroController;
// Rota Home - ADICIONE ->name('home')
Route::get('/', [HomeController::class, 'home'])->name('home');

// Rota Login - ADICIONE ->name('login')
Route::get('/login', [LoginController::class, 'login'])->name('login');

// Rota Sobre - ADICIONE ->name('sobre')
Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');

// Grupo de rotas para motorista
Route::prefix('/motorista')->group(function() {
    Route::get('/cadastrar', [MotoristaController::class, 'cadastrar_m'])->name('motorista.cadastrar');
});

Route::prefix('/passageiro')->group(function() {
    Route::get('/buscarcarona', [PassageiroController::class, 'buscar_c'])->name('passageiro.buscar');
});
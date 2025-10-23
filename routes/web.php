<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\PassageiroController;
use App\Http\Controllers\SuporteController;


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');

Route::get('/suporte', [SuporteController::class, 'suporte'])->name('suporte');
Route::post('/suporte/enviar', [SuporteController::class, 'enviar'])->name('suporte.enviar');


Route::controller(LoginController::class)->group(function() {
    
    Route::get('/login', 'login')->name('login');
    
    Route::post('/logar', 'logar')->name('logar');
    
    Route::get('/logout', 'logout')->name('logout');
});

Route::prefix('/motorista')->group(function() {
    
    Route::get('/cadastrar', [MotoristaController::class, 'cadastrar_m'])->name('motorista.cadastrar');
    
    Route::post('/cadastrar', [MotoristaController::class, 'store'])->name('motorista.store');
});

Route::prefix('/passageiro')->group(function() {
    
    Route::get('/buscar_carona', [PassageiroController::class, 'buscar_c'])->name('passageiro.buscar');

    Route::get('/painel', [PassageiroController::class, 'painel_c'])->name('passageiro.painel');
});

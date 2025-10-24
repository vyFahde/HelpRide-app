<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\PassageiroController;
use App\Http\Controllers\SuporteController;
use Illuminate\Support\Facades\Auth;

// Rotas públicas
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/sobre', [SobreController::class, 'sobre'])->name('sobre');

Route::get('/suporte', [SuporteController::class, 'suporte'])->name('suporte');
Route::post('/suporte/enviar', [SuporteController::class, 'enviar'])->name('suporte.enviar');


Route::controller(LoginController::class)->group(function() {
    
    Route::get('/login', 'login')->name('login');
    
    Route::post('/logar', 'logar')->name('logar');
    
    Route::post('/logout', 'logout')->name('logout'); // Alterado para POST
});

Route::prefix('/motorista')->group(function() {
    
    Route::get('/cadastrar', [MotoristaController::class, 'cadastrar_m'])->name('motorista.cadastrar');
    
    Route::post('/cadastrar', [MotoristaController::class, 'store'])->name('motorista.store');
});

Route::prefix('/passageiro')->group(function() {

    Route::get('/cadastrar', [PassageiroController::class, 'cadastrar_p'])->name('passageiro.cadastrar');
    
    Route::post('/cadastrar', [PassageiroController::class, 'store'])->name('passageiro.store');
});

// Rotas protegidas
Route::middleware(['auth:motorista,passageiro'])->group(function () {
    Route::prefix('/passageiro')->group(function() {
        Route::get('/buscar_carona', [PassageiroController::class, 'buscar_c'])->name('passageiro.buscar');
        Route::get('/painel', [PassageiroController::class, 'painel_c'])->name('passageiro.painel');
    });
    
    // Adicionar rotas protegidas para motorista aqui, se houver

    // Rota temporária para Configurações do Perfil (você pode criar o controller e a view depois)
    Route::get('/perfil/configuracoes', function () {
        return view('perfil_configuracoes'); // Assumindo que você criará esta view
    })->name('perfil.configuracoes');
});

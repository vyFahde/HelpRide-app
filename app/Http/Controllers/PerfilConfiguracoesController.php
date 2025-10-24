<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilConfiguracoesController extends Controller
{
    /**
     * Exibe a página de configurações do perfil do usuário logado.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Determina qual guard está autenticado (motorista ou passageiro)
        $user = null;
        if (Auth::guard('motorista')->check()) {
            $user = Auth::guard('motorista')->user();
            $tipo_usuario = 'motorista';
        } elseif (Auth::guard('passageiro')->check()) {
            $user = Auth::guard('passageiro')->user();
            $tipo_usuario = 'passageiro';
        }

        if (!$user) {
            // Se por algum motivo o middleware falhar, redireciona para o login
            return redirect()->route('login');
        }

        return view('perfil_configuracoes', compact('user', 'tipo_usuario'));
    }
}


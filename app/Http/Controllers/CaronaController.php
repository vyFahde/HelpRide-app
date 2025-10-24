<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaronaController extends Controller
{
    /**
     * Exibe o formulário para motoristas publicarem uma carona.
     *
     * @return \Illuminate\View\View
     */
    public function publicarCarona()
    {
        // Verifica se o usuário logado é um motorista
        if (!Auth::guard('motorista')->check()) {
            // Se não for motorista, redireciona para a busca de caronas (comportamento padrão para passageiros)
            return redirect()->route('passageiro.buscar');
        }

        return view('publicar_carona');
    }

    /**
     * Processa a publicação da carona.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Lógica de validação e salvamento da carona
        // ... (A ser implementada em uma fase futura)

        return redirect()->route('home')->with('success', 'Carona publicada com sucesso!');
    }
}


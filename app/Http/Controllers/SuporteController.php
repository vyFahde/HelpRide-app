<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuporteController extends Controller
{
    public function suporte()
    {
        return view('suporte');
    }
    
    public function enviar(Request $request)
    {
        $dados = $request->validate([
            'tipo_problema' => 'required|string',
            'assunto' => 'required|string|max:255',
            'descricao' => 'required|string',
            'viagem_id' => 'nullable|exists:viagens,id'
        ]);
        
        
        return back()->with('success', 'Seu problema foi relatado com sucesso! Entraremos em contato em breve.');
    }
}
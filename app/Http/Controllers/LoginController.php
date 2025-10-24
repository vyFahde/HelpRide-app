<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Motorista;
use App\Models\Passageiro;

class LoginController extends Controller
{
    public function login()
    {   
        return view('login', ['hideHeader' => true]);
    }
    
    public function logar(Request $request)
    {   
        $credentials = $request->validate([
            'usuario' => 'required|string',
            'senha' => 'required|string',
        ]);

        // Tenta autenticar como Motorista
        if (Auth::guard('motorista')->attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['senha']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        // Tenta autenticar como Passageiro
        // Nota: A tabela de Passageiro não tem o campo 'usuario', então vou tentar autenticar por 'email'
        // Se o usuário e senha forem cadastrados para o Passageiro, o campo 'usuario' no formulário de login deve ser o 'email'
        // Vou assumir que o campo 'usuario' no formulário de login pode ser o 'email' para o Passageiro

        $passageiro = Passageiro::where('email', $credentials['usuario'])->first();
        if ($passageiro && Auth::guard('passageiro')->attempt(['email' => $credentials['usuario'], 'password' => $credentials['senha']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }
        
        // Tenta autenticar como Passageiro usando o campo 'usuario' (se existir)
        // Como não temos a migração do passageiro, vou assumir que o campo 'usuario' não existe e forçar o login por email
        // Se o seu formulário de login usa 'usuario' para ambos, o passageiro deve usar o email no campo 'usuario'

        return back()->withErrors([
            'usuario' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('usuario');
    }

    public function logout(Request $request) 
    {
        Auth::guard('motorista')->logout();
        Auth::guard('passageiro')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}

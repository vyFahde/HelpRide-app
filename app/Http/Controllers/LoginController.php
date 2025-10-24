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

        // Tenta autenticar como Passageiro (agora com campo 'usuario')
        if (Auth::guard('passageiro')->attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['senha']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

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

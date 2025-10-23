<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {   

        return view('login', ['hideHeader' => true]);
    }
    
    public function logar(Request $request)
    {   
        if ($request->email == 'teste@gmail.com' && $request->senha == '1234567') {
            //Credencial valida
            return redirect()->route('home');
        } else {
            //Credencial invalida
            return view('login', [
                'hideHeader' => true,
                'error' => 'Credenciais inválidas!'
            ]);
        }
    }

    public function logout() 
    {
        return view('login', ['hideHeader' => true]);
    }
}
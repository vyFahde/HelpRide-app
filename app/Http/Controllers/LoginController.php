<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        $dados = [
            'email' => "teste@gmail.com",
            'senha' => "1234567"
        ];
        return view('login',['hideHeader'=>true]);
    }
    public function logout() {
    return view('login');
    }
}

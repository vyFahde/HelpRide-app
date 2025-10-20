<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function cadastrar_m() {
        return view('cadastro_m');
    }
}

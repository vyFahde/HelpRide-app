<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassageiroController extends Controller
{
    public function buscar_c() {
        return view('buscar_carona');
    }
}

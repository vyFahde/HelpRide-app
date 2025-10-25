<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passageiro;
use App\Models\Motorista;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PassageiroController extends Controller
{
public function buscar_c() {
    return view('buscar_carona');
}

public function painel_c() {
    return view('painel_carona');
}

public function cadastrar_p()
{
    return view('cadastro_p', ['hideHeader' => true]);
}

public function store(Request $request)
{
$request->merge([
    'cpf' => preg_replace('/\D/', '', $request->cpf),
    'celular' => preg_replace('/\D/', '', $request->celular),
]);

$validator = Validator::make($request->all(), [
    'nome' => 'required|string|min:3|max:100',
    'cpf' => 'required|digits:11|unique:passageiros,cpf',
    'nascimento' => 'required|date|before:-18 years',
    'genero' => 'required|in:masculino,feminino,outro',
    'celular' => 'required|digits_between:10,11|unique:passageiros,celular',
    'email' => 'required|email|unique:passageiros,email',
    'usuario' => 'required|string|min:3|max:20|unique:passageiros,usuario',
    'senha' => [
        'required',
        'string',
        'min:8',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
    ],
    'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
], [
    'nascimento.before' => 'Você deve ter pelo menos 18 anos para se cadastrar.',
    'senha.regex' => 'A senha deve conter letras maiúsculas, minúsculas, números e pelo menos um caractere especial.',
    'cpf.unique' => 'Este CPF já está cadastrado.',
    'celular.unique' => 'Este celular já está cadastrado.',
    'email.unique' => 'Este e-mail já está cadastrado.',
    'usuario.unique' => 'Este nome de usuário já está em uso.',
]);

if ($validator->fails()) {
    return back()->withErrors($validator)->withInput();
}

$dados = $request->all();
$dados['senha'] = Hash::make($request->senha);
$dados['foto'] = $request->file('foto')?->store('passageiros/fotos', 'public');
$dados['status'] = 'pendente';

Passageiro::create($dados);

return redirect()->route('login')
    ->with('success', 'Cadastro realizado com sucesso! Verifique seu e-mail e celular para validar sua conta.');
}

}
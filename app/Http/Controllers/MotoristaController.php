<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Motorista;
use App\Models\Passageiro;
use Illuminate\Support\Facades\Validator;

class MotoristaController extends Controller
{
public function cadastrar_m() {
    return view('cadastro_m',['hideHeader' => true]);
}

public function store(Request $request)
{
$request->merge([
    'cpf' => preg_replace('/\D/', '', $request->cpf),
    'celular' => preg_replace('/\D/', '', $request->celular),
]);

$validator = Validator::make($request->all(), [
    'nome' => 'required|string|min:3|max:100',
    'cpf' => 'required|digits:11|unique:motoristas,cpf',
    'nascimento' => 'required|date|before:-18 years',
    'genero' => 'required|in:masculino,feminino,outro',
    'celular' => 'required|digits_between:10,11|unique:motoristas,celular',
    'email' => 'required|email|unique:motoristas,email',
    'usuario' => 'required|string|min:3|max:20|unique:motoristas,usuario|unique:passageiros,usuario',
    'senha' => [
        'required','string','min:8',
        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
    ],
    'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    'cnh' => 'required|string|size:11|unique:motoristas,cnh',
    'validade' => 'required|date|after:today',
    'modelo' => 'required|string|min:2|max:50',
    'placa' => 'required|string|size:7',
    'ano' => 'required|integer|min:2000|max:' . date('Y'),
    'cor' => 'required|string|min:3|max:20',
], [
    'cpf.digits' => 'O CPF deve conter exatamente 11 dígitos.',
    'celular.digits_between' => 'O celular deve conter 10 ou 11 dígitos.',
    'senha.regex' => 'A senha deve conter letras maiúsculas, minúsculas, números e pelo menos um caractere especial.',
    'cnh.size' => 'A CNH deve conter exatamente 11 caracteres.',
    'validade.after' => 'A validade da CNH deve ser uma data futura.',
]);

if ($validator->fails()) {
    return back()->withErrors($validator)->withInput();
}

$dados = $request->all();
$dados['senha'] = Hash::make($request->senha);
$dados['placa'] = strtoupper($request->placa); // padroniza a placa
$dados['foto'] = $request->file('foto')?->store('motoristas/fotos', 'public');
$dados['status'] = 'pendente';

Motorista::create($dados);

return redirect()->route('home')
    ->with('success', 'Cadastro realizado com sucesso! Aguarde a aprovação.');
}
}
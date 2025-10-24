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
        try {
            // Validação dos dados
            $validator = Validator::make($request->all(), [
                'nome' => 'required|string|min:3|max:100',
                'cpf' => 'required|string|min: 11|max:14|unique:passageiros,cpf|unique:motoristas,cpf',
                'nascimento' => 'required|date|before:-18 years',
                'genero' => 'required|in:masculino,feminino,outro',
                'celular' => 'required|string|min:11|max:15|unique:passageiros,celular|unique:motoristas,celular',
                'email' => 'required|email|unique:passageiros,email|unique:motoristas,email',
                'usuario' => 'required|string|min:3|max:20|unique:passageiros,usuario',
                'senha' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
                ],
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ], [
                'nascimento.before' => 'Você deve ter pelo menos 18 anos para se cadastrar.',
                'senha.regex' => 'A senha deve conter letras maiúsculas, minúsculas, números e pelo menos um caractere especial.',
                'cpf.unique' => 'Este CPF já está cadastrado.',
                'celular.unique' => 'Este celular já está cadastrado.',
                'email.unique' => 'Este e-mail já está cadastrado.',
                'usuario.unique' => 'Este nome de usuário já está em uso.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Processar foto se existir
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('passageiros/fotos', 'public');
            }

            // Criar passageiro
            $passageiro = Passageiro::create([
                'nome' => $request->nome,
                'cpf' => preg_replace('/[^0-9]/', '', $request->cpf),
                'nascimento' => $request->nascimento,
                'genero' => $request->genero,
                'celular' => preg_replace('/[^0-9]/', '', $request->celular),
                'email' => $request->email,
                'usuario' => $request->usuario,
                'senha' => Hash::make($request->senha),
                'foto' => $fotoPath,
                'status' => 'pendente'
            ]);

            return redirect()->route('login')
                ->with('success', 'Cadastro realizado com sucesso! Verifique seu e-mail e celular para validar sua conta.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao realizar cadastro: ' . $e->getMessage())
                ->withInput();
        }
    }
}

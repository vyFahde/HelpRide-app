<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MotoristaController extends Controller
{
    public function cadastrar_m() {
        return view('cadastro_m');
    }

    public function store(Request $request) {
        // Validação dos dados - SEM regras customizadas por enquanto
        $request->validate([
            // Dados Pessoais
            'nome' => 'required|string|min:3|max:100',
            'cpf' => 'required|string|min:11|max:14',
            'nascimento' => 'required|date|before:-18 years',
            'celular' => 'required|string|min:11|max:15',
            'email' => 'required|email',
            'usuario' => 'required|string|min:3|max:20',
            'senha' => 'required|string|min:7',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Dados da CNH
            'cnh' => 'required|string|min:11|max:11',
            'validade' => 'required|date|after:today',
            
            // Dados do Veículo
            'modelo' => 'required|string|min:2|max:50',
            'placa' => 'required|string|min:7|max:7',
            'ano' => 'required|integer|min:2000|max:' . date('Y'),
            'cor' => 'required|string|min:3|max:20',
        ], [
             'nome.required' => 'O campo nome é obrigatório.',
            'nome.min' => 'O campo nome deve ter pelo menos 3 caracteres.',
            'nome.max' => 'O campo nome não pode ter mais de 100 caracteres.',
            
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.min' => 'O campo CPF deve ter pelo menos 11 caracteres.',
            'cpf.max' => 'O campo CPF não pode ter mais de 14 caracteres.',
            
            'nascimento.required' => 'O campo data de nascimento é obrigatório.',
            'nascimento.date' => 'O campo data de nascimento deve ser uma data válida.',
            'nascimento.before' => 'Você deve ter pelo menos 18 anos para se cadastrar.',
            
            'celular.required' => 'O campo celular é obrigatório.',
            'celular.min' => 'O campo celular deve ter pelo menos 11 caracteres.',
            'celular.max' => 'O campo celular não pode ter mais de 15 caracteres.',
            
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            
            'usuario.required' => 'O campo usuário é obrigatório.',
            'usuario.min' => 'O campo usuário deve ter pelo menos 3 caracteres.',
            'usuario.max' => 'O campo usuário não pode ter mais de 20 caracteres.',
            
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.min' => 'O campo senha deve ter pelo menos 7 caracteres.',
            
            'foto.image' => 'O arquivo deve ser uma imagem.',
            'foto.mimes' => 'A imagem deve ser dos tipos: jpeg, png, jpg.',
            'foto.max' => 'A imagem não pode ter mais de 2MB.',
            
            // Dados da CNH
            'cnh.required' => 'O campo CNH é obrigatório.',
            'cnh.min' => 'O campo CNH deve ter exatamente 11 caracteres.',
            'cnh.max' => 'O campo CNH deve ter exatamente 11 caracteres.',
            
            'validade.required' => 'O campo validade da CNH é obrigatório.',
            'validade.date' => 'O campo validade deve ser uma data válida.',
            'validade.after' => 'A CNH deve estar válida.',
            
            // Dados do Veículo
            'modelo.required' => 'O campo modelo é obrigatório.',
            'modelo.min' => 'O campo modelo deve ter pelo menos 2 caracteres.',
            'modelo.max' => 'O campo modelo não pode ter mais de 50 caracteres.',
            
            'placa.required' => 'O campo placa é obrigatório.',
            'placa.min' => 'O campo placa deve ter exatamente 7 caracteres.',
            'placa.max' => 'O campo placa deve ter exatamente 7 caracteres.',
            
            'ano.required' => 'O campo ano é obrigatório.',
            'ano.integer' => 'O ano do veículo deve ser um número.',
            'ano.min' => 'O ano do veículo deve ser a partir de 2000.',
            'ano.max' => 'O ano do veículo não pode ser no futuro.',
            
            'cor.required' => 'O campo cor é obrigatório.',
            'cor.min' => 'O campo cor deve ter pelo menos 3 caracteres.',
            'cor.max' => 'O campo cor não pode ter mais de 20 caracteres.',
        ]);

        // Validação manual do CPF e Celular
        $errors = [];
        
        // Validar CPF
        $cpfLimpo = preg_replace('/[^0-9]/', '', $request->cpf);
        if (strlen($cpfLimpo) !== 11) {
            $errors['cpf'] = 'CPF deve conter 11 dígitos.';
        }
        
        // Validar Celular
        $celularLimpo = preg_replace('/[^0-9]/', '', $request->celular);
        if (!in_array(strlen($celularLimpo), [10, 11])) {
            $errors['celular'] = 'Celular deve conter pelo menos 11 dígitos.';
        }
        
        // Se houver erros na validação manual, retorna com erros
        if (!empty($errors)) {
            return back()
                ->withErrors($errors)
                ->withInput();
        }

        try {
            // Processar upload da foto (se existir)
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('motoristas/fotos', 'public');
            }

            // Aqui você salvaria no banco de dados
            // Por enquanto, vamos apenas mostrar os dados (para teste)
            
            // DEBUG: Mostrar dados recebidos (remova depois)
            // return response()->json($request->all());

            return redirect()->route('home')
                ->with('success', 'Cadastro realizado com sucesso! Aguarde a aprovação.');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Erro ao realizar cadastro: ' . $e->getMessage())
                ->withInput();
        }
    }
}
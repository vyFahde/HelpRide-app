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
        $request->validate([
            
            // Dados Pessoais
            'nome' => 'required|string|min:3|max:100',
            'cpf' => 'required|string|min:11|max:14',
            'nascimento' => 'required|date|before:-18 years',
            'celular' => 'required|string|min:10|max:15',
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
            'nascimento.before' => 'Você deve ter pelo menos 18 anos para se cadastrar.',
            'validade.after' => 'A CNH deve estar válida.',
            'ano.integer' => 'O ano do veículo deve ser um número.',
            'ano.min' => 'O ano do veículo deve ser a partir de 2000.',
            'ano.max' => 'O ano do veículo não pode ser no futuro.',
        ]);

        // Validação manual do CPF e Celular
        $errors = [];

        $cpfLimpo = preg_replace('/[^0-9]/', '', $request->cpf);
        if (strlen($cpfLimpo) !== 11) {
            $errors['cpf'] = 'CPF deve conter 11 dígitos.';
        }
        
        $celularLimpo = preg_replace('/[^0-9]/', '', $request->celular);
        $tamanhoCelular = strlen($celularLimpo);
        
        if (!in_array($tamanhoCelular, [10, 11])) {
            $errors['celular'] = 'Número de celular deve ter 10 ou 11 dígitos (com DDD).';
        }
        
        // Se houver erros na validação manual, retorna com erros
        if (!empty($errors)) {
            return back()
                ->withErrors($errors)
                ->withInput();
        }

        try {
            // Processar upload da foto
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('motoristas/fotos', 'public');
            }

            

            return redirect()->route('home')
                ->with('success', 'Cadastro realizado com sucesso! Aguarde a aprovação.');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Erro ao realizar cadastro: ' . $e->getMessage())
                ->withInput();
        }
    }
}
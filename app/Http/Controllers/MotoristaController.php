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
        return view('cadastro_m');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            
            // Dados Pessoais
            'nome' => 'required|string|min:3|max:100',
            'cpf' => 'required|string|min:11|max:14|unique:motoristas,cpf|unique:passageiros,cpf',
            'nascimento' => 'required|date|before:-18 years',
            'genero' => 'required|in:masculino,feminino,outro',
            'celular' => 'required|string|min:10|max:15|unique:motoristas,celular|unique:passageiros,celular',
            'email' => 'required|email|unique:motoristas,email|unique:passageiros,email',
            'usuario' => 'required|string|min:3|max:20|unique:motoristas,usuario',
            'senha' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/'
            ],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Dados da CNH
            'cnh' => 'required|string|min:11|max:11|unique:motoristas,cnh',
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
            'senha.regex' => 'A senha deve conter letras maiúsculas, minúsculas, números e pelo menos um caractere especial.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'celular.unique' => 'Este celular já está cadastrado.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'usuario.unique' => 'Este nome de usuário já está em uso.',
            'cnh.unique' => 'Esta CNH já está cadastrada.',
        ]);

        // Validação manual de CPF e Celular (se a validação automática falhar)
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $cpfLimpo = preg_replace('/[^0-9]/', '', $request->cpf);
        $celularLimpo = preg_replace('/[^0-9]/', '', $request->celular);

        // Validação adicional de tamanho de CPF e Celular (se necessário)
        $errors = [];
        if (strlen($cpfLimpo) !== 11) {
            $errors['cpf'] = 'CPF deve conter 11 dígitos.';
        }
        
        $tamanhoCelular = strlen($celularLimpo);
        if (!in_array($tamanhoCelular, [10, 11])) {
            $errors['celular'] = 'Número de celular deve ter 10 ou 11 dígitos (com DDD).';
        }
        
        if (!empty($errors)) {
            return back()
                ->withErrors($errors)
                ->withInput();
        }

        try {
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('motoristas/fotos', 'public');
            }

      $motorista = Motorista::create([
                'nome' => $request->nome,
                'cpf' => $cpfLimpo, 
                'nascimento' => $request->nascimento,
                'celular' => $celularLimpo,
                'genero' => $request->genero,
                'email' => $request->email,
                'usuario' => $request->usuario,
                'senha' => Hash::make($request->senha),
                'foto' => $fotoPath,
                'cnh' => $request->cnh,
                'validade_cnh' => $request->validade,
                'modelo_veiculo' => $request->modelo,
                'placa_veiculo' => strtoupper($request->placa),
                'ano_veiculo' => $request->ano,
                'cor_veiculo' => $request->cor,
                'status' => 'pendente',
            ]);        

            return redirect()->route('home')
                ->with('success', 'Cadastro realizado com sucesso! Aguarde a aprovação.');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Erro ao realizar cadastro: ' . $e->getMessage())
                ->withInput();
        }
    }
}

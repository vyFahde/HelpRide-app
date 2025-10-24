@extends('layouts.template')

@section('title', 'Cadastro de Passageiro')

@section('content')
<div class="cadastro-container">
    <h2>Cadastro de Passageiro</h2>

    <!-- Mensagens de Sucesso/Erro -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('passageiro.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="section">
            <h2>Dados Pessoais</h2>
            <div class="form-group">
                <label for="nome">Nome Completo *</label>
                <input type="text" id="nome" name="nome" minlength="3" maxlength="100" 
                       value="{{ old('nome') }}" required placeholder="Digite seu nome completo">

                <label for="cpf">CPF *</label>
                <input type="text" id="cpf" name="cpf" 
                       value="{{ old('cpf') }}" required 
                       placeholder="000.000.000-00 ou 000000000000" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">

                <label for="nascimento">Data de Nascimento *</label>
                <input type="date" id="nascimento" name="nascimento" 
                       value="{{ old('nascimento') }}" required max="{{ date('Y-m-d') }}">

                <label for="genero">Gênero *</label>
                <select id="genero" name="genero" required>
                    <option value="">Selecione seu gênero</option>
                    <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="feminino" {{ old('genero') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                    <option value="outro" {{ old('genero') == 'outro' ? 'selected' : '' }}>Outro</option>
                </select>

                <label for="celular">Celular *</label>
                <input type="tel" id="celular" name="celular" 
                       value="{{ old('celular') }}" required 
                       placeholder="Ex: 11999999999 ou (11) 99999-9999" pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}">

                <label for="email">E-mail *</label>
                <input type="email" id="email" name="email" 
                       value="{{ old('email') }}" required 
                       placeholder="seu@email.com">

                <label for="senha">Senha *</label>
                <input type="password" id="senha" name="senha" 
                       minlength="8" required 
                       placeholder="Mínimo 8 caracteres com letras, números e símbolos"
                       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]">
                <small class="form-text">
                    A senha deve conter: letra maiúscula, minúscula, número e caractere especial (@$!%*?&)
                </small>

                <label for="foto">Foto (opcional)</label>
                <input type="file" id="foto" name="foto" accept="image/*">
                <small class="form-text">Formatos: JPEG, PNG, JPG (Max: 2MB)</small>
            </div>
        </div>
        
        <div class="btn-global">
            <button type="submit">Cadastrar</button>
                
            <div class="btn-voltar">
                <a href="{{ route('home') }}">
                    <button type="button">Voltar para Home</button>
                </a>
            </div>
        </div>
    </form>
</div>

<script>
// Máscaras para os campos
document.addEventListener('DOMContentLoaded', function() {
    // Máscara para CPF
    const cpfInput = document.getElementById('cpf');
    cpfInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d)/, '$1.$2');
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        }
        e.target.value = value;
    });

    // Máscara para Celular
    const celularInput = document.getElementById('celular');
    celularInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length <= 11) {
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
        }
        e.target.value = value;
    });

    // Validação de senha em tempo real
    const senhaInput = document.getElementById('senha');
    senhaInput.addEventListener('input', function(e) {
        const senha = e.target.value;
        const hasUpperCase = /[A-Z]/.test(senha);
        const hasLowerCase = /[a-z]/.test(senha);
        const hasNumbers = /\d/.test(senha);
        const hasSpecialChar = /[@$!%*?&]/.test(senha);
        
        if (senha.length > 0) {
            if (!hasUpperCase || !hasLowerCase || !hasNumbers || !hasSpecialChar) {
                senhaInput.style.borderColor = '#e74c3c';
            } else {
                senhaInput.style.borderColor = '#27ae60';
            }
        }
    });
});
</script>
@endsection
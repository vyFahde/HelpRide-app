@extends('layouts.template')

@section('title', 'HelpRide - Cadastro Motorista')

@section('content')
<div class="cadastro-container">
    <h2>Cadastro de Motorista</h2>

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

    <!-- FORM COMEÇA AQUI -->
    <form action="{{ route('motorista.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="section">
            <h2>Dados Pessoais</h2>
            <div class="form-group">
                <label for="nome">Nome *</label>
                <input type="text" id="nome" name="nome" minlength="3" maxlength="100" value="{{ old('nome') }}" required>

                <label for="cpf">CPF *</label>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00 ou 000000000000" value="{{ old('cpf') }}" required>

                <label for="nascimento">Data de Nascimento *</label>
                <input type="date" id="nascimento" name="nascimento" value="{{ old('nascimento') }}" required>

                <label for="celular">Celular *</label>
                <input type="tel" id="celular" name="celular" placeholder="Ex: 11999999999 ou (11) 99999-9999" value="{{ old('celular') }}" required>

                <label for="genero">Gênero *</label>
                <select id="genero" name="genero" required>
                    <option value="">Selecione seu gênero</option>
                    <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                    <option value="feminino" {{ old('genero') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                    <option value="outro" {{ old('genero') == 'outro' ? 'selected' : '' }}>Outro</option>
                </select>

                <label for="email">E-mail *</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>

                <label for="usuario">Usuário *</label>
                <input type="text" id="usuario" name="usuario" minlength="3" maxlength="20" value="{{ old('usuario') }}" required>

                <label for="senha">Senha *</label>
                <input type="password" id="senha" name="senha" 
                       minlength="8" required 
                       placeholder="Mínimo 8 caracteres com letras, números e símbolos"
                       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]">
                <small class="form-text">
                    A senha deve conter: letra maiúscula, minúscula, número e caractere especial (@$!%*?&)
                </small>

                <label for="foto">Foto</label>
                <input type="file" id="foto" name="foto" accept="image/*">
            </div>
        </div>

        <div class="section">
            <h2>Dados da CNH</h2>
            <div class="form-group">
                <label for="cnh">Nº CNH *</label>
                <input type="text" id="cnh" name="cnh" pattern="\d{11}" maxlength="11" placeholder="Somente números" value="{{ old('cnh') }}" required>

                <label for="validade">Data de Validade *</label>
                <input type="date" id="validade" name="validade" value="{{ old('validade') }}" required>
            </div>
        </div>

        <div class="section">
            <h2>Dados do Veículo</h2>
            <div class="form-group">
                <label for="modelo">Modelo *</label>
                <input type="text" id="modelo" name="modelo" value="{{ old('modelo') }}" required>

                <label for="placa">Placa *</label>
                <input type="text" id="placa" name="placa" 
                      pattern="([A-Z]{3}[0-9][A-Z0-9][0-9]{2})|([A-Z]{3}[0-9]{4})" 
                      placeholder="XXX0X00 ou XXX0000" value="{{ old('placa') }}" required>

                <label for="ano">Ano *</label>
                <input type="number" id="ano" name="ano" min="1980" max="{{ date('Y') }}" value="{{ old('ano') }}" placeholder="Ex: 2020" required>

                <label for="cor">Cor *</label>
                <input type="text" id="cor" name="cor" value="{{ old('cor') }}" required>
            </div>
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
@endsection
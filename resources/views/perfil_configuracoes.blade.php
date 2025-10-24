@extends('layouts.template')

@section('title', 'Configurações do Perfil')

@section('content')
<div class="cadastro-container">
    <h2>Configurações do Perfil</h2>

    <!-- Mensagens de Sucesso/Erro (Mantendo o estilo do projeto) -->
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

    <div class="section">
        <h3>Informações do Usuário</h3>
        <p><strong>Tipo de Usuário:</strong> {{ ucfirst($tipo_usuario) }}</p>
        <p><strong>Nome:</strong> {{ $user->nome }}</p>
        
        @if ($tipo_usuario == 'motorista')
            <p><strong>Usuário:</strong> {{ $user->usuario }}</p>
        @endif
        
        <p><strong>E-mail:</strong> {{ $user->email }}</p>
        <p><strong>Celular:</strong> {{ $user->celular }}</p>
        <p><strong>CPF:</strong> {{ $user->cpf }}</p>
        {{-- Adicione mais campos conforme a necessidade --}}
    </div>

    {{-- Exemplo de formulário para futuras atualizações --}}
    <div class="section">
        <h3>Atualizar Senha</h3>
        <form action="#" method="POST">
            @csrf
            {{-- @method('PUT') --}}
            <div class="form-group">
                <label for="senha_atual">Senha Atual</label>
                <input type="password" id="senha_atual" name="senha_atual" required>

                <label for="nova_senha">Nova Senha</label>
                <input type="password" id="nova_senha" name="nova_senha" required>

                <label for="confirmar_senha">Confirmar Nova Senha</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            <div class="btn-global">
                <button type="submit">Atualizar Senha</button>
            </div>
        </form>
    </div>

    <div class="btn-global">
        <a href="{{ route('home') }}">
            <button type="button">Voltar para Home</button>
        </a>
    </div>
</div>
@endsection
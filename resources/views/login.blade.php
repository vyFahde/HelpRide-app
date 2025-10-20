@extends('layouts.template')

@section('title', 'HelpRide - Login')

@section('content')
<div class="login-container">
    <h2>Bem-vindo</h2>
    <form>
        <div class="section">
            <h2>Insira seu usuário e senha</h2>
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" minlength="3" maxlength="20" required>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" minlength="7" required>
            </div>
        </div>
        
        <div class="btn-global">
            <button type="submit">Login</button>
        </div>
        
        <div class="btn-voltar">
            <button type="button" onclick="window.history.back()">Voltar</button>
        </div>
    </form>
</div>
@endsection
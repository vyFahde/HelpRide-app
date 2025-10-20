@extends('layouts.template')

@section('title', 'HelpRide - Login')

@section('content')
<div class="login-container">
    <h2>Bem-vindo</h2>

     @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{route('logar')}}" method="post">
        @csrf
        <div class="section">
            <h2>Insira seu usuário e senha</h2>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" minlength="3" maxlength="20" required>

                <label for="senha">Senha</label>
                <input type="senha" id="senha" name="senha" minlength="7" required>
            </div>
        </div>
        
        <div class="btn-global">
            <button type="submit">Login</button>
        </div>
        
        <div class="btn-voltar">
            <a href="{{ route('home') }}">
            <button type="button">Voltar</button>
        </div>
    </form>
</div>
@endsection
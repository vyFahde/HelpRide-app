@extends('layouts.template')
@section('title', 'Suporte')
@section('content')

<section class="suporte-page">
    <div class="interface">
        <div class="suporte-container">
            <div class="suporte-header">
                <h1>Central de <span class="carona">Suporte</span></h1>
                <p>Estamos aqui para ajudar. Relate qualquer problema encontrado na plataforma.</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <strong>Erro ao enviar:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-section">
                <h2>Relatar Problema</h2>
                <form method="POST" action="{{ route('suporte.enviar') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="tipo-problema">Tipo de Problema</label>
                        <select id="tipo-problema" name="tipo_problema" required>
                            <option value="" disabled selected>Selecione o tipo de problema</option>
                            <option value="problema_viagem">Problema em uma viagem</option>
                            <option value="problema_pagamento">Problema com pagamento</option>
                            <option value="problema_conta">Problema com a conta</option>
                            <option value="bug_plataforma">Bug na plataforma</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="assunto">Assunto</label>
                        <input 
                            type="text" 
                            id="assunto" 
                            name="assunto" 
                            placeholder="Descreva brevemente o problema" 
                            value="{{ old('assunto') }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição Detalhada</label>
                        <textarea 
                            id="descricao" 
                            name="descricao" 
                            rows="6" 
                            placeholder="Descreva com detalhes o problema encontrado..." 
                            required>{{ old('descricao') }}</textarea>
                    </div>

                    <div class="btn-global">
                        <button type="submit">Enviar Relatório</button>
                    </div>
                </form>
            </div>

            <div class="contato-rapido">
                <h3>Contato Rápido</h3>
                
                <div class="contato-item">
                    <div class="contato-icon">📧</div>
                    <div class="contato-info">
                        <h4>E-mail</h4>
                        <p>suporte@helpride.com</p>
                    </div>
                </div>

                <div class="contato-item">
                    <div class="contato-icon">📞</div>
                    <div class="contato-info">
                        <h4>Telefone</h4>
                        <p>(11) 4004-1234</p>
                    </div>
                </div>

                <div class="contato-item">
                    <div class="contato-icon">💬</div>
                    <div class="contato-info">
                        <h4>Horário de Atendimento</h4>
                        <p>Segunda a Sexta: 8h às 18h</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
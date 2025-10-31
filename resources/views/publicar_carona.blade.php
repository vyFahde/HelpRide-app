@extends('layouts.template')

@section('title', 'Publicar Carona')

@section('content')
<div class="publicar-carona-page" style="background-image: url('{{ asset('assets/images/sobre_bg.jpg') }}');">
    <div class="overlay"></div>
    
<div class="publicar-carona-container">
<h2 class="titulo-carona">Diminua seus custo de viagem com <span class="help-ride-color">HelpRide!</span></h2>

<div class="form-carona-wrapper">
<form action="{{ route('carona.store') }}" method="POST" class="form-carona">
    @csrf
    
    <div class="form-group-carona">
        
        {{-- Campo Saída --}}
        <div class="input-group-carona">
            <label for="origem">
                <span class="dot-icon"></span> Saindo de:
            </label>
            <input type="text" id="origem" name="origem" placeholder="Endereço de partida" required>
        </div>

        {{-- Ícones de troca de origem/destino --}}
        <div class="swap-icon">
            <span class="arrow-up-down">↑↓</span>
        </div>

        {{-- Campo Destino --}}
        <div class="input-group-carona">
            <label for="destino">
                <span class="dot-icon"></span> Indo para:
            </label>
            <input type="text" id="destino" name="destino" placeholder="Endereço de destino" required>
        </div>

        {{-- Número de Passageiros --}}
        <div class="input-group-carona">
            <label for="vagas">
                <span class="passenger-icon"></span> 3 passageiros
            </label>
            <input type="hidden" id="vagas" name="vagas" value="3"> {{-- Mantendo o valor 3 como no protótipo --}}
        </div>

        {{-- Preço --}}
        <div class="input-group-carona price-group">
            <label for="preco">Seu preço:</label>
            <div class="price-input">
                <span class="currency">R$</span>
                <input type="number" id="preco" name="preco" min="0" step="0.01" placeholder="XX,00" required>
            </div>
        </div>

    </div>

    <div class="btn-group-carona">
        <button type="submit" class="btn-publicar">Publicar</button>
        <a href="{{ route('home') }}" class="btn-voltar-c">
            <button type="button" class="btn-voltar-c">Voltar</button>
        </a>
    </div>
</form>
</div>
</div>
</div>
@endsection
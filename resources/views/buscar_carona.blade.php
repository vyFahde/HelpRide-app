@extends('layouts.template')

@section('title', 'Buscar motoristas')

@section('content')
<section class="busca-carona" style="background-image: url('{{ asset('assets/images/sobre_bg.jpg') }}');">
    <div class="overlay"></div>
    <div class="busca-container">
        <h1>Encontre sua <span class="carona">Carona</span></h1>
        <p>Conecte-se com motoristas e passageiros de forma rápida e segura.</p>

        <form id="buscar-carona-form">
            <div class="form-group">
                <label for="origem">De onde você sai?</label>
                <input type="text" id="origem" placeholder="Digite a cidade de origem">
            </div>
            <div class="form-group">
                <label for="destino">Para onde você vai?</label>
                <input type="text" id="destino" placeholder="Digite a cidade de destino">
            </div>
            <div class="form-group">
                <label for="data">Data da viagem</label>
                <input type="date" id="data">
            </div>
            <div class="btn-global">            
                <a href="{{ route('passageiro.painel') }}" class="btn-voltar">
                    <button type="button">Painel de Caronas</button>
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
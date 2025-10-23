@extends('layouts.template')

@section('title', 'Sobre')

@section('content')
<section class="background" style="background-image: url('{{ asset('assets/images/sobre_bg.jpg') }}');">
    <div class="overlay-content">
        <h1>Bem-vindo ao Nosso Sistema de Caronas</h1>
        <p>Conectando passageiros e motoristas de forma acessível e segura.</p>
    </div>
</section>

<section class="sobre">
    <h1>Sobre o Nosso Sistema de Caronas</h1>
    <p>
        O sistema visa conectar passageiros e motoristas que tenham uma rota em comum oferecendo um valor muito abaixo das corridas de outras plataformas, em compensação não deixando o passageiro exatamente em seu destino final, mas em algum ponto da rota que o motorista já iria originalmente passar, as caronas são feitas apenas de carro, possuindo duas categorias de carro, das quais o passageiro pode escolher ao inserir qual o destino desejado.
    </p>

    <h2>Nossa Missão</h2>
    <p>
        Tornar as viagens mais acessíveis, econômicas e seguras, oferecendo uma alternativa de transporte
        que valoriza a colaboração entre as pessoas.
    </p>
</section>
@endsection
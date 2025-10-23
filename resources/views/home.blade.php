@extends('layouts.template')

@section('title', 'HelpRide')

@section('content')
<section class="topo-do-site">
  <div class="interface">
    <div class="flex">
      <div class="txt-topo-site">
        <h1><span class="letra-e">E</span>ncontre a <span class="carona">carona</span> perfeita para você</h1>
        <p>Conectando motoristas e passageiros para viagens compartilhadas</p>
        <div class="btn-global">

          <a href="{{ route('passageiro.buscar') }}"><button>Buscar carona</button></a>
        </div>
      </div>

      <div class="img-topo-site">
        <!-- CORRIGIDO: usando asset() -->
        <img src="{{ asset('assets/images/foto_motorista.png') }}" alt="Motorista" width="700" height="500">
      </div>
    </div>
  </div>
</section>

<section class="sobre">
  <div class="valores">
    <div class="card">
      <h3>Confiança</h3>
      <p>Segurança para motoristas e passageiros, com cadastro verificado.</p>
    </div>
    <div class="card">
      <h3>Sustentabilidade</h3>
      <p>Menos carros nas ruas, menos poluição, mais qualidade de vida.</p>
    </div>
    <div class="card">
      <h3>Economia</h3>
      <p>Conectar pessoas que compartilham o mesmo destino e valores.</p>
    </div>
  </div>
</section>
@endsection
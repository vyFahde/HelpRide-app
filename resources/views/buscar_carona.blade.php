@extends('layouts.template')

@section('title', 'HelpRide - Buscar Caronas')

@section('content')
<section class="busca-carona">
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
                <button type="submit">Procurar Carona</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById("buscar-carona-form");
        const popup = document.getElementById("popup");
        const popupMsg = document.getElementById("popup-msg");
        const fecharPopup = document.getElementById("fechar-popup");
        const overlay = document.getElementById("overlay");

        form.addEventListener("submit", function(event) {
            event.preventDefault();

            const origem = document.getElementById("origem").value;
            const destino = document.getElementById("destino").value;
            const data = document.getElementById("data").value;

            if (origem && destino && data) {
                popupMsg.textContent = `Procurando caronas de ${origem} para ${destino} em ${data}...`;
            } else {
                popupMsg.textContent = "Por favor, preencha todos os campos!";
            }

            popup.style.display = "block";
            overlay.style.display = "block";
        });

        fecharPopup.addEventListener("click", function() {
            popup.style.display = "none";
            overlay.style.display = "none";
        });

        overlay.addEventListener("click", function() {
            popup.style.display = "none";
            overlay.style.display = "none";
        });
    });
</script>
@endpush
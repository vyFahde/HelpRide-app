@extends('layouts.template')

@section('title', 'Painel de caronas')

@section('content')
<div class="search-page">
            <div class="search-header">
                <div class="search-inputs">
                    <div class="input-group">
                        <label>Saindo de:</label>
                        <input type="text" placeholder="Cidade ou endereço" value="">
                    </div>
                    <div class="input-group">
                        <label>Indo para:</label>
                        <input type="text" placeholder="Cidade ou endereço" value="">
                    </div>
                    <div class="input-group" style="flex: 0 0 180px;">
                        <label>Data:</label>
                        <input type="date" value="2025-10-22">
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                <aside class="filters-sidebar">
                    <h3>Ordenar por</h3>
                    <div class="filter-section">
                        <div class="filter-option">
                            <input type="radio" id="horario" name="ordenar" checked>
                            <label for="horario">Horário mais próximo</label>
                        </div>
                        <div class="filter-option">
                            <input type="radio" id="preco" name="ordenar">
                            <label for="preco">Menor preço</label>
                        </div>
                        <div class="filter-option">
                            <input type="radio" id="embarque" name="ordenar">
                            <label for="embarque">Proximidade do ponto de embarque</label>
                        </div>
                        <div class="filter-option">
                            <input type="radio" id="desembarque" name="ordenar">
                            <label for="desembarque">Proximidade do ponto de desembarque</label>
                        </div>
                    </div>

                    <h3 style="margin-top: 30px;">Opcionais</h3>
                    <div class="filter-section">
                        <div class="filter-option">
                            <input type="checkbox" id="mala">
                            <label for="mala">Mala disponível</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="pet">
                            <label for="pet">Pet-friendly</label>
                        </div>
                        <div class="filter-option">
                            <input type="checkbox" id="feminina">
                            <label for="feminina">Motorista feminina</label>
                        </div>
                    </div>
                </aside>

                <!-- Results Container -->
                <div class="results-container">
                    <div class="results-header">
                        <h2>Caronas disponíveis</h2>
                        <span class="results-count">2 caronas encontradas</span>
                    </div>

                    <!-- Ride Card 1 -->
                    <div class="ride-card">
                        <div class="ride-header">
                            <div class="ride-time">
                                <h4>Horário de saída:</h4>
                                <p class="time">16:50</p>
                            </div>
                            <div class="ride-price">
                                <span class="price">R$ 32,00</span>
                            </div>
                        </div>
                        <div class="ride-route">
                            <div class="route-point">
                                <span class="point-label">Ponto de embarque</span>
                                <p class="point-location">Centro da Cidade</p>
                            </div>
                            <div class="route-divider"></div>
                            <div class="route-point">
                                <span class="point-label">Ponto de desembarque</span>
                                <p class="point-location">Aeroporto Internacional</p>
                            </div>
                        </div>
                        <div class="ride-footer">
                            <div class="driver-info">
                                <div class="driver-avatar">MS</div>
                                <div class="driver-details">
                                    <p class="driver-name">Maria Silva</p>
                                    <p class="driver-rating">⭐ Avaliação 4.8</p>
                                </div>
                            </div>
                            <div class="btn-global">
                                <button>Ver detalhes</button>
                            </div>
                        </div>
                    </div>

                    <!-- Ride Card 2 -->
                    <div class="ride-card">
                        <div class="ride-header">
                            <div class="ride-time">
                                <h4>Horário de saída:</h4>
                                <p class="time">16:50</p>
                            </div>
                            <div class="ride-price">
                                <span class="price">R$ 37,50</span>
                            </div>
                        </div>
                        <div class="ride-route">
                            <div class="route-point">
                                <span class="point-label">Ponto de embarque</span>
                                <p class="point-location">Centro da Cidade</p>
                            </div>
                            <div class="route-divider"></div>
                            <div class="route-point">
                                <span class="point-label">Ponto de desembarque</span>
                                <p class="point-location">Aeroporto Internacional</p>
                            </div>
                        </div>
                        <div class="ride-footer">
                            <div class="driver-info">
                                <div class="driver-avatar">RS</div>
                                <div class="driver-details">
                                    <p class="driver-name">Rodrigo Silva</p>
                                    <p class="driver-rating">⭐ Avaliação 4.5</p>
                                </div>
                            </div>
                            <div class="btn-global">
                                <button>Ver detalhes</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
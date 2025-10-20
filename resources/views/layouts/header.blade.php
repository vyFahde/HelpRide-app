<header>
    <div class="interface">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo_dark.png') }}" alt="Logo HelpRide" width="70" height="70">
            </a>
        </div>
        
        <nav class="menu-desktop">
            <ul>
                <li><a href="{{ route('home') }}">Início</a></li>
                <li><a href="{{ route('sobre') }}">Sobre</a></li>
                <li><a href="{{ route('passageiro.buscar') }}">Caronas</a></li>
                <li><a href="#">Suporte</a></li>
            </ul>
        </nav>
        
        <div class="btn-container">
            <div class="btn-global">
                <a href="{{ route('login') }}">
                    <button>Login</button>
                </a>
                <a href="#">
                    <button>Seja um passageiro</button>
                </a>
            </div>
            
            <div class="btn-motorista">
                <a href="{{ route('motorista.cadastrar') }}">
                    <button>Oferecer carona</button>
                </a>
            </div>
        </div>
    </div>
</header>
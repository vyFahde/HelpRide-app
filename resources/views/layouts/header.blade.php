<header>
    <div class="interface">
        <div class="logo">
            <a href="{{route('home') }}">
                <img src="{{ asset('assets/images/logo_dark.png') }}" alt="Logo HelpRide" width="70" height="70">
            </a>
        </div>
        
        <nav class="menu-desktop">
            <ul>
                <li><a href="{{route('home')}}">Início</a></li>
                <li><a href="{{route('sobre')}}">Sobre</a></li>
                @if(Auth::guard('passageiro')->check() || Auth::guard('motorista')->check())                    
                @endif
                <li><a href="{{ Auth::guard('motorista')->check() ? route('carona.publicar') : route('passageiro.buscar') }}">Caronas</a></li>
                <li><a href="{{route('suporte')}}">Suporte</a></li>
            </ul>
        </nav>
        
        <div class="btn-container">
            @if(Auth::guard('passageiro')->check() || Auth::guard('motorista')->check())
                <div class="btn-motorista">
                    {{-- O link para as configurações deve ser criado em routes/web.php e no controller --}}
                    <a href="{{ route('perfil.configuracoes') }}"> 
                        <button>Configurações do Perfil</button>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit">Sair</button>
                    </form>
                </div>
            @else
                <div class="btn-global">
                    <a href="{{route('login') }}">
                        <button>Login</button>
                    </a>
                    <a href="{{route('passageiro.cadastrar') }}">
                        <button>Seja um passageiro</button>
                    </a>
                </div>
                
                <div class="btn-motorista">
                    <a href="{{route('motorista.cadastrar') }}">
                        <button>Seja um motorista</button>
                    </a>
                </div>
            @endif
        </div>
    </div>
</header>

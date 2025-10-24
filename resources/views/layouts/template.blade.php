<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HelpRide')</title>
    
    <link rel="icon" href="{{ asset('assets/images/logo_bright.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo_bright.png') }}" type="image/png">   
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <style>
        .alert-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            padding: 0 20px;
        }
        
        .alert {
            padding: 15px 25px;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    @unless(isset($hideHeader) && $hideHeader === true)
        @include('layouts.header')
    @endunless
    
    <main>
        <!-- MENSAGEM DE ERRO -->
        @if(isset($error) && $error)
        <div class="alert-container">
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        </div>
        @endif
        
        @yield('content')
    </main>
    
    @include('layouts.footer')
</body>
</html>
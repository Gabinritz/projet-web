<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>{{ $title or 'Welcome' }} | BDE eXia.CESI</title>
</head>
<body>
    <header>
        <a href="./"><img src="{{ asset('img/logo.png') }}" alt="Logo du BDE" id="logo"></a>
        <div id="hamburger">
            <div id="hamburger-content">
                <nav>
                    <ul>
                        <a href="{{ route('activities.past') }}"><li class="menu-item-1">ACTIVITÉS PASSÉES</li></a>
                        <a href="{{ route('activities.index') }}"><li class="menu-item-2">ACTIVITÉS</li></a>
                        <a href="{{ route('ideas.index') }}"><li class="menu-item-3">BOITE À IDÉES</li></a>
                        <a href="{{ route('shop.index') }}"><li class="menu-item-4">BOUTIQUE</li></a>
                        <a href="{{ route('login') }}"><li class="menu-item-5">S'INSCRIRE / SE CONNECTER</li></a>
                    </ul>
                    
                </nav>
            </div>
            <button class="button" id="hamburger-button">&#9776</button>
            <div id="hamburger-sidebar">
                <div id="hamburger-sidebar-header">
                    <a href="./" id="logo-link"><img src="{{ asset('img/logo.png') }}" alt="Logo du BDE" id="hamburger-logo"></a>
                </div>
                <div id="hamburger-sidebar-body"></div>
            </div>
            <div id="hamburger-overlay"></div>
        </div>
    </header>

    @yield('content')

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height initial-scale=1.0 maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#d90119" />
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>{{ $title or 'Welcome' }} | BDE eXia.CESI</title>
</head>
<body id="body">
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
                        @if($user)
                        <a href="{{ route('logout') }}"><li class="menu-item-6">SE DÉCONNECTER</li></a>
                        <a href="#"><li class="menu-item-5">{{ $user->firstname .' '. $user->name }}</li></a>
                        @else
                        <a href="{{ route('login') }}"><li class="menu-item-5">S'INSCRIRE / SE CONNECTER</li></a>
                        @endif
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


    <footer>
        <div class="footer__container">
            <div class="footer__top">
                <div class="footer__section footer__about">
                    <h4 class="footer__title">À propos du BDE eXia.CESI Strasbourg</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet rem amet quaerat earum porro totam ea doloremque, sunt ipsam. Consequuntur officiis suscipit cum quisquam necessitatibus, optio corporis porro laudantium ducimus!</p>
                </div>
        
                <div class="footer__section footer__plan">
                    <h4 class="footer__title">Plan du site</h4>
                        <ul class=footer__list>
                            <a href="./"><li>Accueil</li></a>
                            <a href="{{ route('activities.past') }}"><li>Activités passées</li></a>
                            <a href="{{ route('activities.index') }}"><li>Activités à venir</li></a>
                            <a href="{{ route('shop.index') }}"><li>Boutique</li></a>
                        </ul>
                </div>
    
                <div class="footer__section footer__info">
                    <h4 class="footer__title">Localisation</h4>
                    <iframe class="footer__map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d165.03565963863176!2d7.694327887073894!3d48.56062011900846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xcdb8d090067b0191!2sexia.CESI+Strasbourg!5e0!3m2!1sfr!2sfr!4v1523873506920" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
    
            <div class="footer__bot">
                © 2018 - BDE eXia.CESI Strasbourg | <a href="#">Mentions légales</a>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
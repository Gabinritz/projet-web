<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <li><a href="./activite/past">ACTIVITÉS PASSÉES</a></li>
                        <li><a href="./activite">ACTIVITÉS</a></li>
                        <li><a href="./ideasbox">BOITE À IDÉES</a></li>
                        <li><a href="./shop">BOUTIQUE</a></li>
                        <li><a href="./login">S'INSCRIRE / SE CONNECTER</a></li>
                    </ul>
                    
                </nav>
            </div>
            <button id="hamburger-button">&#9776</button>
            <div id="hamburger-sidebar">
                <div id="hamburger-sidebar-header"></div>
                <div id="hamburger-sidebar-body"></div>
            </div>
            <div id="hamburger-overlay"></div>
        </div>
    </header>

    @yield('content')

    <script>
        let content = document.getElementById('hamburger-content')
        let sidebarBody = document.getElementById('hamburger-sidebar-body')
        let button = document.getElementById('hamburger-button')
        let overlay = document.getElementById('hamburger-overlay')
        let activatedClass = 'hamburger-activated'; 
        
        sidebarBody.innerHTML = content.innerHTML; 
        button.addEventListener('click', function(e) { 
            e.preventDefault()
            this.parentNode.classList.add(activatedClass)
        })

        button.addEventListener('keydown', function(e) {
            if (this.parentNode.classList.contains(activatedClass)) { 
                if (e.repeat === false && e.which === 27) {
                    this.parentNode.classList.remove(activatedClass)
                }
            } 
        })
        overlay.addEventListener('click', function(e) {
            e.preventDefault()
            this.parentNode.classList.remove(activatedClass)
        })
    </script>
</body>
</html>
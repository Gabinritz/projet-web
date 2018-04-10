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
        <nav>
            <a href="./activite/past">ACTIVITÉS PASSÉES</a>
            <a href="./activite">ACTIVITÉS</a>
            <a href="./ideasbox">BOITE À IDÉES</a>
            <a href="./shop">BOUTIQUE</a>
            <a href="./login">S'INSCRIRE / SE CONNECTER</a>
        </nav>
    </header>

    @yield('content')

</body>
</html>
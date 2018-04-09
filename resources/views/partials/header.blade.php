<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>BDE eXia.CESI</title>
</head>
<body>
    <header>
        <img src="{{ asset('img/logo.png') }}" alt="Logo du BDE" id="logo">
        <nav>
            <a href="./activite/past">ACTIVITÉS PASSÉES</a>
            <a href="./activite">ACTIVITÉS</a>
            <a href="./ideasbox">BOITE À IDÉES</a>
            <a href="./shop">BOUTIQUE</a>
            <a href="./login">S'INSCRIRE / SE CONNECTER</a>
        </nav>
    </header>
    <div class="accueil">
        @yield('content')
    </div>
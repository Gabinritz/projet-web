@extends ('partials.layout_noheader', ['title' => 'Connexion'])

@section ('content')
<div class="top">
    <div class="login__head">
        <a href="./" id="login__logo"><img src="{{ asset('img/logo.png') }}" alt="Logo du BDE" id="login__logo"></a>
    </div>
</div>

<div class="card login__card" id="login">
    <h2>Connexion</h2>
    <form action="" method="post" class="login__form">
        <div class="group">      
            <input type="text" required>
            <span class="bar"></span>
            <label>Adresse mail</label>
        </div>
        
        <div class="group">      
            <input type="password" required>
            <span class="bar"></span>
            <label>Mot de passe</label>
        </div>

        <div class="submit">
            <button type="submit" class="btn login__submit">SE CONNECTER</button>
        </div>
    </form>
    <p class="login__noaccount">Vous n'avez pas de compte ? <span class="login__change" onclick="changeLogin(1)">Inscrivez-vous</span></p>
</div>

<div class="card login__card hidden" id="register">
    <h2>Inscription</h2>
    <form action="" method="post" class="login__form">
        <div class="group">      
            <input type="text" required>
            <span class="bar"></span>
            <label>Nom</label>
        </div>
        <div class="group">      
            <input type="text" required>
            <span class="bar"></span>
            <label>Prénom</label>
        </div>
        <div class="group">      
            <input type="text" required>
            <span class="bar"></span>
            <label>Adresse mail</label>
        </div>
        <div class="group">      
            <input type="password" required>
            <span class="bar"></span>
            <label>Mot de passe</label>
        </div>

        <div class="submit">
            <button type="submit" class="btn login__submit">S'INSCRIRE</button>
        </div>
    </form>
    <p class="login__noaccount">Vous avez déjà un compte ? <span class="login__change" onclick="changeLogin(0)">Connectez-vous</span></p>
    </div>

<div class="bot"></div>

<script src="{{ asset('js/main.js') }}"></script>
@endsection

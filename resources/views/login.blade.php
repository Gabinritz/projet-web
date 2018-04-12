@extends ('partials.layout_noheader', ['title' => 'Connexion'])

@section ('content')
<div class="top">
    <div class="login__head">
        <a href="./" id="login__logo"><img src="{{ asset('img/logo.png') }}" alt="Logo du BDE" id="login__logo"></a>
    </div>
</div>

<div class="card login__card test" id="login">
    <h2>Connexion</h2>
    <form method="POST" class="form login__form" action="{{ route('logtry') }}">
        @csrf
        <div class="group">      
            <input type="email" 
            name="email" 
            value="{{ old('email') }}" 
            required autofocus>
            <span class="bar"></span>
            <label>Adresse mail</label>
        </div>
        
        <div class="group">      
            <input type="password" 
            name="password" 
            required>
            <span class="bar"></span>
            <label>Mot de passe</label>
        </div>

        <div class="submit">
            <button type="submit" class="btn login__submit">SE CONNECTER</button>
        </div>
    </form>
    <p class="login__noaccount">Vous n'avez pas de compte ? <span class="login__change" onclick="changeLogin(1)">Inscrivez-vous</span></p>
</div>

<div class="card login__card hidden test" id="register">
    <h2>Inscription</h2>
    <form method="POST" action="{{ route('registertry') }}" class="form login__form">
        @csrf
            <div class="group">      
                <input type="text" 
                name="name" 
                value="{{ old('name') }}" required autofocus>
                <span class="bar"></span>
                <label>Nom</label>
            </div>
            <div class="group">      
                <input type="text" name="firstname" value="{{ old('firstname') }}" required>
                <span class="bar"></span>
                <label>Prénom</label>
            </div>
            <div class="group">      
                <input type="email" name="email" value="{{ old('email') }}" required>
                <span class="bar"></span>
                <label>Adresse mail</label>
            </div>
            <div class="group">      
                <input type="password" name="password" required>
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
@endsection

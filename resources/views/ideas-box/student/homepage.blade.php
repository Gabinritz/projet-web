@extends ('partials.layout', ['title' => 'Boite à idées'])

@section ('content')
<div class="container">
<button class="btn" onclick="show()">AJOUTER UNE IDÉE</button>
<div class="card hidden" id="addIdea">
    <h2>Connexion</h2>
    <form action="" method="post" class="form login__form">
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
</div>

<div style="overflow-x: auto;">
<table>
    <tr>
        <th>Activité</th>
        <th>Organisateur</th>
        <th>Description</th>
        <th>Voter</th>
    </tr>
    <tr>
        <td>Football</td>
        <td>Acker Clément</td>
        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas, non cupiditate incidunt officia error quis facilis repellat eaque maxime, ut quidem distinctio illum unde esse sed expedita quaerat voluptate impedit?</td>
        <td>
            <i class="material-icons thumb">thumb_up</i>
            <span class="likes">8</span>
        </td>
    </tr>
    <tr>
        <td>Pokémon GO</td>
        <td>Pierre Dumangin</td>
        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus deleniti sapiente nam architecto, ex nesciunt! Perferendis sed, architecto consectetur eum delectus eligendi, iusto dolorem consequatur ab consequuntur soluta, possimus recusandae.</td>
        <td>
            <i class="material-icons thumb">thumb_up</i>
            <span class="likes">15</span>
        </td>
    </tr>
    <tr>
        <td>Médecin du sommeil</td>
        <td>Antoine Daeffler</td>
        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia fugiat aspernatur voluptatem voluptatum iusto, minus, eveniet doloremque, ipsam nobis sequi molestiae voluptas nesciunt possimus commodi esse quo laboriosam sint repellendus!</td>
        <td>
            <i class="material-icons thumb">thumb_up</i>
            <span class="likes">0</span>
        </td>
    </tr>
</table>
</div>

<script>
    function show() {
        let card = document.getElementById('addIdea')
        card.classList.remove('hidden')
        card.classList.add('visible')
    }
</script>
@endsection
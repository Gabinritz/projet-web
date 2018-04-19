@extends ('partials.layout', ['title' => 'Boutique'])
@section('content')

<div class="container" style="text-align: center; margin-top: 32px;">
    <button class="btn product__btn" id="product__add">AJOUTER UN PRODUIT</button>
    <button class="btn product__btn" id="product__del" onclick="deleted()">SUPPRIMER UN PRODUIT</button>
</div>

<div class="general__modal" id="modal__add">
    <div class="general__modal-content">
        <span class="close" id="close__add">&times</span>
        <h4>AJOUT D'UN PRODUIT</h4>
        <form method="POST" action="">
                <div class="group">
                    <input type="text" name="name" onkeyup="checkText(this)">
                    <span class="bar"></span>
                    <label>Nom</label>
                </div>
                <div class="group">      
                    <input type="text" name="categorie" onkeyup="checkText(this)">
                    <span class="bar"></span>
                    <label>Catégorie</label>
                </div>
                <div class="group">      
                    <input type="text" name="price" onkeyup="checkNumber(this)">
                    <span class="bar"></span>
                    <label>Prix</label>
                </div>

                <button type="submit" class="btn general__btn">VALIDER</button>
        </form>
    </div>
</div>

<div class="general__modal" id="modal__del">
    <div class="general__modal-content">
        <span class="close" id="close__del">&times</span>
        <h4>SUPPRESSION D'UN PRODUIT</h4>
        <form method="POST" action="">
                <div class="selectfield" style="margin-bottom: 32px;">
                        <select name="category" placeholder="Catégorie">
                            <option value="" disabled selected>Choisir une catégorie</option>
                            @foreach($products as $product)
                                <option value={{$product->id}}>{{$product->name}}</option>
                            @endforeach
                        </select>  
                    </div>
                <button type="submit" class="btn general__btn">VALIDER</button>
        </form>
    </div>
</div>
    

<div class="container">
        <h3 style="margin: 32px 0 16px 0;">Les meilleures ventes</h3>
    </div>
    <div class="container container-activity" style="margin-top: 0; margin-bottom: 64px;">
        @foreach($bestsellers as $bestseller)
        <div class="card card__activity">
                <div class="card__header">
                    <img alt="Image" class="card__image" src="{{asset('img/'.$bestseller->imgUrl.'')}}">
                </div>
                <div class="card__content">
                    <div class="card__primary-shop">
                        <div class="card__left">
                            <h3 class="card__title">{{$bestseller->name}}</h3>
                            <h4 class="card__subtitle">{{$bestseller->category}}</h4>
                        </div>
                        <div class="card__right">
                            <span class="card__price">{{$bestseller->price}} €</span>
                        </div>
                    </div>
                    <div class="card__text text-shop">
                        <span class="card__description">{{$bestseller->description}}</span>
                    </div>
                    <div class="card__actions">
                            <a href="{{ route('shop.addtocart', ['productId' => $bestseller->id]) }}"><button class="card__btn btn__shop">AJOUTER AU PANIER</button></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

<div class="container" style="margin-top: 48px;">
    <span class="seeShop"><a href="{{route('shop.shoppingcart')}}">Voir mon panier</a></span><br><br>
        <h3>Affiner la recherche</h3>
    <form action="{{route('shop.index')}}" method="post" id="selectCategory">
        <div class="selectfield">
            <select name="category" placeholder="Catégorie">
                <option value="" disabled selected>Choisir une catégorie</option>
                @foreach($categories as $category)
                    <option value={{$category->category}}>{{$category->category}}</option>
                @endforeach
            </select>  
        </div>
        {{ csrf_field() }}
        <button type="submit" id="categorybtn" class="btn">FILTRER</button><br><br>
    </form>
    <div class="group">      
            <input type="text" name="search" id="search" onkeyup="checkSearch(this)">
            <span class="bar"></span>
            <label>Rechercher</label>
        </div>
</div>


<div class="container">
        <h3  style="margin: 32px 0 16px 0;">Tous les articles</h3>
    </div>
<div class="container container-activity container-shop"  id="filter" style="margin-top: 0;">
    @foreach($products as $product)
    <div class="card card__activity">
        <div class="card__header">
            <img alt="Image" class="card__image" src="{{asset('img/'.$product->imgUrl.'')}}">
        </div>
        <div class="card__content">
            <div class="card__primary-shop">
                <div class="card__left">
                    <h3 class="card__title">{{$product->name}}</h3>
                    <h4 class="card__subtitle">{{$product->category}}</h4>
                </div>
                <div class="card__right">
                    <span class="card__price">{{$product->price}} €</span>
                </div>
            </div>
            <div class="card__text text-shop">
                <span class="card__description">{{$product->description}}</span>
            </div>
            <div class="card__actions">
                    <a href="{{ route('shop.addtocart', ['productId' => $product->id]) }}"><button class="card__btn btn__shop">AJOUTER AU PANIER</button></a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/shop.js') }}"></script>
@endsection
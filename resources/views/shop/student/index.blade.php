@extends ('partials.layout', ['title' => 'Activités à venir'])

@section ('content')
<div class="container container-activity">
{{-- @if (1) (!$ideas->isEmpty()) [MEMBRE DU BDE] --}}
<div class="card card__activity">
    <div class="card__header">
        <img alt="Image" class="card__image" src="{{asset('img/img1.jpg')}}">
    </div>
    <div class="card__content">
        <div class="card__primary-shop">
            <div class="card__left">
                <h3 class="card__title">Nom du produit</h3>
                <h4 class="card__subtitle">Catégorie du produit</h4>
            </div>
            <div class="card__right">
                <span class="card__price">999.99 €</span>
            </div>
        </div>
        <div class="card__text text-shop">
            <span class="card__description">Description du produit</span>
        </div>
        <div class="card__actions">
                <a href="#"><button class="card__btn btn__shop">AJOUTER AU PANIER</button></a>
        </div>
    </div>
</div>
{{-- @else
    <p>Aucune activité à venir</p>
@endif --}}
</div>
@endsection
@extends ('partials.layout', ['title' => 'Boite à idées'])
@section('content')

    <div>Affiner la recherche</div>
    <form action="{{route('shop.index')}}" method="post">
        <select name="category" placeholder="Catégorie">
            @foreach($categories as $category)
                <option value={{$category->category}}>{{$category->category}}</option>
            @endforeach
        </select>
        {{ csrf_field() }}
        <input type="submit">
    </form>
    <span>Balise de recherche</span>
    <span><a href="{{route('shop.shoppingcart')}}">Voir mon panier</a></span>

    <div>Les meilleures ventes</div>
    @foreach($bestsellers as $bestseller)
    <div>{{$bestseller->name}}</div>
    <div>{{$bestseller->category}}</div>
    <div>{{$bestseller->description}}</div>
    <div>{{$bestseller->price}}</div>
    <div><a href="{{ route('shop.addtocart', ['productId' => $bestseller->id]) }}">Ajouter au panier</a></div>
    @endforeach
    <div>Tous les articles</div>
    @foreach($products as $product)
    <div>{{$product->name}}</div>
    <div>{{$product->category}}</div>
    <div>{{$product->description}}</div>
    <div>{{$product->price}}</div>
    <a href="{{ route('shop.addtocart', ['productId' => $product->id]) }}">Ajouter au panier</a>
    @endforeach
@endsection

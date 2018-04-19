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

@extends ('partials.layout', ['title' => 'Boite à idées'])
@section('content')
    <div>Mon Panier</div>
    @if(!count($products))
    <div>Panier vide</div>
    @endif
    @foreach($products as $product)
    <div>{{$product->name}}</div>
    <div>{{$product->price}}</div>
    <div><a href="{{route('shop.removefromcart', ['shoppingCartId' => $product->id])}}">Retirer du panier</a></div>
    @endforeach
    <div>Prix total</div>
    <button><a href="{{route('shop.order')}}">Commander</a></button>
@endsection
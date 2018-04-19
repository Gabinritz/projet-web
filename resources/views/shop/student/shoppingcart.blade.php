@extends ('partials.layout', ['title' => 'Boite à idées'])
@section('content')
    <div>Mon Panier</div>
    @if(!count($products))
    <div>Panier vide</div>
    @endif
    @foreach($products as $product)
    <div>Nom : {{$product->name}}</div>
    <div>Prix : {{$product->price}}</div>
    <div>Quantité : {{$product->quantity}}</div>
    <div><a href="{{route('shop.removefromcart', ['shoppingCartId' => $product->id])}}">Retirer du panier</a></div>
    @endforeach
<div>Prix total : {{$totalPrice}} euros</div>
    <button><a href="{{route('shop.order')}}">Commander</a></button>
@endsection
@extends ('partials.layout', ['title' => 'Boite à idées'])
@section('content')
<div class="container">
    <h3>Mon Panier</h3>
    @if(!count($products))
    <span>Panier vide</span>
    @endif
    @foreach($products as $product)
    <ul>
        <li>Nom : {{$product->name}}</li>
        <li>Prix : {{$product->price}}</li>
        <li>Quantité : {{$product->quantity}}</li>
        <li><a href="{{route('shop.removefromcart', ['shoppingCartId' => $product->id])}}">Retirer du panier</a></li>
    </ul>
    @endforeach
    <div>Prix total : {{$totalPrice}} euros</div>
    <button><a href="{{route('shop.order')}}">Commander</a></button>
</div>
@endsection
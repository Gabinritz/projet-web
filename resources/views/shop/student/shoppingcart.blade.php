@extends ('partials.layout', ['title' => 'Boite à idées'])
@section('content')
<div class="container" style="text-align: center; margin-top: 2rem;">
    @if (count($products))
    <div style="overflow-x: auto;" id="test">
        <table>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Retirer du panier</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td><a href="{{route('shop.removefromcart', ['shoppingCartId' => $product->id])}}">Retirer du panier</a></td>
                </tr>
            @endforeach
            </table>
        </div>
    @else {{-- [PAS DE DONNEES] --}}
        <p>Panier vide !</p>
    @endif
    
    <p style="margin: 32px 0;">Prix total : <strong style="color:#4CAF50;">{{$totalPrice}} €</strong></p>
    <a href="{{route('shop.order')}}"><button class="btn">Commander</button></a>
</div>
        
</div>
@endsection
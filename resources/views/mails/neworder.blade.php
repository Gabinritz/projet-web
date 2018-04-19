@if($Bde == 0)
<h1>Votre commande a bien été enregistrée</h1>
<br>
<div>Les membres du BDE reviendront vers vous pour définir un lieu et une date de rencontre pour procéder à la transaction</div>
<br>
<div>Les produits commandés sont :</div>
<br>
<ul>
@foreach($products as $product)
<li>Nom : {{$product->name}} | PrixUnité : {{$product->price}} | Quantité : {{$product->quantity}}</li>
@endforeach
</ul>
<br>
<div>Le montant total est de : {{$totalPrice}} euros.</div>
<br>
<div>Cordialement</div>
<br>
<div>Le BDE</div>
@else
<h1>Une commande a été enregistrée</h1>
<br>
<div>Veuillez prendre contact avec {{$user->firstname}} {{$user->name}} via l'adresse mail {{$user->email}} pour définir une date et un lieu de rencontre afin de procéder a la transaction</div>
<br>
<div>Les produits commandés sont :</div>
<br>
<ul>
@foreach($products as $product)
<li>Nom : {{$product->name}} | PrixUnité : {{$product->price}} | Quantité : {{$product->quantity}}</li>
@endforeach
</ul>
<br>
<div>Le montant total est de : {{$totalPrice}} euros.</div>
@endif
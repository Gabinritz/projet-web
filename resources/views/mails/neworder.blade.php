<h1>Votre commande a bien été enregistrée</h1>
<br>
<div>Les membres du BDE reviendront vers vous pour définir un lieu et une date de rencontre pour procéder à la transaction</div>
<br>
<div>Les produits commandés sont :</div>
<br>
<ul>
@foreach($products as $product)
<li>Nom : {{$product->name}} | PrixUnité : {{$product->price}} | Quantité : </li>
@endforeach
</ul>
<br>
<div>Le montant total est de : {{$totalPrice}} euros.</div>
<br>
<div>Cordialement</div>
<br>
<div>Le BDE</div>
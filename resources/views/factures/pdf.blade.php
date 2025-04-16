<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture #{{ $commande->id }}</title>
    <style>
        body { font-family: sans-serif; }
        .titre { font-size: 20px; font-weight: bold; margin-bottom: 10px; }
        .ligne { margin-bottom: 5px; }
    </style>
</head>
<body>

<div class="titre">Facture #{{ $commande->id }}</div>
<p>Date : {{ $commande->created_at->format('d/m/Y H:i') }}</p>
<p>Client : {{ $commande->user->name }}</p>
<hr>
<h4>Détails :</h4>
<ul>
    @foreach($commande->ligneCommandes as $ligne)
        <li class="ligne">{{ $ligne->livre->titre }} - {{ $ligne->quantite }} x {{ number_format($ligne->prix_unitaire, 2) }} F CFA</li>
    @endforeach
</ul>
<p><strong>Total :</strong> {{ number_format($commande->montant_total, 2) }} F CFA</p>
</body>
</html>

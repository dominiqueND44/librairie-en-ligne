<!-- resources/views/emails/commandeConfirmation.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
</head>
<body>
<h1>Merci pour votre commande !</h1>
<p>Bonjour {{ $commande->user->name }},</p>
<p>Nous avons bien reçu votre commande #{{ $commande->id }}.</p>

<p>Résumé de la commande :</p>
<ul>
    @foreach ($commande->ligneCommandes as $ligne)
        <li>{{ $ligne->livre->titre }} - {{ $ligne->quantite }} x {{ $ligne->prix_unitaire }}Francs</li>
    @endforeach
</ul>

<p>Total : {{ $commande->montant_total }}Francs</p>

<p>Nous préparons votre commande et vous enverrons une notification dès qu'elle sera expédiée.</p>

<p>Merci pour votre achat et à bientôt !</p>
</body>
</html>

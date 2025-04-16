<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
</head>
<body style="font-family: sans-serif; background-color: #f9f9f9; padding: 20px;">
<div style="max-width: 600px; margin: auto; background-color: white; padding: 30px; border-radius: 10px;">
    <h2 style="color: #1e40af;">Bonjour {{ $commande->user->name }},</h2>

    <p>Merci pour votre commande n° <strong>#{{ $commande->id }}</strong>.</p>
    <p>Vous trouverez ci-dessous un résumé de votre facture :</p>

    <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
        <thead style="background-color: #1e40af; color: white;">
        <tr>
            <th style="padding: 10px;">Produit</th>
            <th style="padding: 10px;">Quantité</th>
            <th style="padding: 10px;">Prix</th>
        </tr>
        </thead>
        <tbody>
        @foreach($commande->ligneCommandes as $ligne)
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 10px;">{{ $ligne->livre->titre }}</td>
                <td style="padding: 10px;">{{ $ligne->quantite }}</td>
                <td style="padding: 10px;">{{ number_format($ligne->prix_unitaire, 2) }} Fcfa</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" style="padding: 10px; text-align: right;"><strong>Total :</strong></td>
            <td style="padding: 10px;"><strong>{{ number_format($commande->montant_total, 2) }} Fcfa</strong></td>
        </tr>
        </tbody>
    </table>

    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ route('facture.telecharger', $commande->id) }}"
           style="background-color: #1e40af; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px;">
            📄 Télécharger la facture en PDF
        </a>
    </div>

    <p style="margin-top: 30px;">Merci de votre confiance</p>
</div>
</body>
</html>

<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class FactureController extends Controller
{
    // Liste des factures selon le rôle
    public function index()
    {
        if (Auth::user()->is_admin) {
            // Filtrer uniquement les commandes expédiées pour l'admin
            $factures = Commande::with('ligneCommandes')
                ->where('statut', 'expediee')  // Seulement les commandes expédiées
                ->latest()
                ->paginate(10);
        } else {
            // Filtrer uniquement les commandes expédiées pour l'utilisateur
            $factures = Commande::where('user_id', Auth::id())
                ->where('statut', 'expediee')  // Seulement les commandes expédiées
                ->with('ligneCommandes')
                ->latest()
                ->paginate(10);
        }

        return view('factures.index', compact('factures'));
    }

    // Affichage d'une facture (HTML)
    public function show(Commande $facture)
    {
        $this->authorize('view', $facture); // Vérifie l'accès du client

        return view('factures.show', compact('facture'));
    }

    // Téléchargement PDF
    public function telecharger(Commande $facture)
    {
        $this->authorize('view', $facture); // Vérifie l'accès du client

        $pdf = Pdf::loadView('factures.pdf', ['commande' => $facture]);
        return $pdf->download('facture_'.$facture->id.'.pdf');
    }

}

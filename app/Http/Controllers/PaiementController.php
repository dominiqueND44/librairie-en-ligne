<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Paiement::class, 'paiement');
    }

    public function index()
    {
        $this->authorize('viewAny', Paiement::class);
        $paiements = Paiement::with(['commande.user'])
            ->orderBy('date_paiement', 'desc')
            ->paginate(15);

        return view('admin.paiements.index', compact('paiements'));
    }

    public function store(Request $request, Commande $commande)
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0',
            'methode' => 'required|string|max:50'
        ]);

        // Vérifier que la commande n'a pas déjà été payée
        if ($commande->paiement) {
            return back()->with('error', 'Cette commande a déjà été payée');
        }

        // Créer le paiement
        $commande->paiement()->create([
            'montant' => $validated['montant'],
            'methode' => $validated['methode'],
            'date_paiement' => now()
        ]);

        // Mettre à jour le statut de la commande
        $commande->update(['statut' => 'payee']);

        return redirect()->route('admin.commande.index')
            ->with('success', 'Paiement enregistré avec succès');
    }
}

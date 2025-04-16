<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;

class PanierController extends Controller
{
    public function index()
    {
        $panier = session()->get('panier', []);

        $livres = Livre::whereIn('id', array_keys($panier))->get();

        return view('panier.index', compact('livres', 'panier'));
    }
    public function ajouter(Request $request)
    {
        // Récupérer l'id du livre et vérifier la disponibilité
        $livreId = $request->input('livre_id');
        $livre = Livre::find($livreId);

        if ($livre) {
            // Si le livre est déjà dans le panier
            $panier = session()->get('panier', []);

            if (isset($panier[$livreId])) {
                $panier[$livreId]['quantite']++;
            } else {
                $panier[$livreId] = [
                    'titre' => $livre->titre,
                    'prix' => $livre->prix,
                    'quantite' => 1
                ];
            }

            // Sauvegarder le panier dans la session
            session()->put('panier', $panier);

            // Ajouter un message flash pour la confirmation
            return redirect()->route('catalogue.index')->with('message', 'Le livre a été ajouté à votre panier!');
        }

        return redirect()->route('catalogue.index')->with('error', 'Ce livre n\'est pas disponible.');
    }
    public function retirer($id)
    {
        // Vérifier si le panier existe dans la session
        if (session()->has('panier')) {
            // Récupérer le panier depuis la session
            $panier = session('panier');

            // Vérifier si l'élément existe dans le panier
            if (isset($panier[$id])) {
                // Retirer l'élément du panier
                unset($panier[$id]);

                // Mettre à jour le panier dans la session
                session(['panier' => $panier]);

                // Optionnel : afficher un message de succès
                return redirect()->route('panier.index')->with('success', 'Le livre a été retiré du panier.');
            }
        }

        // Si l'élément n'est pas trouvé ou si le panier est vide, rediriger avec un message d'erreur
        return redirect()->route('panier.index')->with('error', 'Le livre n\'a pas été trouvé dans le panier.');
    }
}

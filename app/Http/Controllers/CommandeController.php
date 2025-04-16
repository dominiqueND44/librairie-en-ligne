<?php

namespace App\Http\Controllers;

use App\Mail\CommandeConfirmationMail;
use App\Mail\FactureMail;
use App\Models\Livre;
use App\Models\Commande;
use App\Models\LigneCommande;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    /**
     * Affiche les commandes en fonction du rôle de l'utilisateur.
     * - Client : ses propres commandes
     * - Gestionnaire : toutes les commandes
     */
    public function index()
    {
        // Si l'utilisateur a le rôle de gestionnaire
        if (Auth::user()->can('manage-books')) {
            // Récupérer toutes les commandes avec leurs relations
            $commandes = Commande::with('user', 'ligneCommandes.livre')
                ->latest()
                ->paginate(10);

            // Vue pour les gestionnaires
            return view('admin.commande.index', compact('commandes'));
        } else {
            // Pour les clients : afficher seulement leurs propres commandes
            $commandes = Auth::user()->commandes()
                ->with('ligneCommandes.livre')
                ->latest()
                ->paginate(10);

            // Vue pour les clients
            return view('commandeClient.index', compact('commandes'));
        }
    }

    /**
     * Affiche les détails d'une commande.
     * Accès réservé au propriétaire (client) ou gestionnaire.
     */
    public function show(Commande $commande)
    {
        // Vérifie l'autorisation si l'utilisateur est un client
        if (!Auth::user()->can('manage-books')) {
            $this->authorize('view', $commande);
        }

        // Choix de la vue selon le rôle
        $view = Auth::user()->can('manage-books') ? 'admin.commande.show' : 'commandeClient.show';

        // Charger les relations nécessaires
        return view($view, [
            'commande' => $commande->load('ligneCommandes.livre', 'paiement', 'user')
        ]);
    }

    /**
     * Enregistre une nouvelle commande à partir du panier de session.
     */
    public function store(Request $request)
    {
        // Récupère le panier depuis la session
        $panier = session('panier', []);

        // Vérifie que le panier n'est pas vide
        if (empty($panier)) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        // Calcul du montant total estimé de la commande
        $totalEstime = array_sum(array_map(fn($item) => $item['prix'] * $item['quantite'], $panier));

        // Vérifie si une commande similaire a été déjà passée aujourd'hui
        $commandeExistante = Commande::where('user_id', Auth::id())
            ->where('statut', 'en_attente')
            ->whereDate('created_at', now()->toDateString())
            ->where('montant_total', $totalEstime)
            ->first();

        // Si elle existe déjà, on informe l'utilisateur
        if ($commandeExistante) {
            return redirect()->route('commande.index')->with('info', 'Une commande similaire a déjà été passée aujourd’hui.');
        }

        // Démarrer une transaction pour éviter les incohérences
        DB::transaction(function () use ($panier, $totalEstime, &$commande) {
            $total = 0;

            // Création de la commande avec un montant temporaire à 0
            $commande = Commande::create([
                'user_id' => Auth::id(),
                'statut' => 'en_attente',
                'montant_total' => 0,
            ]);

            // Parcours du panier pour créer chaque ligne de commande
            foreach ($panier as $livreId => $item) {
                $livre = Livre::findOrFail($livreId);

                // Vérifie si le stock est suffisant
                if ($livre->stock < $item['quantite']) {
                    throw new \Exception("Stock insuffisant pour le livre : {$livre->titre}");
                }

                // Création de la ligne de commande
                LigneCommande::create([
                    'commande_id' => $commande->id,
                    'livre_id' => $livre->id,
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $livre->prix,
                ]);

                // Mise à jour du stock
                $livre->decrement('stock', $item['quantite']);

                // Calcul du total
                $total += $livre->prix * $item['quantite'];
            }

            // Mise à jour du montant total
            $commande->update(['montant_total' => $total]);

            // Vidage du panier
            session()->forget('panier');
        });

        // Envoi d’un email de confirmation de commande au client
        Mail::to(Auth::user()->email)->send(new CommandeConfirmationMail($commande));

        // Notification aux gestionnaires
        NotificationController::notifyManagers("Nouvelle commande #{$commande->id} enregistrée par " . Auth::user()->name);

        return redirect()->route('commande.index')->with('success', 'Votre commande a été enregistrée avec succès.');
    }

    /**
     * Mise à jour du statut d'une commande (réservé aux gestionnaires).
     */
    public function updateStatut(Request $request, Commande $commande)
    {
        // Validation du statut fourni (valeurs en minuscule comme dans la vue)
        $request->validate([
            'statut' => 'required|in:en_attente,en_preparation,expediee,payee',
        ]);

        $commande->statut = $request->input('statut');

        // Si la commande est marquée "payee"
        if ($commande->statut === 'payee') {
            // Enregistrer la date d'expédition (si ce n'est pas déjà fait)
            $commande->date_expedition = now();

            // Vérifier s’il n’y a pas déjà un paiement enregistré
            if (!$commande->paiement) {
                // Enregistrement du paiement
                \App\Models\Paiement::create([
                    'commande_id' => $commande->id,
                    'montant' => $commande->montant_total,
                    'methode' => 'especes',
                    'date_paiement' => now(),
                ]);
            }
        }

        // Sauvegarder les modifications
        $commande->save();

        // Si la commande est expédiée, envoyer un mail avec la facture
        if ($commande->statut === 'expediee') {
            \Illuminate\Support\Facades\Mail::to($commande->user->email)
                ->send(new \App\Mail\FactureMail($commande));

            // Envoi d'une notification
            \App\Http\Controllers\NotificationController::notify(
                $commande->user,
                'commande',
                "Votre commande #{$commande->id} a été expédiée. Une facture vous a été envoyée par email."
            );
        }

        return redirect()->route('commande.show', $commande)
            ->with('success', 'Statut de la commande mis à jour.');
    }


    /**
     * Annule une commande non encore payée.
     */
    public function annuler(Commande $commande)
    {
        // On ne peut pas annuler une commande déjà payée
        if ($commande->statut === 'payee') {
            return back()->withErrors(['error' => 'Impossible d’annuler une commande payée.']);
        }

        // Mise à jour du statut
        $commande->update(['statut' => 'annulee']);

        return back()->with('success', 'Commande annulée.');
    }
}

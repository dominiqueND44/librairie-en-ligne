<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use App\Models\Livre;
use App\Models\Categorie;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = [
            'user_name' => $user->name,
            'is_manager' => $user->isManager(),
            'commandes_par_mois' => $this->getCommandesParMois(),
            'livres_par_categorie' => $this->getLivresVendusParCategorie(),

        ];

        if ($user->isManager()) {
            $data['stats'] = $this->getManagerStats();
        } else {
            $data['commandes'] = $this->getClientCommandes($user);
        }


        return view('dashboard', $data);
    }

    protected function getManagerStats()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();



        return [
            // Statistiques de base
            'commandes_en_cours' => Commande::whereIn('statut', ['en_attente', 'en_preparation'])->count(),
            'commandes_validees' => Commande::whereDate('created_at', $today)
                ->where('statut', 'expediee')
                ->count(),
            'recettes_journalieres' => Commande::whereDate('created_at', $today)
                ->where('statut', '!=', 'annulee')
                ->sum('montant_total'),
            'stock_bas' => Livre::where('stock', '<', 5)
                ->where('disponible', true)
                ->count(),

            // Données pour graphiques
            'commandes_par_mois' => $this->getCommandesParMois(),
            'livres_par_categorie' => $this->getLivresVendusParCategorie()

        ];
    }


    protected function getCommandesParMois()
    {
        $months = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->translatedFormat('M Y');

            $count = Commande::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->where('statut', '!=', 'annulee')
                ->count();

            $data[] = $count;
        }

        return [
            'labels' => $months,
            'data' => $data
        ];
    }

    protected function getLivresVendusParCategorie()
    {
        $categories = Categorie::withCount(['livres as livres_vendus' => function($query) {
            $query->whereHas('ligneCommandes', function($q) {
                $q->whereHas('commande', function($q) {
                    $q->where('statut', '!=', 'annulee')
                        ->where('created_at', '>=', Carbon::now()->subMonth());
                });
            });
        }])->get();

        return [
            'labels' => $categories->pluck('libelle')->toArray(),
            'data' => $categories->pluck('livres_vendus')->toArray()
        ];
    }

    protected function getClientCommandes($user)
    {
        return $user->commandes()
            ->with(['ligneCommandes.livre.categorie'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get(); // ⬅️ ici on retourne une collection d’objets
    }

}

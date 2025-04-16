<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Categorie;

class CatalogueController extends Controller
{
    public function index()
    {
        $filters = [
            'categorie' => request('categorie'),
            'auteur' => request('auteur'),
            'prix_max' => request('prix_max'),
            'disponible' => true
        ];

        $query = Livre::query()->with('categorie');

        if ($filters['categorie']) {
            $query->where('categorie_id', $filters['categorie']);
        }

        if ($filters['auteur']) {
            $query->where('auteur', 'like', '%'.$filters['auteur'].'%');
        }

        if ($filters['prix_max']) {
            $query->where('prix', '<=', $filters['prix_max']);
        }

        $query->where('disponible', $filters['disponible']);

        $livres = $query->orderBy('created_at', 'desc')->paginate(12);
        $categories = Categorie::orderBy('libelle')->get();

        return view('catalogue.index', compact('livres', 'categories'));
    }

    public function show(Livre $livre)
    {
        if (!$livre->disponible) {
            abort(404, 'Livre non disponible');
        }

        $livresSimilaires = Livre::where('categorie_id', $livre->categorie_id)
            ->where('id', '!=', $livre->id)
            ->where('disponible', true)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('catalogue.show', compact('livre', 'livresSimilaires'));
    }

    public function recherche(Request $request)
    {
        $motCle = $request->input('q');

        $livres = Livre::where('titre', 'like', '%' . $motCle . '%')
            ->orWhere('auteur', 'like', '%' . $motCle . '%')
            ->where('disponible', true)
            ->paginate(12);

        $categories = Categorie::orderBy('libelle')->get();

        return view('catalogue.index', compact('livres', 'categories'));
    }
}

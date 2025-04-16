<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class LivreController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Livre::class, 'livre');
    }

    /**
     * Affiche la liste des livres (pour gestionnaire)
     */
    public function index()
    {
        // Récupère tous les livres (même non disponibles)
        $livres = Livre::with('categorie')
            ->orderBy('disponible', 'desc')
            ->orderBy('titre')
            ->paginate(15);

        // Vérifie si le lien symbolique existe et le crée s'il n'existe pas
        if (!file_exists(public_path('storage'))) {
            Artisan::call('storage:link');
        }

        return view('livres.index', [
            'livres' => $livres
        ]);
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('livres.create', [
            'categories' => Categorie::orderBy('libelle')->get()
        ]);
    }

    /**
     * Enregistre un nouveau livre
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'disponible' => 'boolean'
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('livres', 'public');
        }

        // Création du livre
        Livre::create($validated);

        return redirect()->route('livres.index')
            ->with('success', 'Livre ajouté avec succès!');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Livre $livre)
    {
        return view('livres.edit', [
            'livre' => $livre,
            'categories' => Categorie::orderBy('libelle')->get()
        ]);
    }

    /**
     * Met à jour un livre existant
     */
    public function update(Request $request, Livre $livre): \Illuminate\Http\RedirectResponse
    {

        // Validation
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'disponible' => 'boolean'
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprime l'ancienne image si elle existe
            if ($livre->image) {
                Storage::disk('public')->delete($livre->image);
            }
            $validated['image'] = $request->file('image')->store('livres', 'public');
        }

        // Mise à jour du livre
        $livre->update($validated);

        return redirect()->route('livres.index')
            ->with('success', 'Livre mis à jour avec succès!');
    }

    /**
     * Supprime un livre
     */
    public function destroy(Livre $livre)
    {
        // Vérifie qu'aucune commande n'est associée
        if ($livre->ligneCommandes()->exists()) {
            return back()->with('error', 'Ce livre ne peut être supprimé car il est associé à des commande.');
        }

        // Supprime l'image si elle existe
        if ($livre->image) {
            Storage::disk('public')->delete($livre->image);
        }

        $livre->delete();

        return redirect()->route('livres.index')
            ->with('success', 'Livre supprimé avec succès!');
    }
}

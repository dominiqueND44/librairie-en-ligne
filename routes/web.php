<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PanierController;
use Illuminate\Support\Facades\Route;

// Page de connexion
Route::get('/', function () {
    return view('auth/login');
});

// Tableau de bord
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Routes pour les utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Catalogue
    Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue.index');
    Route::get('/catalogue/recherche', [CatalogueController::class, 'recherche'])->name('catalogue.recherche');
    Route::get('/catalogue/{livre}', [CatalogueController::class, 'show'])->name('catalogue.show');

    // Panier
    Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    Route::delete('/panier/{id}/retirer', [PanierController::class, 'retirer'])->name('panier.retirer');

    // Commandes
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commande.index');  // Sans "admin"
    Route::get('/commandes/{commande}', [CommandeController::class, 'show'])->name('commande.show');
    Route::get('/commande/create', [CommandeController::class, 'create'])->name('commande.create');
    Route::post('/commande', [CommandeController::class, 'store'])->name('commande.store');
    Route::put('/commandes/{commande}/statut', [CommandeController::class, 'updateStatut'])->name('commande.statut');
    Route::post('/commandes/{commande}/annuler', [CommandeController::class, 'annuler'])->name('commande.annuler');

    // Factures
    Route::get('/factures', [FactureController::class, 'index'])->name('facture.index');
    Route::get('/factures/{facture}', [FactureController::class, 'show'])->name('facture.show');
    Route::get('/factures/{facture}/telecharger', [FactureController::class, 'telecharger'])->name('facture.telecharger');
});

// Routes admin (gestionnaire)
Route::middleware(['auth', 'can:manage-books'])->group(function () {
    // Gestion des livres
    Route::resource('livres', LivreController::class);

    // Paiements
    Route::get('/admin/paiements', [PaiementController::class, 'index'])->name('admin.paiements.index');
    Route::post('/admin/commande/{commande}/paiement', [PaiementController::class, 'store'])->name('admin.paiements.store');

    // Statistiques
    Route::get('/statistiques', [DashboardController::class, 'statistiques'])->name('statistiques');
});

require __DIR__.'/auth.php';

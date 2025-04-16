<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Livre extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',         // Titre du livre
        'auteur',        // Auteur principal
        'prix',          // Prix unitaire (décimal)
        'image',         // URL/chemin de l'image
        'description',   // Description détaillée
        'stock',         // Quantité disponible (entier)
        'disponible',    // Booléen pour activation/désactivation
        'categorie_id'   // Clé étrangère vers catégorie
    ];

    // Relation avec la catégorie
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    // Relation avec les lignes de commande
    public function ligneCommandes(): HasMany
    {
        return $this->hasMany(LigneCommande::class);
    }

    // Vérifie si le livre est en stock
    public function estEnStock(): bool
    {
        return $this->stock > 0 && $this->disponible;
    }
}

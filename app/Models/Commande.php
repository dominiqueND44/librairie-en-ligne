<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Commande extends Model
{
    protected $fillable = [
        'user_id', 'statut', 'montant_total', 'date_expedition'
    ];

    // Relation avec l'utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les lignes de commande
    public function ligneCommandes(): HasMany
    {
        return $this->hasMany(LigneCommande::class);
    }

    // Relation avec le paiement
    public function paiement(): HasOne
    {
        return $this->hasOne(Paiement::class);
    }


}

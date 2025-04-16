<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LigneCommande extends Model
{
    protected $fillable = [
        'commande_id', 'livre_id', 'quantite', 'prix_unitaire'
    ];

    // Relation avec la commande
    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class);
    }

    // Relation avec le livre
    public function livre(): BelongsTo
    {
        return $this->belongsTo(Livre::class);
    }
}

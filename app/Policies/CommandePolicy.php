<?php

namespace App\Policies;
namespace App\Policies;

use App\Models\Commande;
use App\Models\User;

class CommandePolicy
{
    /**
     * Voir toutes les commandes (admin seulement).
     */
    public function viewAny(User $user): bool
    {
        return $user->isManager(); // Ou tout autre logique selon ton système de rôles
    }

    /**
     * Voir une commande précise (admin OU propriétaire).
     */
    public function view(User $user, Commande $commande): bool
    {
        return $user->isManager() || $commande->user_id === $user->id;
    }

    /**
     * Créer une commande (tout utilisateur connecté).
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Modifier une commande (admin seulement ou selon état).
     */
    public function update(User $user, Commande $commande): bool
    {
        return $user->isManager();
    }

    /**
     * Supprimer une commande (admin seulement).
     */
    public function delete(User $user, Commande $commande): bool
    {
        return $user->isManager();
    }

    /**
     * Restaurer une commande (admin seulement).
     */
    public function restore(User $user, Commande $commande): bool
    {
        return $user->isManager();
    }

    /**
     * Supprimer définitivement une commande (admin seulement).
     */
    public function forceDelete(User $user, Commande $commande): bool
    {
        return $user->isManager();
    }
}


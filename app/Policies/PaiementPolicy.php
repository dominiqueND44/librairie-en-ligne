<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Paiement;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaiementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isManager();
    }

    public function view(User $user, Paiement $paiement)
    {
        return $user->isManager();
    }

    public function create(User $user)
    {
        return $user->isManager();
    }
}

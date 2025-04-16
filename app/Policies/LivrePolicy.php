<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Livre;
use Illuminate\Auth\Access\HandlesAuthorization;

class LivrePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isManager();
    }

    public function view(User $user, Livre $livre)
    {
        return $user->isManager();
    }

    public function create(User $user)
    {
        return $user->isManager();
    }

    public function update(User $user, Livre $livre)
    {

        return $user->isManager();
    }

    public function delete(User $user, Livre $livre)
    {
        return $user->isManager();
    }

}

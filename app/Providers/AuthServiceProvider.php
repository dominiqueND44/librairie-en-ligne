<?php

namespace App\Providers;

use App\Models\Commande;
use App\Models\Livre;
use App\Models\Paiement;
use App\Models\User;
use App\Policies\CommandePolicy;
use App\Policies\LivrePolicy;
use App\Policies\PaiementPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Livre::class => LivrePolicy::class,
        Paiement::class => PaiementPolicy::class,
        Commande::class => CommandePolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();

        // Définir la gate 'manage-books'
        Gate::define('manage-books', function (User $user) {
            return $user->isManager();
        });

        // Vous pouvez aussi définir d'autres gates ici
        Gate::define('manage-paiements', function (User $user) {
            return $user->isManager();
        });
    }
}

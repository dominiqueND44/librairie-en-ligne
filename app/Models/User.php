<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Rôles disponibles
    public const ROLE_MANAGER = 'gestionnaire';
    public const ROLE_CUSTOMER = 'client';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    // Relation avec les commande
    public function commandes(): HasMany
    {
        return $this->hasMany(Commande::class);
    }

    // Relation avec les notifications
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Vérifie si l'utilisateur est un gestionnaire
     */
    public function isManager(): bool
    {
        return $this->role === self::ROLE_MANAGER;
    }

    /**
     * Vérifie si l'utilisateur est un client
     */
    public function isCustomer(): bool
    {
        return $this->role === self::ROLE_CUSTOMER;
    }

    /**
     * Scope pour les gestionnaires
     */
    public function scopeManagers($query)
    {
        return $query->where('role', self::ROLE_MANAGER);
    }

    /**
     * Scope pour les clients
     */
    public function scopeCustomers($query)
    {
        return $query->where('role', self::ROLE_CUSTOMER);
    }
}

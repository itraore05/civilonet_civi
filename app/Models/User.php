<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;

class User extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_utilisateur';

    protected $fillable = [
        'nom', 'prenoms', 'date_naissance', 'lieu_naissance',
        'email', 'password', 'telephone', 'role'
    ];

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'id_utilisateur');
    }

    public function demandesTraitees()
    {
        return $this->hasMany(Demande::class, 'id_administrateur');
    }

    public function getFilamentName(): string
    {
        $name = trim(implode(' ', array_filter([$this->prenoms, $this->nom])));
        
        return $name ?: $this->email ?: (string) $this->id_utilisateur;
    }

    public function canAccessPanel($panel): bool
    {
        // Ajoutez ici votre logique de contrôle d'accès si nécessaire
        return true;
    }
}
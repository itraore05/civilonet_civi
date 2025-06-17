<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeMariage extends Model
{
    use HasFactory;
    
    protected $table = 'acte_mariage';
    protected $primaryKey = 'id_acte_mariage';
    
    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'id_demande',
        'nom_epoux',
        'prenoms_epoux',
        'date_naissance_epoux',
        'lieu_naissance_epoux',
        'nom_epouse',
        'prenoms_epouse',
        'date_naissance_epouse',
        'lieu_naissance_epouse',
        'date_mariage',
        'lieu_mariage',
        'numero_acte',
        'annee_acte'
    ];
    
    /**
     * Obtenir la demande associée à cet acte de mariage.
     */
    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_demande');
    }
}
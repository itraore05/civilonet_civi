<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeNaissance extends Model
{
    use HasFactory;
    
    protected $table = 'acte_naissance';
    protected $primaryKey = 'id_acte_naissance';
    
    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'id_demande',
        'nom_enfant',
        'prenoms_enfant',
        'date_naissance_enfant',
        'lieu_naissance_enfant',
        'nom_pere',
        'prenoms_pere',
        'nom_mere',
        'prenoms_mere',
        'numero_acte',
        'annee_acte'
    ];
    
    /**
     * Obtenir la demande associée à cet acte de naissance.
     */
    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_demande');
    }
}
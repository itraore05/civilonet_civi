<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeDeces extends Model
{
    use HasFactory;
    
    protected $table = 'acte_deces';
    protected $primaryKey = 'id_acte_deces';
    
    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'id_demande',
        'nom_defunt',
        'prenoms_defunt',
        'date_naissance_defunt',
        'lieu_naissance_defunt',
        'date_deces',
        'lieu_deces',
        'numero_acte',
        'annee_acte'
    ];
    
    /**
     * Obtenir la demande associée à cet acte de décès.
     */
    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_demande');
    }
}
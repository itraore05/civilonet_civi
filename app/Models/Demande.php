<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    
    protected $table = 'demandes';
    protected $primaryKey = 'id_demande';
    
    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array
     */
    protected $fillable = [
        'id_utilisateur',
        'type_acte',
        'statut_demande',
        'date_demande',
        'commentaire',
        'reference',
        'transaction_id',
        'montant',
        'methode_paiement',
        'statut_paiement',
        'date_paiement',
        'pdf_path',
        'date_traitement',
        'raison_echec'
    ];
    
    /**
     * Les valeurs par défaut des attributs.
     *
     * @var array
     */
    protected $attributes = [
        'statut_demande' => 'en_attente_paiement',
        'statut_paiement' => 'en_attente'
    ];
    
    /**
     * Obtenir l'utilisateur associé à la demande.
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }
    
    /**
     * Obtenir l'acte de naissance associé à la demande.
     */
    public function acteNaissance()
    {
        return $this->hasOne(ActeNaissance::class, 'id_demande');
    }
    
    /**
     * Obtenir l'acte de mariage associé à la demande.
     */
    public function acteMariage()
    {
        return $this->hasOne(ActeMariage::class, 'id_demande');
    }
    
    /**
     * Obtenir l'acte de décès associé à la demande.
     */
    public function acteDeces()
    {
        return $this->hasOne(ActeDeces::class, 'id_demande');
    }
    
    /**
     * Scope pour les demandes payées
     */
    public function scopePayees($query)
    {
        return $query->where('statut_paiement', 'paye');
    }
    
    /**
     * Scope pour les demandes en attente de paiement
     */
    public function scopeEnAttentePaiement($query)
    {
        return $query->where('statut_paiement', 'en_attente');
    }
    
    /**
     * Scope pour les demandes avec paiement échoué
     */
    public function scopePaiementEchoue($query)
    {
        return $query->where('statut_paiement', 'echoue');
    }
    
    /**
     * Vérifie si le paiement a été effectué
     */
    public function estPayee()
    {
        return $this->statut_paiement === 'paye';
    }
}
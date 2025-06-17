<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;

class DemandeController extends Controller
{
    public function index()
    {
        return Demande::with(['utilisateur', 'acteNaissance', 'acteMariage', 'acteDeces'])->get();
    }

    public function store(Request $request)
    {
        $demande = Demande::create($request->all());
        
        switch($request->type_acte) {
            case 'naissance':
                $demande->acteNaissance()->create($request->acte_data);
                break;
            case 'mariage':
                $demande->acteMariage()->create($request->acte_data);
                break;
            case 'deces':
                $demande->acteDeces()->create($request->acte_data);
                break;
        }

        return response()->json($demande, 201);
    }

    public function updateStatut(Request $request, Demande $demande)
    {
        $demande->update(['statut_demande' => $request->statut]);
        return response()->json($demande, 200);
    }
    public function cancel(Demande $demande)
    {
        // Mise à jour du statut de la demande
        $demande->update(['statut_demande' => 'annulée']);
    
        // Rediriger vers le dashboard
        return redirect()->route('citoyen.dashboard')->with('success', 'Demande annulée avec succès.');
    }
    

}
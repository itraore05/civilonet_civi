<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DemandesController extends Controller
{
    /**
     * Affiche le tableau de bord des demandes pour le citoyen
     */
    public function citoyenDemandes()
    {
        $user = Auth::user();
        
        // Récupère toutes les demandes avec pagination
        $demandes = Demande::where('id_utilisateur', $user->id)
            ->with(['acteNaissance', 'acteMariage', 'acteDeces'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        // Convertit les statuts pour l'affichage
        $demandes->transform(function ($item) {
            if ($item->statut_demande === 'en_traitement') {
                $item->statut_demande = 'en_cours';
            }
            return $item;
        });

        // Récupère spécifiquement les demandes traitées et rejetées
        $demandesTraitees = Demande::where('id_utilisateur', $user->id)
            ->where('statut_demande', 'traitee')
            ->orderBy('date_traitement', 'desc')
            ->take(5)
            ->get();

        $demandesRejetees = Demande::where('id_utilisateur', $user->id)
            ->where('statut_demande', 'rejetee')
            ->orderBy('date_traitement', 'desc')
            ->take(5)
            ->get();

        // Statistiques des demandes
        $stats = [
            'total' => Demande::where('id_utilisateur', $user->id)->count(),
            'traitees' => $demandesTraitees->count(),
            'en_cours' => Demande::where('id_utilisateur', $user->id)
                                ->whereIn('statut_demande', ['en_cours', 'en_traitement'])
                                ->count(),
            'rejetees' => $demandesRejetees->count()
        ];

        return view('citoyen.demandes', compact(
            'demandes',
            'demandesTraitees',
            'demandesRejetees',
            'stats'
        ));
    }

    /**
     * Télécharge le PDF d'une demande traitée
     */
    public function telechargerPdf($id)
    {
        $user = Auth::user();
        $demande = Demande::where('id_demande', $id)
            ->where('id_utilisateur', $user->id)
            ->first();
        
        if (!$demande || $demande->statut_demande !== 'traitee' || !$demande->pdf_path) {
            return redirect()->back()->with('error', 'Le document PDF n\'est pas disponible');
        }
        
        $filePath = storage_path('app/' . $demande->pdf_path);
        
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Le fichier PDF est introuvable');
        }
        
        $fileName = 'acte_' . $demande->type_acte . '_' . $demande->id_demande . '.pdf';
        
        return response()->download($filePath, $fileName);
    }

    /**
     * Affiche les détails d'une demande spécifique
     */
    public function show($id)
    {
        $user = Auth::user();
        $demande = Demande::with(['acteNaissance', 'acteMariage', 'acteDeces'])
            ->where('id_demande', $id)
            ->where('id_utilisateur', $user->id)
            ->firstOrFail();
        
        // Conversion du statut pour l'affichage
        if ($demande->statut_demande === 'en_traitement') {
            $demande->statut_demande = 'en_cours';
        }

        // Ajout des informations de traitement si disponible
        if ($demande->statut_demande === 'rejetee' || $demande->statut_demande === 'traitee') {
            $demande->load('validation'); // Charge les informations de validation si la relation existe
        }

        return view('citoyen.demande-detail', compact('demande'));
    }
}
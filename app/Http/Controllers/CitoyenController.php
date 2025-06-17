<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CitoyenController extends Controller
{
    public function dashboard()
    {
        // Récupère les demandes paginées de l'utilisateur
        $demandes = Demande::where('id_utilisateur', auth()->id())
                          ->with(['acteNaissance', 'acteMariage', 'acteDeces'])
                          ->orderBy('date_demande', 'desc')
                          ->paginate(5);
        
        // Conversion du statut pour l'affichage
        $demandes->transform(function ($demande) {
            if ($demande->statut_demande === 'en_traitement') {
                $demande->statut_demande = 'en_cours';
            }
            return $demande;
        });

        // Dernière demande traitée (pour le lien direct)
        $derniereDemande = Demande::where('id_utilisateur', auth()->id())
                                 ->where('statut_demande', 'traitee')
                                 ->latest()
                                 ->first();

        // Statistiques
        $stats = [
            'total' => Demande::where('id_utilisateur', auth()->id())->count(),
            'traitees' => Demande::where('id_utilisateur', auth()->id())
                                ->where('statut_demande', 'traitee')
                                ->count(),
            'en_cours' => Demande::where('id_utilisateur', auth()->id())
                                ->whereIn('statut_demande', ['en_cours', 'en_traitement'])
                                ->count(),
            'rejetees' => Demande::where('id_utilisateur', auth()->id())
                                ->where('statut_demande', 'rejetee')
                                ->count(),
            'naissance' => Demande::where('id_utilisateur', auth()->id())
                                ->where('type_acte', 'naissance')
                                ->count(),
            'mariage' => Demande::where('id_utilisateur', auth()->id())
                                ->where('type_acte', 'mariage')
                                ->count(),
            'deces' => Demande::where('id_utilisateur', auth()->id())
                                ->where('type_acte', 'deces')
                                ->count()
        ];

        return view('citoyen.dashboard', compact('demandes', 'stats', 'derniereDemande'));
    }

    public function showDemande(Demande $demande)
    {
        if ($demande->id_utilisateur !== auth()->id()) {
            abort(403);
        }
    
        $demande->load(['acteNaissance', 'acteMariage', 'acteDeces']);
        
        // Convertir "en_traitement" en "en_cours" pour l'affichage
        if ($demande->statut_demande === 'en_traitement') {
            $demande->statut_demande = 'en_cours';
        }
    
        return view('citoyen.demande-show', compact('demande'));
    }
    

    public function profile()
    {
        $user = Auth::user();
        return view('citoyen.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenoms' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id_utilisateur.',id_utilisateur',
            'telephone' => 'required|string|max:20',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
        ]);

        $user->update($request->all());

        return redirect()->route('citoyen.profile')
                         ->with('success', 'Profil mis à jour avec succès');
    }

    /**
     * Méthode statique pour effacer le cache d'un utilisateur
     * 
     * @param int $userId ID de l'utilisateur
     */
    public static function clearUserCache($userId)
    {
        // Effacer le cache spécifique à l'utilisateur
        Cache::forget('user_stats_'.$userId);
        Cache::forget('user_demandes_'.$userId);
        
        // Vous pouvez ajouter d'autres clés de cache si nécessaire
        // Cache::forget('autre_cache_'.$userId);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;

class DocumentControllerdoal extends Controller
{
    /**
     * Télécharger un document associé à une demande
     *
     * @param int $demandeId
     * @return \Illuminate\Http\Response
     */
    public function telechargerDocument($demandeId)
    {
        // Vérifier que l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour accéder à ce document.');
        }

        // Récupérer la demande
        $demande = Demande::findOrFail($demandeId);

        // Vérifier que l'utilisateur est autorisé à télécharger ce document
        if ($demande->id_utilisateur !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Vous n\'êtes pas autorisé à télécharger ce document.');
        }

        // Vérifier que la demande a un document PDF associé
        if (!$demande->pdf_path) {
            return back()->with('error', 'Aucun document n\'est disponible pour cette demande.');
        }

        // Vérifier que la demande est traitée
        if ($demande->statut_demande !== 'traitee') {
            return back()->with('error', 'Cette demande n\'a pas encore été traitée.');
        }

        // Vérifier que le fichier existe
        if (!Storage::disk('public')->exists($demande->pdf_path)) {
            return back()->with('error', 'Le document n\'a pas été trouvé sur le serveur.');
        }

        // Générer un nom de fichier significatif basé sur le type d'acte et le numéro de demande
        $fileName = 'Acte_' . ucfirst($demande->type_acte) . '_' . $demande->id_demande . '.pdf';

        // Journaliser le téléchargement
        \Illuminate\Support\Facades\Log::info('Téléchargement de document', [
            'user_id' => Auth::id(),
            'demande_id' => $demandeId,
            'type_acte' => $demande->type_acte,
            'timestamp' => now()
        ]);

        // Retourner le fichier pour téléchargement
        return Storage::disk('public')->download($demande->pdf_path, $fileName);
    }
}
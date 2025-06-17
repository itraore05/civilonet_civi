<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\ActeNaissance;
use App\Models\ActeMariage;
use App\Models\ActeDeces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CitoyenController;
use Filament\Notifications\Notification;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Services\PdfGeneratorService;

class DemandeValidationController extends Controller
{
    protected $pdfGenerator;

    /**
     * Constructeur avec injection du service PdfGeneratorService
     */
    public function __construct(PdfGeneratorService $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    /**
     * Valider une demande et générer un PDF officiel
     */
    public function validerDemande($demandeId, Request $request)
    {
        try {
            $demande = Demande::with(['acteNaissance', 'acteMariage', 'acteDeces'])->find($demandeId);
            
            if (!$demande) {
                return response()->json([
                    'success' => false,
                    'message' => 'Demande introuvable'
                ], 404);
            }
            
            Log::info('Validation de la demande', ['id_demande' => $demandeId, 'type_acte' => $demande->type_acte]);

            $result = $this->pdfGenerator->generatePdf($demandeId);

            if (!$result['success']) {
                Log::error('Erreur génération PDF', [
                    'demande_id' => $demandeId,
                    'message' => $result['message']
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de la génération du PDF: ' . $result['message']
                ], 500);
            }

            $demande->update([
                'statut_demande' => 'traitee',
                'date_traitement' => now()
            ]);

            CitoyenController::clearUserCache($demande->id_utilisateur);

            \App\Models\Notification::create([
                'user_id' => $demande->id_utilisateur,
                'title' => 'Demande traitée',
                'message' => 'Votre demande #'.$demande->id_demande.' (Acte de '.$demande->type_acte.') a été traitée avec succès.',
                'read' => false
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Demande validée avec succès',
                'pdf_path' => $result['path']
            ]);
        } catch (\Exception $e) {
            Log::error('Exception lors de la validation', [
                'id_demande' => $demandeId,
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la validation: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Rejeter une demande
     */
    public function rejeterDemande($demandeId, Request $request)
    {
        try {
            $request->validate(['motif_rejet' => 'required|string|max:500']);

            $demande = Demande::find($demandeId);

            if (!$demande) {
                return response()->json([
                    'success' => false,
                    'message' => 'Demande introuvable'
                ], 404);
            }

            $demande->update([
                'statut_demande' => 'rejetee',
                'motif_rejet' => $request->motif_rejet,
                'date_traitement' => now()
            ]);

            CitoyenController::clearUserCache($demande->id_utilisateur);

            \App\Models\Notification::create([
                'user_id' => $demande->id_utilisateur,
                'title' => 'Demande rejetée',
                'message' => 'Votre demande #'.$demande->id_demande.' a été rejetée. Motif: '.$request->motif_rejet,
                'read' => false
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Demande rejetée avec succès'
            ]);
        } catch (\Exception $e) {
            Log::error('Exception lors du rejet', [
                'id_demande' => $demandeId,
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du rejet: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
 * Afficher le PDF intégré (pour iframe)
 */
public function viewPdf($demandeId)
{
    $demande = Demande::findOrFail($demandeId);
    
    // Vérification des permissions
    if ($demande->id_utilisateur != auth()->id() && !auth()->user()->isAdmin()) {
        abort(403);
    }
    
    $filePath = storage_path('app/private/pdf/' . basename($demande->pdf_path));
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    return response()->file($filePath, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="document.pdf"'
    ]);
}

    /**
     * Télécharger le PDF d'une demande
     */
    public function telechargerPdf($demandeId)
{
    try {
        $demande = Demande::find($demandeId);

        if (!$demande || $demande->statut_demande !== 'traitee' || !$demande->pdf_path) {
            return redirect()->back()->with('error', 'Document non disponible');
        }

        if ($demande->id_utilisateur != auth()->id() && !auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Accès non autorisé');
        }

        $filePath = storage_path('app/private/pdf/' . basename($demande->pdf_path));

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Fichier introuvable');
        }

        $filename = 'acte_'.$demande->type_acte.'_'.$demande->numero_acte.'.pdf';
        return response()->download($filePath, $filename);
    } catch (\Exception $e) {
        Log::error('Exception lors du téléchargement du PDF', [
            'id_demande' => $demandeId,
            'exception' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()->with('error', 'Erreur lors du téléchargement: ' . $e->getMessage());
    }
}

    /**
 * Afficher la vue PDF avec les options de téléchargement
 */
public function showPdfView($demandeId)
{
    $demande = Demande::with(['utilisateur', 'acteNaissance', 'acteMariage', 'acteDeces'])
                     ->findOrFail($demandeId);
    
    if ($demande->id_utilisateur != auth()->id() && !auth()->user()->isAdmin()) {
        abort(403, 'Accès non autorisé');
    }
    
    if ($demande->statut_demande !== 'traitee' || !$demande->pdf_path) {
        return redirect()->route('citoyen.dashboard')
                        ->with('error', 'Le document n\'est pas encore disponible');
    }
    
    // Vérification supplémentaire que le fichier existe
    if (!Storage::exists('private/pdf/'.basename($demande->pdf_path))) {
        return redirect()->route('citoyen.dashboard')
                        ->with('error', 'Le document PDF est introuvable');
    }
    
    return view('demandes.pdf_view', compact('demande'));
}

/**
 * Afficher le PDF intégré (pour iframe)
 */
public function embedPdf($demandeId)
{
    $demande = Demande::findOrFail($demandeId);
    
    // Vérifier les permissions
    if ($demande->id_utilisateur != auth()->id() && !auth()->user()->isAdmin()) {
        abort(403);
    }
    
    $filePath = storage_path('app/' . $demande->pdf_path);
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    return response()->file($filePath);
}

    /**
     * Vérifier l'authenticité d'un acte
     */
    public function verifierActe($uuid)
    {
        try {
            $demande = Demande::where('uuid_verification', $uuid)
                              ->where('statut_demande', 'traitee')
                              ->first();

            if (!$demande) {
                return view('verification.acte', [
                    'uuid' => $uuid,
                    'estValide' => false,
                    'message' => 'Document non reconnu ou invalide'
                ]);
            }

            return view('verification.acte', [
                'uuid' => $uuid,
                'estValide' => true,
                'message' => 'Document officiel authentique',
                'demande' => $demande
            ]);
        } catch (\Exception $e) {
            Log::error('Exception lors de la vérification d\'acte', [
                'uuid' => $uuid,
                'exception' => $e->getMessage()
            ]);

            return view('verification.acte', [
                'uuid' => $uuid,
                'estValide' => false,
                'message' => 'Une erreur est survenue lors de la vérification'
            ]);
        }
    }
}

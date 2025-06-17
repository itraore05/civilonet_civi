<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Demande;

class CinetPayWebhookController extends Controller
{
    public function handleNotification(Request $request)
    {
        Log::info('Notification CinetPay reçue:', $request->all());

        try {
            // Récupérer les données de la requête
            $transactionId = $request->input('cpm_trans_id');
            $status = $request->input('cpm_trans_status');
            $siteId = $request->input('cpm_site_id');
            $custom = $request->input('cpm_custom', '{}'); // métadonnées

            // Analyser les métadonnées (JSON)
            $metadata = json_decode($custom, true) ?: [];
            $demandeId = $metadata['demande_id'] ?? null;

            if (!$demandeId) {
                throw new \Exception('ID de demande non trouvé dans les métadonnées.');
            }

            // Récupérer la demande
            $demande = Demande::find($demandeId);
            if (!$demande) {
                throw new \Exception('Demande non trouvée: ' . $demandeId);
            }

            // Vérifier que le transaction_id correspond
            if ($demande->transaction_id != $transactionId) {
                Log::warning('Transaction ID ne correspond pas:', [
                    'expected' => $demande->transaction_id,
                    'received' => $transactionId
                ]);
            }

            // Mettre à jour le statut de la demande selon le statut du paiement
            if ($status === 'ACCEPTED') {
                $demande->update([
                    'statut_paiement' => 'paye',
                    'statut_demande' => 'en_traitement',
                    'date_paiement' => now()
                ]);
                
                Log::info('Paiement validé pour la demande:', [
                    'demande_id' => $demandeId,
                    'transaction_id' => $transactionId
                ]);
            } else {
                $demande->update([
                    'statut_paiement' => 'echoue',
                    'raison_echec' => 'Statut: ' . $status
                ]);
                
                Log::warning('Paiement non validé pour la demande:', [
                    'demande_id' => $demandeId,
                    'transaction_id' => $transactionId,
                    'status' => $status
                ]);
            }

            return response()->json(['message' => 'Notification traitée avec succès'], 200);

        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement de la notification CinetPay:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'payload' => $request->all()
            ]);
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function returnPage()
    {
        // Cette page est affichée quand l'utilisateur revient du site de paiement
        return view('cinetpay.return');
    }
}
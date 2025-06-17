<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Services\CinetPayService;
use Illuminate\Support\Facades\Log;

class CinetPayController extends Controller
{
    protected $cinetpayService;
    protected $isTestMode;

    public function __construct()
    {
        // Utiliser le mode test (true par défaut)
        $this->isTestMode = env('CINETPAY_TEST_MODE', true);
        
        // Utiliser les identifiants de test ou de production selon le mode
        $siteId = $this->isTestMode ? env('CINETPAY_TEST_SITE_ID', '5876527') : env('CINETPAY_SITE_ID');
        $apiKey = $this->isTestMode ? env('CINETPAY_TEST_API_KEY', '536343584669fc81f88ae14.01842013') : env('CINETPAY_API_KEY');
        
        $this->cinetpayService = new CinetPayService($siteId, $apiKey, $this->isTestMode);

        // Logging pour débogage
        Log::info('CinetPayController initialisé', [
            'mode' => $this->isTestMode ? 'TEST' : 'PRODUCTION',
            'site_id' => $siteId
        ]);
    }

    public function handleNotification(Request $request)
    {
        Log::info('Notification CinetPay reçue:', $request->all());
        
        try {
            $transactionId = $request->input('cpm_trans_id');
            $status = $request->input('cpm_trans_status');
            $custom = $request->input('cpm_custom', '{}'); // métadonnées
            
            // Analyser les métadonnées (JSON)
            $metadata = json_decode($custom, true) ?: [];
            $demandeId = $metadata['demande_id'] ?? null;
            
            // Si l'ID de demande est disponible dans les métadonnées, l'utiliser
            if ($demandeId) {
                $demande = Demande::find($demandeId);
                Log::info('Demande trouvée via metadata:', ['demande_id' => $demandeId]);
            } else {
                // Sinon utiliser le transaction_id
                $demande = Demande::where('transaction_id', $transactionId)->firstOrFail();
                Log::info('Demande trouvée via transaction_id:', ['transaction_id' => $transactionId]);
            }
            
            // Définir les données de mise à jour de base
            $updateData = [
                'methode_paiement' => $request->input('cpm_payment_method', 'Non spécifié'),
                'date_paiement' => now(),
            ];

            // Vérifier le statut du paiement depuis la notification ou via l'API
            if ($status === 'ACCEPTED') {
                $updateData['statut_demande'] = 'en_cours';
                $updateData['statut_paiement'] = 'paye';
                Log::info('Paiement confirmé pour la demande: ' . $demande->id_demande);
            } else {
                // Si le statut n'est pas fourni ou n'est pas "ACCEPTED", vérifier via l'API
                $paymentStatus = $this->cinetpayService->checkPaymentStatus($transactionId);
                
                if ($paymentStatus['code'] === '00') {
                    $updateData['statut_demande'] = 'en_cours';
                    $updateData['statut_paiement'] = 'paye';
                    $updateData['methode_paiement'] = $paymentStatus['data']['payment_method'] ?? $updateData['methode_paiement'];
                    Log::info('Paiement confirmé via API pour la demande: ' . $demande->id_demande);
                } else {
                    $updateData['statut_paiement'] = 'echoue';
                    $updateData['raison_echec'] = $paymentStatus['message'] ?? 'Erreur inconnue';
                    Log::warning('Paiement échoué pour la demande: ' . $demande->id_demande);
                }
            }

            $demande->update($updateData);

            return response()->json(['status' => 'success']);
            
        } catch (\Exception $e) {
            Log::error('Erreur notification CinetPay: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    
    public function handleReturn(Request $request)
    {
        try {
            Log::info('Retour CinetPay:', $request->all());
            
            $transactionId = $request->input('cpm_trans_id');
            if (!$transactionId) {
                Log::warning('Retour CinetPay sans transaction_id');
                return redirect()->route('citoyen.dashboard')
                    ->with('error', 'Impossible d\'identifier votre transaction.');
            }
            
            $demande = Demande::where('transaction_id', $transactionId)->first();
            
            if (!$demande) {
                Log::warning('Transaction non trouvée:', ['transaction_id' => $transactionId]);
                return redirect()->route('citoyen.dashboard')
                    ->with('error', 'Transaction non trouvée.');
            }
            
            // Si la demande est déjà marquée comme payée, rediriger directement
            if ($demande->statut_paiement === 'paye') {
                Log::info('Demande déjà payée, redirection directe:', ['demande_id' => $demande->id_demande]);
                return redirect()->route('citoyen.dashboard')
                    ->with('success', 'Paiement effectué avec succès. Votre demande est en cours de traitement.');
            }
            
            // Vérifier à nouveau le statut pour être sûr
            $paymentStatus = $this->cinetpayService->checkPaymentStatus($transactionId);
            
            Log::info('Vérification statut au retour:', [
                'demande_id' => $demande->id_demande,
                'statut' => $paymentStatus
            ]);
            
            if ($paymentStatus['code'] === '00') {
                $demande->update([
                    'statut_demande' => 'en_cours',
                    'statut_paiement' => 'paye',
                    'date_paiement' => now(),
                    'methode_paiement' => $paymentStatus['data']['payment_method'] ?? 'Non spécifié'
                ]);
                
                return redirect()->route('citoyen.dashboard')
                    ->with('success', 'Paiement effectué avec succès. Votre demande est en cours de traitement.');
            } else {
                $demande->update([
                    'statut_paiement' => 'echoue',
                    'raison_echec' => $paymentStatus['message'] ?? 'Erreur inconnue'
                ]);
                
                return redirect()->route('citoyen.dashboard')
                    ->with('error', 'Le paiement n\'a pas pu être validé. Veuillez réessayer ou contacter le support.');
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement du retour CinetPay:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('citoyen.dashboard')
                ->with('error', 'Une erreur est survenue lors du traitement de votre paiement. Veuillez vérifier votre tableau de bord pour connaître le statut de votre demande.');
        }
    }
    
    public function handleCancel(Request $request)
    {
        try {
            Log::info('Annulation CinetPay:', $request->all());
            
            $transactionId = $request->input('cpm_trans_id');
            $demande = Demande::where('transaction_id', $transactionId)->first();
            
            if ($demande) {
                $demande->update([
                    'statut_demande' => 'annulee',
                    'statut_paiement' => 'annule'
                ]);
                
                Log::info('Demande annulée par l\'utilisateur:', ['demande_id' => $demande->id_demande]);
            } else {
                Log::warning('Tentative d\'annulation pour une transaction inconnue:', ['transaction_id' => $transactionId]);
            }
            
            return redirect()->route('citoyen.dashboard')
                ->with('warning', 'Paiement annulé. Votre demande a été enregistrée mais ne sera pas traitée tant que le paiement n\'est pas effectué.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'annulation:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('citoyen.dashboard')
                ->with('error', 'Une erreur est survenue lors de l\'annulation de votre paiement.');
        }
    }
}
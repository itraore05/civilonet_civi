<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CinetPayService
{
    private $siteId;
    private $apiKey;
    private $baseUrl;
    private $isTest;

    public function __construct($siteId, $apiKey, $isTest = true)
    {
        $this->siteId = $siteId;
        $this->apiKey = $apiKey;
        $this->isTest = $isTest;
        
        // URL unifiée pour le mode test et production - CinetPay gère la différence via les identifiants
        $this->baseUrl = 'https://api-checkout.cinetpay.com/v2';
    }

    public function generatePaymentLink(array $params): array
    {
        try {
            $payload = [
                'apikey' => $this->apiKey,
                'site_id' => $this->siteId,
                'transaction_id' => $params['transaction_id'],
                'amount' => $params['amount'],
                'currency' => $params['currency'],
                'description' => $params['description'],
                'return_url' => $params['return_url'],
                'notify_url' => $params['notify_url'],
                'metadata' => $params['metadata'] ?? '',
                'channels' => 'ALL',
                'lang' => 'fr',
                'customer_name' => $params['customer_name'] ?? '',
                'customer_email' => $params['customer_email'] ?? '',
                'customer_phone_number' => $params['customer_phone_number'] ?? '',
            ];

            // Ajouter le mode test dans les logs pour débogage
            Log::info('Envoi à CinetPay - Payload: [Mode: ' . ($this->isTest ? 'TEST' : 'PRODUCTION') . ']', $payload);

            // Solution pour le problème SSL - utiliser l'option qui fonctionne le mieux dans votre environnement
            $response = Http::withOptions([
                'verify' => false // À n'utiliser qu'en développement!
            ])->timeout(30)->post($this->baseUrl . '/payment', $payload);

            $responseData = $response->json();
            
            Log::info('Réponse de CinetPay:', [
                'status' => $response->status(),
                'body' => $responseData,
                'mode' => $this->isTest ? 'TEST' : 'PRODUCTION'
            ]);

            if ($response->successful()) {
                if (isset($responseData['code']) && $responseData['code'] == '201') {
                    // Si en mode TEST, simuler immédiatement une validation du paiement
                    if ($this->isTest) {
                        Log::info('Mode TEST: Simulation automatique de paiement réussi pour: ' . $params['transaction_id']);
                        $this->simulateSuccessfulPayment($params['transaction_id']);
                    }
                    
                    return [
                        'success' => true,
                        'code' => '201',
                        'message' => 'Paiement initialisé',
                        'data' => [
                            'payment_url' => $responseData['data']['payment_url'],
                            'payment_token' => $responseData['data']['payment_token'] ?? null
                        ]
                    ];
                } else {
                    throw new Exception('Erreur API CinetPay: ' . 
                        ($responseData['message'] ?? 'Code de réponse inattendu: ' . ($responseData['code'] ?? 'inconnu')));
                }
            } else {
                throw new Exception('Erreur HTTP: ' . $response->status() . ' - ' . 
                    ($responseData['message'] ?? 'Pas de message d\'erreur'));
            }

        } catch (Exception $e) {
            Log::error('Erreur CinetPay API: ' . $e->getMessage() . ' [Mode: ' . ($this->isTest ? 'TEST' : 'PRODUCTION') . ']');
            return [
                'success' => false,
                'code' => 'ERROR',
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }
    
    /**
     * Simule une validation automatique du paiement en mode test
     * 
     * @param string $transactionId
     * @return void
     */
    private function simulateSuccessfulPayment($transactionId)
    {
        try {
            // Attendre quelques secondes pour simuler le délai du paiement
            sleep(2);
            
            // Simuler un appel au notify_url
            $metadataFromTrx = $this->extractMetadataFromTransactionId($transactionId);
            
            Log::info('Mode TEST: Préparation de la simulation de notification pour: ' . $transactionId, [
                'metadata' => $metadataFromTrx
            ]);
            
            // Vous pouvez implémenter ici une logique pour appeler votre webhook/notify_url directement
            // Cette partie dépend de la structure de votre application
            
            // Option 1: Appel direct à votre contrôleur (si dans la même application)
            if (class_exists('App\Http\Controllers\CinetPayWebhookController')) {
                Log::info('Mode TEST: Appel direct au contrôleur de webhook');
                
                // Créer une requête simulée
                $request = new \Illuminate\Http\Request([
                    'cpm_trans_id' => $transactionId,
                    'cpm_site_id' => $this->siteId,
                    'cpm_trans_status' => 'ACCEPTED',
                    'cpm_payment_date' => date('Y-m-d H:i:s'),
                    'cpm_payment_method' => 'TEST_AUTOMATIC',
                    'cpm_currency' => 'XOF',
                    'cpm_language' => 'fr',
                    'cpm_version' => 'v2',
                    'cpm_amount' => '500', // À adapter selon le contexte
                    'signature' => 'test_signature',
                    'cpm_custom' => $metadataFromTrx
                ]);
                
                // Créer une instance du contrôleur et appeler la méthode handleNotification
                $controller = app()->make('App\Http\Controllers\CinetPayWebhookController');
                app()->call([$controller, 'handleNotification'], ['request' => $request]);
            }
            // Option 2: Faire un appel HTTP à votre webhook URL
            else {
                Log::info('Mode TEST: Cette partie nécessite une implémentation spécifique pour appeler votre notify_url');
                // Implémentation à adapter selon votre structure d'application
            }
            
        } catch (Exception $e) {
            Log::error('Erreur lors de la simulation du paiement: ' . $e->getMessage());
        }
    }
    
    /**
     * Extrait les métadonnées du transaction_id (à adapter selon votre logique)
     */
    private function extractMetadataFromTransactionId($transactionId)
    {
        // Si votre transaction_id est au format DOC_42_1746348869
        // On peut extraire l'ID de demande
        if (preg_match('/DOC_(\d+)_/', $transactionId, $matches)) {
            $demandeId = $matches[1];
            return json_encode(['demande_id' => $demandeId]);
        }
        
        return '{}';
    }

    public function checkPaymentStatus(string $transactionId): array
    {
        try {
            // Si en mode test, simuler automatiquement un paiement réussi
            if ($this->isTest) {
                Log::info('Mode TEST: Simulation automatique de vérification réussie pour: ' . $transactionId);
                
                return [
                    'success' => true,
                    'code' => '00',
                    'message' => 'PAYMENT_SUCCESSFUL',
                    'data' => [
                        'amount' => 500, // À adapter selon le contexte
                        'currency' => 'XOF',
                        'payment_method' => 'TEST_AUTOMATIC',
                        'custom' => $this->extractMetadataFromTransactionId($transactionId)
                    ]
                ];
            }
            
            // Sinon, procéder avec la vérification réelle
            $response = Http::withOptions([
                'verify' => false // À n'utiliser qu'en développement!
            ])->timeout(30)->post($this->baseUrl . '/payment/check', [
                'apikey' => $this->apiKey,
                'site_id' => $this->siteId,
                'transaction_id' => $transactionId
            ]);

            $responseData = $response->json();
            
            Log::info('Vérification statut CinetPay:', [
                'status' => $response->status(),
                'body' => $responseData,
                'mode' => $this->isTest ? 'TEST' : 'PRODUCTION'
            ]);

            if ($response->successful()) {
                $paymentData = $responseData['data'] ?? [];
                $status = $paymentData['status'] ?? '';
                
                return [
                    'success' => $status === 'ACCEPTED',
                    'code' => $status === 'ACCEPTED' ? '00' : 'ERROR',
                    'message' => $paymentData['message'] ?? $responseData['message'] ?? '',
                    'data' => [
                        'amount' => $paymentData['amount'] ?? 0,
                        'currency' => $paymentData['currency'] ?? '',
                        'payment_method' => $paymentData['payment_method'] ?? '',
                        'custom' => $paymentData['metadata'] ?? ''
                    ]
                ];
            } else {
                throw new Exception('Erreur API CinetPay Check: ' . 
                    ($responseData['message'] ?? 'HTTP Status: ' . $response->status()));
            }
            
        } catch (Exception $e) {
            Log::error('Erreur vérification statut CinetPay: ' . $e->getMessage() . ' [Mode: ' . ($this->isTest ? 'TEST' : 'PRODUCTION') . ']');
            return [
                'success' => false,
                'code' => 'ERROR',
                'message' => $e->getMessage(),
                'data' => []
            ];
        }
    }
}
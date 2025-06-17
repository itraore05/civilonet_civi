<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\ActeNaissance;
use App\Models\ActeMariage;
use App\Models\ActeDeces;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\CinetPayService;

class DemandeDocumentController extends Controller
{
    protected $cinetpayService;

    public function __construct()
    {
        // Utiliser le mode test (true par défaut)
        $isTestMode = env('CINETPAY_TEST_MODE', true);
        
        // Utiliser les identifiants de test ou de production selon le mode
        $siteId = $isTestMode ? env('CINETPAY_TEST_SITE_ID', '445160') : env('CINETPAY_SITE_ID');
        $apiKey = $isTestMode ? env('CINETPAY_TEST_API_KEY', '12912847765bc0db748fdd44.40081707') : env('CINETPAY_API_KEY');
        
        $this->cinetpayService = new CinetPayService($siteId, $apiKey, $isTestMode);
        
        // Logging pour débogage
        Log::info('CinetPay initialisé', [
            'mode' => $isTestMode ? 'TEST' : 'PRODUCTION',
            'site_id' => $siteId
        ]);
    }

    public function showForm($type)
    {
        if (!in_array($type, ['naissance', 'mariage', 'deces'])) {
            abort(404);
        }

        return view('demandes.formulaire', ['type' => $type]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_acte' => 'required|in:naissance,mariage,deces',
            'certifie' => 'required|accepted'
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Vous devez être connecté pour soumettre une demande.');
        }

        try {
            DB::beginTransaction();

            $demande = Demande::create([
                'id_utilisateur' => Auth::id(),
                'type_acte' => $request->type_acte,
                'statut_demande' => 'en_attente_paiement',
                'statut_paiement' => 'en_attente',
                'date_demande' => now(),
            ]);

            switch ($request->type_acte) {
                case 'naissance':
                    $this->createActeNaissance($demande, $request);
                    break;
                case 'mariage':
                    $this->createActeMariage($demande, $request);
                    break;
                case 'deces':
                    $this->createActeDeces($demande, $request);
                    break;
            }

            DB::commit();

            return $this->initierPaiement($demande);

        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Erreur lors de l\'enregistrement de la demande: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return back()->withInput()->with('error', 'Une erreur est survenue lors de l\'enregistrement de votre demande.');
        }
    }

    protected function initierPaiement(Demande $demande)
    {
        try {
            $montant = $this->getMontantParType($demande->type_acte);
            $transactionId = 'DOC_' . $demande->id_demande . '_' . time();

            $user = Auth::user();

            $params = [
                'transaction_id' => $transactionId,
                'amount' => $montant,
                'currency' => 'XOF',
                'description' => 'Paiement pour demande d\'acte de ' . $demande->type_acte,
                'return_url' => route('cinetpay.return'),
                'notify_url' => route('cinetpay.notify'),
                'metadata' => json_encode(['demande_id' => $demande->id_demande]),
                'customer_name' => $user->name ?? 'Client',
                'customer_email' => $user->email ?? '',
                'customer_phone_number' => $user->telephone ?? '00000000',
            ];

            // Journaliser le mode (test ou production)
            $isTestMode = env('CINETPAY_TEST_MODE', true);
            Log::info('Initialisation paiement CinetPay - [Mode: ' . ($isTestMode ? 'TEST' : 'PRODUCTION') . '] - Paramètres:', $params);

            $demande->update([
                'transaction_id' => $transactionId,
                'montant' => $montant
            ]);

            $paymentResponse = $this->cinetpayService->generatePaymentLink($params);

            if (!$paymentResponse['success']) {
                throw new \Exception('Erreur CinetPay: ' . ($paymentResponse['message'] ?? 'Erreur inconnue'));
            }

            Log::info('Redirection vers CinetPay:', [
                'payment_url' => $paymentResponse['data']['payment_url'],
                'demande_id' => $demande->id_demande,
                'mode' => $isTestMode ? 'TEST' : 'PRODUCTION'
            ]);

            return redirect()->away($paymentResponse['data']['payment_url']);

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'initialisation du paiement:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'demande_id' => $demande->id_demande ?? null
            ]);
            
            $demande->update([
                'statut_paiement' => 'echoue',
                'raison_echec' => substr($e->getMessage(), 0, 255)
            ]);
            
            return redirect()->route('citoyen.dashboard')
                ->with('error', 'Erreur lors de l\'initialisation du paiement: ' . $e->getMessage());
        }
    }

    protected function createActeNaissance($demande, $request)
    {
        $request->validate([
            'nom_enfant' => 'required|string|max:255',
            'prenoms_enfant' => 'required|string|max:255',
            'date_naissance_enfant' => 'required|date',
            'lieu_naissance_enfant' => 'required|string|max:255',
            'nom_pere' => 'required|string|max:255',
            'prenoms_pere' => 'required|string|max:255',
            'nom_mere' => 'required|string|max:255',
            'prenoms_mere' => 'required|string|max:255',
        ]);

        $demande->acteNaissance()->create([
            'nom_enfant' => $request->nom_enfant,
            'prenoms_enfant' => $request->prenoms_enfant,
            'date_naissance_enfant' => $request->date_naissance_enfant,
            'lieu_naissance_enfant' => $request->lieu_naissance_enfant,
            'nom_pere' => $request->nom_pere,
            'prenoms_pere' => $request->prenoms_pere,
            'nom_mere' => $request->nom_mere,
            'prenoms_mere' => $request->prenoms_mere,
        ]);
    }

    protected function createActeMariage($demande, $request)
    {
        $request->validate([
            'nom_epoux' => 'required|string|max:255',
            'prenoms_epoux' => 'required|string|max:255',
            'date_naissance_epoux' => 'required|date',
            'lieu_naissance_epoux' => 'required|string|max:255',
            'nom_epouse' => 'required|string|max:255',
            'prenoms_epouse' => 'required|string|max:255',
            'date_naissance_epouse' => 'required|date',
            'lieu_naissance_epouse' => 'required|string|max:255',
            'date_mariage' => 'required|date',
            'lieu_mariage' => 'required|string|max:255',
        ]);

        $demande->acteMariage()->create([
            'nom_epoux' => $request->nom_epoux,
            'prenoms_epoux' => $request->prenoms_epoux,
            'date_naissance_epoux' => $request->date_naissance_epoux,
            'lieu_naissance_epoux' => $request->lieu_naissance_epoux,
            'nom_epouse' => $request->nom_epouse,
            'prenoms_epouse' => $request->prenoms_epouse,
            'date_naissance_epouse' => $request->date_naissance_epouse,
            'lieu_naissance_epouse' => $request->lieu_naissance_epouse,
            'date_mariage' => $request->date_mariage,
            'lieu_mariage' => $request->lieu_mariage,
        ]);
    }

    protected function createActeDeces($demande, $request)
    {
        $request->validate([
            'nom_defunt' => 'required|string|max:255',
            'prenoms_defunt' => 'required|string|max:255',
            'date_naissance_defunt' => 'required|date',
            'lieu_naissance_defunt' => 'required|string|max:255',
            'date_deces' => 'required|date',
            'lieu_deces' => 'required|string|max:255',
        ]);

        $demande->acteDeces()->create([
            'nom_defunt' => $request->nom_defunt,
            'prenoms_defunt' => $request->prenoms_defunt,
            'date_naissance_defunt' => $request->date_naissance_defunt,
            'lieu_naissance_defunt' => $request->lieu_naissance_defunt,
            'date_deces' => $request->date_deces,
            'lieu_deces' => $request->lieu_deces,
        ]);
    }
    
    protected function getMontantParType($type)
    {
        $montants = [
            'naissance' => 500,
            'mariage' => 500,
            'deces' => 500,
        ];
        
        return $montants[$type] ?? 500;
    }


    public function index()
    {
        try {
            // Récupérer l'utilisateur connecté
            $user = Auth::user();
            
            // Récupérer les demandes traitées avec PDF généré
            $demandes = Demande::where('id_utilisateur', $user->id)
                ->where('statut_demande', 'traite') // ou 'traitee' selon le standard utilisé dans votre application
                ->whereNotNull('pdf_path')
                ->orderBy('date_traitement', 'desc')
                ->paginate(10);
            
            return view('demandes_traitees', compact('demandes'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'affichage des documents', [
                'user_id' => Auth::id(),
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()->with('error', 'Une erreur est survenue lors du chargement des documents');
        }
    }
    
    /**
     * Télécharge un document PDF
     *
     * @param int $demandeId ID de la demande
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Illuminate\Http\RedirectResponse
     */
    public function telecharger($demandeId)
    {
        try {
            // Récupérer la demande
            $demande = Demande::where('id_demande', $demandeId)
                ->where('id_utilisateur', Auth::id())
                ->where('statut_demande', 'traite') // ou 'traitee'
                ->whereNotNull('pdf_path')
                ->firstOrFail();
            
            // Vérifier que le fichier existe
            $filePath = storage_path('app/' . $demande->pdf_path);
            
            if (!file_exists($filePath)) {
                return redirect()->route('demandes.documents')->with('error', 'Le fichier demandé est introuvable');
            }
            
            // Déterminer le nom du fichier
            $filename = 'acte_' . $demande->type_acte . '_' . $demande->numero_acte . '.pdf';
            
            // Télécharger le fichier
            return response()->download($filePath, $filename);
        } catch (\Exception $e) {
            Log::error('Erreur lors du téléchargement du document', [
                'demande_id' => $demandeId,
                'user_id' => Auth::id(),
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('demandes.documents')->with('error', 'Une erreur est survenue lors du téléchargement du document');
        }
    }
}
<?php

namespace App\Services;

use App\Models\Demande;
use App\Models\ActeNaissance;
use App\Models\ActeMariage;
use App\Models\ActeDeces;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Barryvdh\DomPDF\Facade\Pdf as DomPdf;

class PdfGeneratorService
{
    /**
     * Génère un PDF pour une demande d'acte d'état civil
     * 
     * @param int $demandeId ID de la demande
     * @return array Résultat de la génération du PDF
     */
    public function generatePdf(int $demandeId): array
    {
        try {
            // Récupérer la demande
            $demande = Demande::findOrFail($demandeId);
            
            // Déterminer le type d'acte et générer le PDF correspondant
            switch ($demande->type_acte) {
                case 'naissance':
                    return $this->generateActeNaissancePdf($demande);
                case 'mariage':
                    return $this->generateActeMariagePdf($demande);
                case 'deces':
                    return $this->generateActeDecesPdf($demande);
                default:
                    throw new \Exception("Type d'acte non pris en charge: {$demande->type_acte}");
            }
        } catch (\Exception $e) {
            Log::error("Erreur génération PDF", [
                'id_demande' => $demandeId,
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Génère un PDF pour un acte de naissance
     */
    protected function generateActeNaissancePdf(Demande $demande): array
    {
        try {
            $acteNaissance = ActeNaissance::where('id_demande', $demande->id_demande)->firstOrFail();
            
            // Générer un numéro unique pour l'acte
            $numeroActe = 'N-' . date('Y') . '-' . str_pad($demande->id_demande, 6, '0', STR_PAD_LEFT);
            
            // Préparer les données pour la vue
            $data = [
                'demande' => $demande,
                'acte' => $acteNaissance,
                'acteNaissance' => $acteNaissance, // Ajout de cette variable pour correspondre à la vue
                'numero_acte' => $numeroActe,
                'date_delivrance' => now()->format('d/m/Y'),
                'qr_code' => $this->generateQrCode($numeroActe),
                'utilisateur' => $demande->utilisateur,
                'montant' => $demande->montant ?? $this->getMontantParType('naissance'),
                'transaction_id' => $demande->transaction_id,
            ];
            
            // Générer le PDF avec Dompdf
            $pdf = DomPdf::loadView('pdf.acte_naissance', $data);
            
            // Améliorer la qualité du PDF
            $pdf->setPaper('a4');
            $pdf->setOption('isPhpEnabled', true);
            $pdf->setOption('isHtml5ParserEnabled', true);
            $pdf->setOption('isRemoteEnabled', true);
            
            // Définir le nom du fichier
            $filename = 'acte_naissance_' . $demande->id_demande . '.pdf';
            $path = 'pdf/' . $filename;
            
            // Enregistrer le PDF dans le storage
            Storage::put($path, $pdf->output());
            
            // Mettre à jour la demande avec le chemin du PDF
            $demande->update([
                'pdf_path' => $path,
                'numero_acte' => $numeroActe,
                'statut_demande' => 'traite',
                'date_traitement' => now()
            ]);
            
            return [
                'success' => true,
                'path' => $path,
                'download_url' => $this->getDownloadUrl($path),
                'message' => 'Acte de naissance généré avec succès'
            ];
        } catch (\Exception $e) {
            Log::error("Erreur génération PDF naissance", [
                'demande_id' => $demande->id_demande,
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e;
        }
    }
    
    /**
     * Génère un PDF pour un acte de mariage
     */
        protected function generateActeMariagePdf(Demande $demande): array
    {
        try {
            $acteMariage = ActeMariage::where('id_demande', $demande->id_demande)->firstOrFail();
            
            // Générer un numéro unique pour l'acte
            $numeroActe = 'M-' . date('Y') . '-' . str_pad($demande->id_demande, 6, '0', STR_PAD_LEFT);
            
            // Préparer les données pour la vue
            $data = [
                'demande' => $demande,
                'acte' => $acteMariage,
                'acteMariage' => $acteMariage, // Correction: Ajout de la variable spécifique pour la vue
                'numero_acte' => $numeroActe,
                'date_delivrance' => now()->format('d/m/Y'),
                'qr_code' => $this->generateQrCode($numeroActe),
                'utilisateur' => $demande->utilisateur,
                'montant' => $demande->montant ?? $this->getMontantParType('mariage'),
                'transaction_id' => $demande->transaction_id,
            ];
            
            // Générer le PDF avec Dompdf
            $pdf = DomPdf::loadView('pdf.acte_mariage', $data);
            
            // Améliorer la qualité du PDF
            $pdf->setPaper('a4');
            $pdf->setOption('isPhpEnabled', true);
            $pdf->setOption('isHtml5ParserEnabled', true);
            $pdf->setOption('isRemoteEnabled', true);
            
            // Définir le nom du fichier
            $filename = 'acte_mariage_' . $demande->id_demande . '.pdf';
            $path = 'pdf/' . $filename;
            
            // Enregistrer le PDF dans le storage
            Storage::put($path, $pdf->output());
            
            // Mettre à jour la demande avec le chemin du PDF
            $demande->update([
                'pdf_path' => $path,
                'numero_acte' => $numeroActe,
                'statut_demande' => 'traite',
                'date_traitement' => now()
            ]);
            
            return [
                'success' => true,
                'path' => $path,
                'download_url' => $this->getDownloadUrl($path),
                'message' => 'Acte de mariage généré avec succès'
            ];
        } catch (\Exception $e) {
            Log::error("Erreur génération PDF mariage", [
                'id_demande' => $demande->id_demande,
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e;
        }
    }
    
    
   /**
 * Génère un PDF pour un acte de décès
 */
protected function generateActeDecesPdf(Demande $demande): array
{
    try {
        $acteDeces = ActeDeces::where('id_demande', $demande->id_demande)->firstOrFail();
        
        // Générer un numéro unique pour l'acte
        $numeroActe = 'D-' . date('Y') . '-' . str_pad($demande->id_demande, 6, '0', STR_PAD_LEFT);
        
        // Préparer les données pour la vue
        $data = [
            'demande' => $demande,
            'acte' => $acteDeces,
            'acteDeces' => $acteDeces,  // Add this line to make sure the variable name matches what's expected in the template
            'numero_acte' => $numeroActe,
            'date_delivrance' => now()->format('d/m/Y'),
            'qr_code' => $this->generateQrCode($numeroActe),
            'utilisateur' => $demande->utilisateur,
            'montant' => $demande->montant ?? $this->getMontantParType('deces'),
            'transaction_id' => $demande->transaction_id,
        ];
        
        // Générer le PDF avec Dompdf
        $pdf = DomPdf::loadView('pdf.acte_deces', $data);
        
        // Améliorer la qualité du PDF
        $pdf->setPaper('a4');
        $pdf->setOption('isPhpEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);
        
        // Définir le nom du fichier
        $filename = 'acte_deces_' . $demande->id_demande . '.pdf';
        $path = 'pdf/' . $filename;
        
        // Enregistrer le PDF dans le storage
        Storage::put($path, $pdf->output());
        
        // Mettre à jour la demande avec le chemin du PDF
        $demande->update([
            'pdf_path' => $path,
            'numero_acte' => $numeroActe,
            'statut_demande' => 'traite',
            'date_traitement' => now()
        ]);
        
        return [
            'success' => true,
            'path' => $path,
            'download_url' => $this->getDownloadUrl($path),
            'message' => 'Acte de décès généré avec succès'
        ];
    } catch (\Exception $e) {
        Log::error("Erreur génération PDF deces", [
            'id_demande' => $demande->id_demande,
            'exception' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        throw $e;
    }
}
    
    /**
     * Génère un code QR pour la vérification d'authenticité du document
     */
    protected function generateQrCode($numeroActe): string
    {
        // URL de vérification qui sera encodée dans le QR code
        $verificationUrl = route('verifier.acte', ['numero' => $numeroActe]);
        
        // Retourner l'URL pour la génération du QR code
        // La vue utilisera une bibliothèque comme SimpleSoftwareIO/simple-qrcode pour l'affichage
        return $verificationUrl;
    }
    
    /**
     * Retourne l'URL de téléchargement d'un document
     */
    protected function getDownloadUrl($path): string
    {
        return URL::temporarySignedRoute(
            'document.telecharger',
            now()->addDays(7),
            ['chemin' => base64_encode($path)]
        );
    }
    
    /**
     * Récupère le montant associé à un type d'acte
     */
    protected function getMontantParType($type): int
    {
        $montants = [
            'naissance' => 500,
            'mariage' => 500,
            'deces' => 500,
        ];
        
        return $montants[$type] ?? 500;
    }
    
    /**
     * Vérifie la validité d'un acte à partir de son numéro
     */
    public function verifierActe(string $numeroActe): array
    {
        try {
            // Extraire le type d'acte à partir du préfixe du numéro
            $typePrefix = substr($numeroActe, 0, 1);
            
            // Déterminer le type d'acte
            $typeActe = null;
            switch ($typePrefix) {
                case 'N':
                    $typeActe = 'naissance';
                    break;
                case 'M':
                    $typeActe = 'mariage';
                    break;
                case 'D':
                    $typeActe = 'deces';
                    break;
                default:
                    throw new \Exception("Format de numéro d'acte invalide");
            }
            
            // Rechercher la demande correspondante
            $demande = Demande::where('numero_acte', $numeroActe)
                ->where('type_acte', $typeActe)
                ->where('statut_demande', 'traite')
                ->first();
                
            if (!$demande) {
                return [
                    'success' => false,
                    'message' => "L'acte demandé n'existe pas ou n'est pas valide"
                ];
            }
            
            // Récupérer les informations sur l'acte selon son type
            $informationsActe = $this->getInformationsActe($demande);
            
            return [
                'success' => true,
                'demande' => [
                    'id' => $demande->id_demande,
                    'type_acte' => $demande->type_acte,
                    'date_delivrance' => $demande->date_traitement->format('d/m/Y'),
                    'numero_acte' => $demande->numero_acte
                ],
                'acte' => $informationsActe
            ];
        } catch (\Exception $e) {
            Log::error("Erreur vérification acte", [
                'numero_acte' => $numeroActe,
                'exception' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    
    /**
     * Récupère les informations d'un acte selon son type
     */
    protected function getInformationsActe(Demande $demande): array
    {
        switch ($demande->type_acte) {
            case 'naissance':
                $acte = ActeNaissance::where('id_demande', $demande->id_demande)->firstOrFail();
                return [
                    'nom_enfant' => $acte->nom_enfant,
                    'prenoms_enfant' => $acte->prenoms_enfant,
                    'date_naissance' => date('d/m/Y', strtotime($acte->date_naissance_enfant)),
                    'lieu_naissance' => $acte->lieu_naissance_enfant,
                ];
                
            case 'mariage':
                $acte = ActeMariage::where('id_demande', $demande->id_demande)->firstOrFail();
                return [
                    'nom_epoux' => $acte->nom_epoux,
                    'prenoms_epoux' => $acte->prenoms_epoux,
                    'nom_epouse' => $acte->nom_epouse,
                    'prenoms_epouse' => $acte->prenoms_epouse,
                    'date_mariage' => date('d/m/Y', strtotime($acte->date_mariage)),
                    'lieu_mariage' => $acte->lieu_mariage,
                ];
                
            case 'deces':
                $acte = ActeDeces::where('id_demande', $demande->id_demande)->firstOrFail();
                return [
                    'nom_defunt' => $acte->nom_defunt,
                    'prenoms_defunt' => $acte->prenoms_defunt,
                    'date_deces' => date('d/m/Y', strtotime($acte->date_deces)),
                    'lieu_deces' => $acte->lieu_deces,
                ];
                
            default:
                return [];
        }
    }
    
    /**
     * Génère à nouveau le PDF d'un acte existant
     */
    public function regenererPdf(int $demandeId): array
    {
        try {
            $demande = Demande::findOrFail($demandeId);
            
            // Vérifier que la demande a déjà un PDF
            if (!$demande->pdf_path) {
                return $this->generatePdf($demandeId);
            }
            
            // Supprimer l'ancien PDF s'il existe
            if (Storage::exists($demande->pdf_path)) {
                Storage::delete($demande->pdf_path);
            }
            
            // Générer un nouveau PDF
            return $this->generatePdf($demandeId);
            
        } catch (\Exception $e) {
            Log::error("Erreur régénération PDF", [
                'id_demande' => $demandeId,
                'exception' => $e->getMessage()
            ]);
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
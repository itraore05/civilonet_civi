<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitoyenController;
use App\Http\Controllers\DemandeDocumentController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\CinetPayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentControllerdoal;
use App\Http\Controllers\DemandeValidationController;
use App\Http\Controllers\DemandesController;


Route::get('/', [HomeController::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Version corrigée :
Route::middleware(['auth'])->group(function () {
    Route::get('/citoyen/dashboard', [CitoyenController::class, 'dashboard'])
         ->name('citoyen.dashboard');
         Route::get('/citoyen/demandes', [CitoyenController::class, 'dashboard'])->name('citoyen.demandes.index');     
});


Route::get('/citoyen/dashboard/data', [CitoyenController::class, 'getDashboardData'])
    ->name('citoyen.dashboard.data')
    ->middleware('auth');

    Route::post('/citoyen/notifications/mark-as-read', [CitoyenController::class, 'markNotificationAsRead'])
    ->name('citoyen.notifications.markAsRead')
    ->middleware('auth');

// Routes pour les citoyens
Route::middleware(['auth'])->group(function () {
    // Tableau de bord
    Route::get('/citoyen/dashboard', [CitoyenController::class, 'dashboard'])->name('citoyen.dashboard');
    
    // Gestion des demandes
    Route::get('/citoyen/demandes/{demande}', [CitoyenController::class, 'showDemande'])->name('citoyen.demandes.show');

    Route::put('/citoyen/demandes/{id}/cancel', [DemandeController::class, 'cancel'])
    ->name('citoyen.demandes.cancel');
    
    // Création de nouvelles demandes
    Route::get('/demande/nouvelle/{type}', [DemandeDocumentController::class, 'showForm'])->name('demande.nouvelle');
    Route::post('/demande/store', [DemandeDocumentController::class, 'store'])->name('demande.store');
});

Route::middleware(['auth'])->group(function () {
    // Affichage du formulaire de demande
    Route::get('/demande/{type}', [DemandeDocumentController::class, 'showForm'])->name('demande.form');
    
    // Soumission du formulaire
    Route::post('/demande/store', [DemandeDocumentController::class, 'store'])->name('demande.store');
});

// Routes CinetPay
Route::post('/cinetpay/notify', [CinetPayController::class, 'handleNotification'])->name('cinetpay.notify');
Route::get('/cinetpay/return', [CinetPayController::class, 'handleReturn'])->name('cinetpay.return');
Route::get('/cinetpay/cancel', [CinetPayController::class, 'handleCancel'])->name('cinetpay.cancel');


Route::post('/cinetpay/notify', [App\Http\Controllers\CinetPayWebhookController::class, 'handleNotification'])->name('cinetpay.notify');
Route::get('/cinetpay/return', [App\Http\Controllers\CinetPayWebhookController::class, 'returnPage'])->name('cinetpay.return');



// Route pour télécharger un document
Route::get('/telechargement-document/{demandeId}', [DocumentControllerdoal::class, 'telechargerDocument'])
    ->name('telechargement.document')
    ->middleware('auth');

// Route pour télécharger un PDF (accessible aux utilisateurs authentifiés)
Route::middleware(['auth'])->group(function () {
    Route::get('/telecharger-document/{demandeId}', [DemandeValidationController::class, 'telechargerPdf'])
         ->name('telecharger.document');
});

// Route pour vérification publique via QR code (sans authentification)
Route::get('/verification-acte/{uuid}', [DemandeValidationController::class, 'verifierActe'])
     ->name('verification.acte');

     Route::get('/demandes/{demandeId}/telecharger-pdf', [DemandeValidationController::class, 'telechargerPdf'])
     ->name('demande.telecharger-pdf')
     ->middleware('auth');
 
 // Si vous n'avez pas déjà une route pour la vérification des actes, ajoutez également celle-ci
 Route::get('/verification/acte/{uuid}', [DemandeValidationController::class, 'verifierActe'])
     ->name('verification.acte');

// Routes pour les demandes d'actes d'état civil
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Liste des demandes
    Route::get('/demandes', [DemandesController::class, 'index'])->name('demandes');
    
    // Détails d'une demande
    Route::get('/demandes/{id}', [DemandesController::class, 'show'])->name('citoyen.demande-detail');
    
    // Télécharger un PDF
    Route::get('/demandes/{id}/telecharger', [DemandesController::class, 'telechargerPdf'])->name('demandes.telecharger');
    
    // Nouvelle demande (formulaire)
    Route::get('/demandes/nouvelle/{type}', [DemandesController::class, 'create'])->name('demandes.nouvelle');
    
    // Soumettre une nouvelle demande
    Route::post('/demandes/nouvelle', [DemandesController::class, 'store'])->name('demandes.store');
    
    // Annuler une demande en attente
    Route::delete('/demandes/{id}/annuler', [DemandesController::class, 'cancel'])->name('demandes.annuler');
});     

Route::get('/citoyen/mes-demandes', [DemandesController::class, 'citoyenDemandes'])
    ->name('citoyen.demandes')
    ->middleware('auth');




 // Fichier à créer/modifier: routes/web.php
// Ajoutez cette route à votre fichier routes/web.php

// Route pour la vérification d'acte par numéro d'acte
Route::get('/verification/acte/{numero}', [App\Http\Controllers\DemandeValidationController::class, 'verifierActeParNumero'])
    ->name('verifier.acte');





    Route::get('/verification/acte/{uuid}', [DemandeValidationController::class, 'verifierActe'])
     ->name('verifier.acte');

// Route temporaire pour le téléchargement de documents (celle qui manque)
Route::get('/documents/telecharger/{chemin}', function ($chemin) {
    try {
        $path = base64_decode($chemin);
        
        // Vérification de sécurité pour s'assurer que le chemin est dans le dossier pdf
        if (!str_starts_with($path, 'pdf/')) {
            return redirect()->back()->with('error', 'Chemin de fichier non autorisé');
        }
        
        $filePath = storage_path('app/' . $path);
        
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Fichier introuvable');
        }
        
        // Déterminer le type d'acte pour générer un nom de fichier approprié
        $fileName = basename($path);
        
        return response()->download($filePath, $fileName);
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('Erreur téléchargement document', [
            'chemin' => $chemin,
            'exception' => $e->getMessage()
        ]);
        
        return redirect()->back()->with('error', 'Erreur lors du téléchargement du document');
    }
})->middleware('signed')->name('document.telecharger');

// Route existante pour télécharger un PDF depuis le contrôleur (tel qu'implémenté dans votre code)
Route::get('/demandes/{demandeId}/telecharger', [DemandeValidationController::class, 'telechargerPdf'])
     ->name('demandes.telecharger')
     ->middleware('auth');

// Routes pour la validation et le rejet des demandes (qui utilisent les fonctions du contrôleur)
Route::post('/demandes/{demandeId}/valider', [DemandeValidationController::class, 'validerDemande'])
     ->name('demandes.valider')
     ->middleware('auth');

Route::post('/demandes/{demandeId}/rejeter', [DemandeValidationController::class, 'rejeterDemande'])
     ->name('demandes.rejeter')
     ->middleware('auth');

// Routes pour les PDF
Route::middleware(['auth'])->group(function () {
    // Afficher la vue PDF
    Route::get('/demandes/{demande}/pdf', [DemandeValidationController::class, 'showPdfView'])
         ->name('demandes.pdf_view');
         

     Route::get('/demandes/{demande}/view-pdf', [DemandeValidationController::class, 'viewPdf'])
     ->name('demandes.pdf_view');    
    // Télécharger le PDF
    Route::get('/demandes/{demande}/download', [DemandeValidationController::class, 'telechargerPdf'])
         ->name('demandes.pdf.download');
         
    // Aperçu intégré du PDF
    Route::get('/demandes/{demande}/embed', [DemandeValidationController::class, 'embedPdf'])
         ->name('demandes.pdf.embed');
}); 

require __DIR__.'/auth.php';

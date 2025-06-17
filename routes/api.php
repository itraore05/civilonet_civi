<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeValidationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Groupe de routes protégées par sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    // Routes pour la validation des demandes
    Route::prefix('demandes')->group(function () {
        // Valider une demande
        Route::post('/{demandeId}/valider', [DemandeValidationController::class, 'validerDemande'])
            ->name('api.demandes.valider')
            ->where('demandeId', '[0-9]+'); // Validation du paramètre
        
        // Rejeter une demande
        Route::post('/{demandeId}/rejeter', [DemandeValidationController::class, 'rejeterDemande'])
            ->name('api.demandes.rejeter')
            ->where('demandeId', '[0-9]+'); // Validation du paramètre
    });
});

// Route de test pour vérifier l'authentification
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
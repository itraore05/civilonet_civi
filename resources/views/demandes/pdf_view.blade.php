@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Votre document officiel</h4>
                        <span class="badge bg-light text-primary fs-6">{{ strtoupper($demande->type_acte) }}</span>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- En-tête avec informations de la demande -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Numéro de demande :</strong> #{{ $demande->id_demande }}</p>
                            <p><strong>Numéro d'acte :</strong> {{ $demande->numero_acte }}</p>
                            <p><strong>Date de traitement :</strong> 
@if($demande->date_traitement)
    {{ \Carbon\Carbon::parse($demande->date_traitement)->format('d/m/Y H:i') }}
@else
    Non traitée
@endif
</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Aperçu du PDF intégré -->
                    <div class="pdf-preview-container mb-4 border rounded">
                        <div class="d-flex justify-content-center align-items-center bg-light" style="min-height: 100px;">
                            <iframe src="{{ route('demandes.pdf_view', $demande->id_demande) }}" 
                                    style="width: 100%; height: 600px; border: none;" 
                                    title="Aperçu du document PDF">
                            </iframe>
                        </div>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('citoyen.dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Retour à mes demandes
                        </a>
                        
                        <div>
                            <a href="{{ route('demandes.pdf.download', $demande->id_demande) }}" 
                               class="btn btn-primary me-2">
                                <i class="fas fa-download me-2"></i> Télécharger
                            </a>
                            
                            <button onclick="window.print()" class="btn btn-outline-primary">
                                <i class="fas fa-print me-2"></i> Imprimer
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Section d'information sur la validité -->
                <div class="card-footer bg-light">
                    <div class="alert alert-info mb-0">
                        <h5 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Document officiel</h5>
                        <p class="mb-2">
                            Ce document a été généré électroniquement et porte la signature numérique de la mairie.
                            Il a la même valeur légale que le document original.
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .pdf-preview-container {
        position: relative;
        overflow: hidden;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
    }
    
    .pdf-preview-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }
    
    .qr-code-container {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        text-align: center;
    }
    
    @media print {
        .card-header, .card-footer, .btn {
            display: none !important;
        }
        
        body {
            background: white !important;
        }
        
        .pdf-preview-container {
            height: 100vh;
            padding: 0;
        }
    }
</style>
@endsection
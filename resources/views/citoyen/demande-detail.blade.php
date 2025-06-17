@extends('layouts')

@section('title', 'Détails de la demande')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Bouton de retour -->
            <div class="mb-3">
                <a href="{{ route('citoyen.demandes') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
            
            <!-- Carte des informations générales de la demande -->
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                        <h6 class="text-white text-capitalize ps-3">Demande #{{ $demande->id_demande }}</h6>
                        
                        <!-- Badge de statut -->
                        @switch($demande->statut_demande)
                            @case('en_attente')
                                <span class="badge bg-warning me-3">En attente</span>
                                @break
                            @case('en_traitement')
                                <span class="badge bg-info me-3">En traitement</span>
                                @break
                            @case('traitee')
                                <span class="badge bg-success me-3">Traitée</span>
                                @break
                            @case('rejetee')
                                <span class="badge bg-danger me-3">Rejetée</span>
                                @break
                            @default
                                <span class="badge bg-secondary me-3">{{ $demande->statut_demande }}</span>
                        @endswitch
                    </div>
                </div>
                
                <div class="card-body px-4 pb-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informations générales</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tbody>
                                        <tr>
                                            <th>Type d'acte</th>
                                            <td>
                                                @switch($demande->type_acte)
                                                    @case('naissance')
                                                        Acte de naissance
                                                        @break
                                                    @case('mariage')
                                                        Acte de mariage
                                                        @break
                                                    @case('deces')
                                                        Acte de décès
                                                        @break
                                                    @default
                                                        {{ $demande->type_acte }}
                                                @endswitch
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date de la demande</th>
                                            <td>{{ $demande->created_at->format('d/m/Y à H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Statut</th>
                                            <td>
                                                @switch($demande->statut_demande)
                                                    @case('en_attente')
                                                        <span class="badge bg-warning">En attente</span>
                                                        @break
                                                    @case('en_traitement')
                                                        <span class="badge bg-info">En traitement</span>
                                                        @break
                                                    @case('traitee')
                                                        <span class="badge bg-success">Traitée</span>
                                                        @break
                                                    @case('rejetee')
                                                        <span class="badge bg-danger">Rejetée</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">{{ $demande->statut_demande }}</span>
                                                @endswitch
                                            </td>
                                        </tr>
                                        @if($demande->date_traitement)
                                        <tr>
                                            <th>Date de traitement</th>
                                            <td>{{ date('d/m/Y à H:i', strtotime($demande->date_traitement)) }}</td>
                                        </tr>
                                        @endif
                                        @if($demande->pdf_path && $demande->statut_demande === 'traitee')
                                        <tr>
                                            <th>Document disponible</th>
                                            <td>
                                                <a href="{{ route('dashboard.demandes.telecharger', $demande->id_demande) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-file-pdf me-2"></i>Télécharger l'acte
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                        @if($demande->motif_rejet && $demande->statut_demande === 'rejetee')
                                        <tr>
                                            <th>Motif du rejet</th>
                                            <td class="text-danger">{{ $demande->motif_rejet }}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Détails</h5>
                            
                            @switch($demande->type_acte)
                                @case('naissance')
                                    @if($demande->acteNaissance)
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <th>Nom</th>
                                                    <td>{{ $demande->acteNaissance->nom }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Prénoms</th>
                                                    <td>{{ $demande->acteNaissance->prenoms }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date de naissance</th>
                                                    <td>{{ date('d/m/Y', strtotime($demande->acteNaissance->date_naissance)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Lieu de naissance</th>
                                                    <td>{{ $demande->acteNaissance->lieu_naissance }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nom du père</th>
                                                    <td>{{ $demande->acteNaissance->nom_pere ?: 'Non renseigné' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nom de la mère</th>
                                                    <td>{{ $demande->acteNaissance->nom_mere ?: 'Non renseigné' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Les détails de l'acte de naissance ne sont pas disponibles.
                                    </div>
                                    @endif
                                    @break
                                
                                @case('mariage')
                                    @if($demande->acteMariage)
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <th>Époux</th>
                                                    <td>{{ $demande->acteMariage->nom_epoux }} {{ $demande->acteMariage->prenoms_epoux }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Épouse</th>
                                                    <td>{{ $demande->acteMariage->nom_epouse }} {{ $demande->acteMariage->prenoms_epouse }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date du mariage</th>
                                                    <td>{{ date('d/m/Y', strtotime($demande->acteMariage->date_mariage)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Lieu du mariage</th>
                                                    <td>{{ $demande->acteMariage->lieu_mariage }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Les détails de l'acte de mariage ne sont pas disponibles.
                                    </div>
                                    @endif
                                    @break
                                
                                @case('deces')
                                    @if($demande->acteDeces)
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr>
                                                    <th>Nom du défunt</th>
                                                    <td>{{ $demande->acteDeces->nom_defunt }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Prénoms du défunt</th>
                                                    <td>{{ $demande->acteDeces->prenoms_defunt }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date du décès</th>
                                                    <td>{{ date('d/m/Y', strtotime($demande->acteDeces->date_deces)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Lieu du décès</th>
                                                    <td>{{ $demande->acteDeces->lieu_deces }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Les détails de l'acte de décès ne sont pas disponibles.
                                    </div>
                                    @endif
                                    @break
                                
                                @default
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Type d'acte non reconnu.
                                    </div>
                            @endswitch
                        </div>
                    </div>
                    
                    <!-- Section commentaires administratifs (si existants) -->
                    @if($demande->commentaires)
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card border">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-comment me-2"></i>Commentaires administratifs</h6>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">{{ $demande->commentaires }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Section état d'avancement pour les demandes en traitement -->
                    @if($demande->statut_demande === 'en_traitement')
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>État d'avancement</h5>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">En cours de traitement</div>
                            </div>
                            <div class="small text-muted mt-2">
                                Votre demande est en cours de traitement par nos services. Veuillez patienter.
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Section des actions disponibles -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    @if($demande->statut_demande === 'rejetee')
                                    <a href="{{ route('dashboard.demandes.nouvelle', ['type' => $demande->type_acte]) }}" class="btn btn-primary">
                                        <i class="fas fa-redo me-2"></i>Soumettre une nouvelle demande
                                    </a>
                                    @endif
                                </div>
                                
                                <div>
                                    @if($demande->statut_demande === 'en_attente')
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelRequestModal">
                                        <i class="fas fa-times-circle me-2"></i>Annuler cette demande
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation d'annulation -->
@if($demande->statut_demande === 'en_attente')
<div class="modal fade" id="cancelRequestModal" tabindex="-1" aria-labelledby="cancelRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelRequestModalLabel">Confirmer l'annulation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir annuler cette demande d'acte ?</p>
                <p class="text-danger"><strong>Cette action est irréversible.</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <form action="{{ route('dashboard.demandes.annuler', $demande->id_demande) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Confirmer l'annulation</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Afficher automatiquement les alertes pendant 5 secondes
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    });
</script>
@endsection
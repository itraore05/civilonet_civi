<x-app-layout>

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Détails de la demande #{{ $demande->id_demande }}</h4>
                        <span class="badge bg-{{ $demande->statut_demande == 'traitee' ? 'success' : ($demande->statut_demande == 'rejetee' ? 'danger' : 'warning') }}">
                            {{ ucfirst(str_replace('_', ' ', $demande->statut_demande)) }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informations sur la demande</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Type:</strong> 
                                    <span class="badge bg-{{ $demande->type_acte == 'naissance' ? 'info' : ($demande->type_acte == 'mariage' ? 'primary' : 'secondary') }}">
                                        {{ ucfirst($demande->type_acte) }}
                                    </span>
                                </li>
                                <li class="list-group-item">
                                <strong>Date demande:</strong> {{ \Carbon\Carbon::parse($demande->date_demande)->format('d/m/Y H:i') }}

                                </li>
                                <li class="list-group-item">
                                <strong>Dernière mise à jour:</strong> {{ \Carbon\Carbon::parse($demande->updated_at)->format('d/m/Y H:i') }}

                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Actions</h5>
                            <div class="d-grid gap-2">
                                @if($demande->statut_demande == 'traitee')
                                    <a href="#" class="btn btn-success">
                                        <i class="fas fa-download me-2"></i> Télécharger le document
                                    </a>
                                @endif
                                <a href="{{ route('citoyen.dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Retour au tableau de bord
                                </a>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Détails du document</h5>
                    @if($demande->type_acte == 'naissance' && $demande->acteNaissance)
                        @include('citoyen.partials.details-naissance')
                    @elseif($demande->type_acte == 'mariage' && $demande->acteMariage)
                        @include('citoyen.partials.details-mariage')
                    @elseif($demande->type_acte == 'deces' && $demande->acteDeces)
                        @include('citoyen.partials.details-deces')
                    @else
                        <div class="alert alert-warning">
                            Les détails de ce document ne sont pas encore disponibles.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</x-app-layout>
<x-app-layout>
    @section('title', 'Mes demandes')

    @section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4" id="demandes">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Mes demandes d'actes d'État Civil</h6>
                        </div>
                    </div>
                    
                    <div class="card-body px-0 pb-2">
                        <!-- Affichage des statistiques -->
                        <div class="stats-section mb-4 px-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body text-center">
                                            <h5>Total</h5>
                                            <h3>{{ $stats['total'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body text-center">
                                            <h5>Traitées</h5>
                                            <h3>{{ $stats['traitees'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-info text-white">
                                        <div class="card-body text-center">
                                            <h5>En cours</h5>
                                            <h3>{{ $stats['en_cours'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-danger text-white">
                                        <div class="card-body text-center">
                                            <h5>Rejetées</h5>
                                            <h3>{{ $stats['rejetees'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Système d'onglets -->
                        <ul class="nav nav-tabs" id="demandesTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button">
                                    Toutes mes demandes
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="traitees-tab" data-bs-toggle="tab" data-bs-target="#traitees" type="button">
                                    Traitées 
                                    <span class="badge bg-success rounded-pill ms-2">{{ $stats['traitees'] }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="rejetees-tab" data-bs-toggle="tab" data-bs-target="#rejetees" type="button">
                                    Rejetées
                                    <span class="badge bg-danger rounded-pill ms-2">{{ $stats['rejetees'] }}</span>
                                </button>
                            </li>
                        </ul>
                        
                        <div class="tab-content p-3" id="demandesTabContent">
                            <!-- Onglet Toutes les demandes -->
                            <div class="tab-pane fade show active" id="all" role="tabpanel">
                                @if($demandes->isEmpty())
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Vous n'avez aucune demande pour le moment.
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>N° Demande</th>
                                                    <th>Type d'acte</th>
                                                    <th>Date</th>
                                                    <th>Statut</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($demandes as $demande)
                                                <tr>
                                                    <td>#{{ $demande->id_demande }}</td>
                                                    <td>
                                                        @switch($demande->type_acte)
                                                            @case('naissance') Acte de naissance @break
                                                            @case('mariage') Acte de mariage @break
                                                            @case('deces') Acte de décès @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $demande->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        @if($demande->statut_demande === 'traitee')
                                                            <span class="badge bg-success">Traitée</span>
                                                        @elseif($demande->statut_demande === 'rejetee')
                                                            <span class="badge bg-danger">Rejetée</span>
                                                        @elseif(in_array($demande->statut_demande, ['en_cours', 'en_traitement']))
                                                            <span class="badge bg-info">En cours</span>
                                                        @else
                                                            <span class="badge bg-warning">En attente</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('demandes.show', $demande->id_demande) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> Détails
                                                        </a>
                                                        @if($demande->statut_demande === 'traitee' && $demande->pdf_path)
                                                            <a href="{{ route('demandes.telecharger', $demande->id_demande) }}" class="btn btn-sm btn-success">
                                                                <i class="fas fa-file-pdf"></i> PDF
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $demandes->links() }}
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Onglet Demandes traitées -->
                            <div class="tab-pane fade" id="traitees" role="tabpanel">
                                @if($demandesTraitees->isEmpty())
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Vous n'avez aucune demande traitée.
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>N° Demande</th>
                                                    <th>Type d'acte</th>
                                                    <th>Date demande</th>
                                                    <th>Date traitement</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($demandesTraitees as $demande)
                                                <tr>
                                                    <td>#{{ $demande->id_demande }}</td>
                                                    <td>
                                                        @switch($demande->type_acte)
                                                            @case('naissance') Acte de naissance @break
                                                            @case('mariage') Acte de mariage @break
                                                            @case('deces') Acte de décès @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $demande->created_at->format('d/m/Y') }}</td>
                                                    <td>{{ $demande->date_traitement->format('d/m/Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('demandes.show', $demande->id_demande) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> Détails
                                                        </a>
                                                        <a href="{{ route('demandes.telecharger', $demande->id_demande) }}" class="btn btn-sm btn-success">
                                                            <i class="fas fa-file-pdf"></i> PDF
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Onglet Demandes rejetées -->
                            <div class="tab-pane fade" id="rejetees" role="tabpanel">
                                @if($demandesRejetees->isEmpty())
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Vous n'avez aucune demande rejetée.
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>N° Demande</th>
                                                    <th>Type d'acte</th>
                                                    <th>Date demande</th>
                                                    <th>Motif rejet</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($demandesRejetees as $demande)
                                                <tr>
                                                    <td>#{{ $demande->id_demande }}</td>
                                                    <td>
                                                        @switch($demande->type_acte)
                                                            @case('naissance') Acte de naissance @break
                                                            @case('mariage') Acte de mariage @break
                                                            @case('deces') Acte de décès @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $demande->created_at->format('d/m/Y') }}</td>
                                                    <td>{{ $demande->motif_rejet ?? 'Non spécifié' }}</td>
                                                    <td>
                                                        <a href="{{ route('demandes.show', $demande->id_demande) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i> Détails
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Activation des onglets Bootstrap
            var tabElms = [].slice.call(document.querySelectorAll('#demandesTab button'));
            tabElms.forEach(function(tabEl) {
                tabEl.addEventListener('click', function(event) {
                    event.preventDefault();
                    new bootstrap.Tab(tabEl).show();
                });
            });
        });
    </script>
    @endsection
</x-app-layout>
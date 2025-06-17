<x-app-layout>

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
            <div class="position-sticky pt-3">
                <div class="text-center mb-4">
                    <img src="{{ asset('photos/avatar.png') }}" alt="Profile" class="rounded-circle" width="80">
                    
                    <h5 class="text-white mt-2">{{ auth()->user()->prenoms }} {{ auth()->user()->nom }}</h5>
                    <p class="text-muted small">{{ auth()->user()->role }}</p>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="#dashboard">
                            <i class="fas fa-tachometer-alt me-2"></i> Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link text-white" 
       href="{{ $derniereDemande ? route('demandes.pdf_view', ['demande' => $derniereDemande->id_demande]) : '#' }}"
       @if(!$derniereDemande) onclick="event.preventDefault(); alert('Vous n\'avez aucune demande traitée pour le moment.');" @endif>
        <i class="fas fa-file-alt me-2"></i> Dernier document
    </a>
</li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="newRequestDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-plus-circle me-2"></i> Nouvelle demande
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="newRequestDropdown">
                            <li><a class="dropdown-item" href="{{ route('demande.nouvelle', ['type' => 'naissance']) }}">Acte de naissance</a></li>
                            <li><a class="dropdown-item" href="{{ route('demande.nouvelle', ['type' => 'mariage']) }}">Acte de mariage</a></li>
                            <li><a class="dropdown-item" href="{{ route('demande.nouvelle', ['type' => 'deces']) }}">Acte de décès</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('profile.show') }}">
                            <i class="fas fa-user me-2"></i> Mon profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tableau de bord</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        
                    </div>
                    
                </div>
            </div>

            <!-- Stats Cards -->
            <!-- Dans la section Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Demandes totales</h6>
                        <h2 class="card-text">{{ $stats['total'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-file-alt fa-3x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Demandes traitées</h6>
                        <h2 class="card-text">{{ $stats['traitees'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-check-circle fa-3x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">En cours</h6>
                        <h2 class="card-text">{{ $stats['en_cours'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-spinner fa-3x"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Demandes rejetées</h6>
                        <h2 class="card-text">{{ $stats['rejetees'] ?? 0 }}</h2>
                    </div>
                    <i class="fas fa-times-circle fa-3x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

            <!-- Recent Demands -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Mes dernières demandes</h5>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="newDemandDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-plus me-1"></i> Nouvelle demande
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="newDemandDropdown">
                                <li><a class="dropdown-item" href="{{ route('demande.nouvelle', ['type' => 'naissance']) }}">Acte de naissance</a></li>
                                <li><a class="dropdown-item" href="{{ route('demande.nouvelle', ['type' => 'mariage']) }}">Acte de mariage</a></li>
                                <li><a class="dropdown-item" href="{{ route('demande.nouvelle', ['type' => 'deces']) }}">Acte de décès</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Type</th>
                                    <th>Date demande</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($demandes as $demande)
                                <tr>
                                    <td>{{ $demande->id_demande }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match($demande->type_acte) {
                                                'naissance' => 'info',
                                                'mariage' => 'primary',
                                                'deces' => 'secondary',
                                                default => 'light'
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }}">
                                            {{ ucfirst($demande->type_acte) }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($demande->date_demande)->format('d/m/Y H:i') }}</td>

                                    <td>
                                        @php
                                            $statusClass = match($demande->statut_demande) {
                                                'traitee' => 'success',
                                                'rejetee' => 'danger',
                                                'en_cours' => 'warning',
                                                default => 'secondary'
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $statusClass }}">
                                            {{ ucfirst(str_replace('_', ' ', $demande->statut_demande)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('citoyen.demandes.show', $demande->id_demande) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($demande->statut_demande == 'en_cours')
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $demande->id_demande }}">
                                                <i class="fas fa-times"></i>
                                            </button>

                                            <!-- Modal de confirmation d'annulation -->
                                            <div class="modal fade" id="cancelModal{{ $demande->id_demande }}" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="cancelModalLabel">Confirmation d'annulation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Êtes-vous sûr de vouloir annuler cette demande d'acte de {{ $demande->type_acte }} ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                            <form action="{{ route('citoyen.demandes.cancel', $demande->id_demande) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-danger">Confirmer l'annulation</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune demande enregistrée</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($demandes->count() > 0)
                    <div class="d-flex justify-content-center mt-3">
                        {{ $demandes->links() }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Actions rapides</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <a href="{{ route('demande.nouvelle', ['type' => 'naissance']) }}" class="btn btn-outline-primary w-100 py-3">
                                        <i class="fas fa-baby fa-2x mb-2"></i><br>
                                        Naissance
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('demande.nouvelle', ['type' => 'mariage']) }}" class="btn btn-outline-success w-100 py-3">
                                        <i class="fas fa-ring fa-2x mb-2"></i><br>
                                        Mariage
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('demande.nouvelle', ['type' => 'deces']) }}" class="btn btn-outline-secondary w-100 py-3">
                                        <i class="fas fa-cross fa-2x mb-2"></i><br>
                                        Décès
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('citoyen.demandes.index') }}" class="btn btn-outline-info w-100 py-3">
                                        <i class="fas fa-history fa-2x mb-2"></i><br>
                                        Historique
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Statut des demandes</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="demandStatusChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart.js configuration
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('demandStatusChart').getContext('2d');
        
        // Vérifier si l'élément existe
        if (!ctx) {
            console.error("Élément canvas 'demandStatusChart' non trouvé");
            return;
        }
        
        // Valeurs par défaut si non définies
        const traitees = {{ $stats['traitees'] ?? 0 }};
        const enCours = {{ $stats['en_cours'] ?? 0 }};
        const rejetees = {{ $stats['rejetees'] ?? 0 }};
        
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Traitées', 'En cours', 'Rejetées'],
                datasets: [{
                    data: [traitees, enCours, rejetees],
                    backgroundColor: [
                        '#28a745', // vert pour traitées
                        '#ffc107', // jaune pour en cours
                        '#dc3545'  // rouge pour rejetées
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((acc, curr) => acc + curr, 0);
                                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
        
        // Initialiser les tooltips et popovers Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });
    });
    
    // Fonctionnalité pour la barre latérale mobile
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.querySelector('.navbar-toggler');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                document.querySelector('.sidebar').classList.toggle('show');
            });
        }
    });

    const ctx = document.getElementById('demandStatusChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Traitées', 'En cours', 'Rejetées'],
        datasets: [{
            data: [
                {{ $stats['traitees'] ?? 0 }},
                {{ $stats['en_cours'] ?? 0 }},
                {{ $stats['rejetees'] ?? 0 }}
            ],
            backgroundColor: [
                '#28a745', // vert pour traitées
                '#ffc107', // jaune pour en cours
                '#dc3545'  // rouge pour rejetées
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});
</script>
@endpush
</x-app-layout>
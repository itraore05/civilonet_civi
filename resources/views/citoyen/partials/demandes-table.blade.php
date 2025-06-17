@if($demandes->isEmpty())
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        Aucune demande dans cette catégorie.
    </div>
@else
    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° Demande</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type d'acte</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de demande</th>
                    @if(isset($showDateTraitement) && $showDateTraitement)
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de traitement</th>
                    @endif
                    @if(isset($showMotifRejet) && $showMotifRejet)
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Motif du rejet</th>
                    @endif
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($demandes as $demande)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">#{{ $demande->id_demande }}</h6>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-sm font-weight-bold mb-0">
                            @switch($demande->type_acte)
                                @case('naissance') Acte de naissance @break
                                @case('mariage') Acte de mariage @break
                                @case('deces') Acte de décès @break
                                @default {{ $demande->type_acte }}
                            @endswitch
                        </p>
                    </td>
                    <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $demande->created_at->format('d/m/Y') }}</p>
                    </td>
                    @if(isset($showDateTraitement) && $showDateTraitement)
                        <td>
                            <p class="text-sm font-weight-bold mb-0">
                                {{ $demande->date_traitement ? $demande->date_traitement->format('d/m/Y') : '-' }}
                            </p>
                        </td>
                    @endif
                    @if(isset($showMotifRejet) && $showMotifRejet)
                        <td>
                            <p class="text-sm text-danger mb-0">{{ $demande->motif_rejet ?: 'Non spécifié' }}</p>
                        </td>
                    @endif
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <a href="{{ route('dashboard.demandes.show', $demande->id_demande) }}" class="btn btn-sm btn-info me-2">
                                <i class="fas fa-eye"></i> Détails
                            </a>
                            @if(isset($showDownload) && $showDownload && $demande->pdf_path)
                                <a href="{{ route('dashboard.demandes.telecharger', $demande->id_demande) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-file-pdf"></i> Télécharger
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
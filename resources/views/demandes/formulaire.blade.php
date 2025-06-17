@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>
                        Demande d'acte de {{ ucfirst($type) }}
                    </h4>
                </div>

                <div class="card-body">
                    @include('demandes.partials.alerts')

                    <form method="POST" action="{{ route('demande.store') }}" novalidate>
                        @csrf
                        <input type="hidden" name="type_acte" value="{{ $type }}">
                        
                        @if($type === 'naissance')
                            @include('demandes.partials.form-naissance')
                        @elseif($type === 'mariage')
                            @include('demandes.partials.form-mariage')
                        @elseif($type === 'deces')
                            @include('demandes.partials.form-deces')
                        @endif

                        <div class="form-check mt-4 mb-4">
                            <input class="form-check-input @error('certifie') is-invalid @enderror" 
                                   type="checkbox" name="certifie" id="certifie" required>
                            <label class="form-check-label fw-bold" for="certifie">
                                Je certifie sur l'honneur l'exactitude des informations fournies
                            </label>
                            @error('certifie')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-3">
                            <a href="{{ route('citoyen.dashboard') }}" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-times me-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i> Soumettre la demande
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
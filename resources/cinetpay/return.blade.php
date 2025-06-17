@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Paiement traité</div>

                <div class="card-body">
                    <p>Votre paiement a été traité. Veuillez vérifier votre espace personnel pour connaître le statut de votre demande.</p>
                    
                    <a href="{{ route('citoyen.dashboard') }}" class="btn btn-primary">
                        Retour à mon tableau de bord
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
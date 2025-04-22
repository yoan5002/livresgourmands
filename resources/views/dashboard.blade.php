@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-primary text-white d-flex align-items-center justify-content-between">
                    <h4 class="mb-0"><i class="bi bi-speedometer2 me-2"></i> Tableau de bord</h4>
                    <span class="badge bg-light text-primary fw-semibold">Connecté</span>
                </div>
                <div class="card-body">
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div>
                            Bienvenue sur la plateforme <strong>LivresGourmands.net</strong> !
                        </div>
                    </div>
                    <p class="text-muted mb-1">
                        Vous êtes connecté avec succès. Utilisez le menu ci-dessus pour naviguer selon vos droits d’accès.
                    </p>
                    <hr>
                    <div class="text-end">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                            <i class="bi bi-house-door-fill me-1"></i> Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

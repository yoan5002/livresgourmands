@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4><i class="bi bi-journal-bookmark-fill me-2"></i> Catalogue des livres</h4>
        </div>
        <div class="card-body">
            <p class="mb-4">
                Bienvenue dans le tableau de bord du gestionnaire. Voici tous les livres actuellement enregistrés.
            </p>

            @if($livres->isEmpty())
                <div class="alert alert-warning text-center">
                    Aucun livre trouvé pour le moment.
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($livres as $livre)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm">
                                @if($livre->image)
                                    <img src="{{ asset($livre->image) }}" class="card-img-top" alt="Image du livre">
                                @else
                                    <img src="https://via.placeholder.com/300x180" class="card-img-top" alt="Image par défaut">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $livre->titre }}</h5>
                                    <p class="card-text">Auteur : {{ $livre->auteur }}</p>
                                    <p class="card-text text-muted">
                                        Catégorie : {{ $livre->categorie->nom ?? 'Non spécifiée' }}
                                    </p>
                                    <p class="card-text">
                                        Niveau : 
                                        <span class="badge bg-{{ $livre->niveau_expertise == 'chef' ? 'danger' : ($livre->niveau_expertise == 'amateur' ? 'warning text-dark' : 'info') }}">
                                            {{ ucfirst($livre->niveau_expertise) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="card-footer bg-light text-end">
                                    <span class="text-primary fw-bold">{{ number_format($livre->prix, 2) }} $</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

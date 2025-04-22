@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <!-- Formulaire -->
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-book me-2"></i> Ajouter un nouveau livre
        </div>
        <div class="card-body">
            <form action="{{ route('livres.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" name="titre" class="form-control" placeholder="Titre du livre" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="auteur" class="form-control" placeholder="Auteur" required>
                    </div>
                </div>
                <div class="mb-3">
                    <textarea name="description" class="form-control" placeholder="Description" rows="3" required></textarea>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select name="niveau_expertise" class="form-select" required>
                            <option value="">Niveau d'expertise</option>
                            <option value="débutant">Débutant</option>
                            <option value="amateur">Amateur</option>
                            <option value="chef">Chef</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="category_id" class="form-select" required>
                            <option value="">Catégorie</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="prix" step="0.01" class="form-control" placeholder="Prix $" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image du livre</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-plus-circle me-1"></i> Ajouter le livre
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des livres -->
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <i class="bi bi-collection me-2"></i> Livres existants
        </div>
        <div class="card-body p-0">
            @if($livres->isEmpty())
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-exclamation-circle me-2"></i>Aucun livre pour le moment.
                </div>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($livres as $livre)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                @if($livre->image && file_exists(public_path($livre->image)))
                                    <img src="{{ asset($livre->image) }}" alt="Image" class="me-3" width="60" height="60" style="object-fit: cover; border-radius: 4px;">
                                @else
                                    <img src="{{ asset('uploads/livre/default.png') }}" alt="Default" class="me-3" width="60" height="60" style="object-fit: cover; border-radius: 4px;">
                                @endif
                                <div>
                                    <h5 class="mb-1">{{ $livre->titre }}</h5>
                                    <small class="text-muted">
                                        {{ $livre->auteur }} | {{ $livre->categorie?->nom ?? 'Catégorie inconnue' }} | 
                                        <span class="badge bg-{{ $livre->niveau_expertise === 'chef' ? 'danger' : ($livre->niveau_expertise === 'amateur' ? 'primary' : 'info') }}">
                                            {{ ucfirst($livre->niveau_expertise) }}
                                        </span>
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold">{{ number_format($livre->prix, 2) }} $</span>
                                <form method="POST" action="{{ route('livres.destroy', $livre->id) }}" onsubmit="return confirm('Supprimer ce livre ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection

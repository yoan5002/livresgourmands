@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-chat-left-text-fill me-2"></i> Ajouter un commentaire
        </div>
        <div class="card-body">
            <form action="{{ route('commentaires.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="livre_id" class="form-label">Sélectionner un livre</label>
                    <select name="livre_id" id="livre_id" class="form-select" required>
                        <option value="">-- Choisissez un livre --</option>
                        @foreach($livres as $livre)
                            <option value="{{ $livre->id }}">{{ $livre->titre }} - {{ $livre->auteur }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="contenu" class="form-label">Commentaire</label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="4" placeholder="Votre commentaire..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send-fill me-1"></i> Soumettre
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <i class="bi bi-clock-history me-2"></i> Commentaires en attente de validation
        </div>
        <div class="card-body p-0">
            @if($commentaires->isEmpty())
                <div class="p-4 text-muted text-center">
                    <i class="bi bi-info-circle me-2"></i> Aucun commentaire en attente.
                </div>
            @else
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Livre</th>
                            <th>Contenu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commentaires as $commentaire)
                            <tr>
                                <td>{{ $commentaire->livre->titre ?? 'Livre inconnu' }}</td>
                                <td>{{ $commentaire->contenu }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark">En attente</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

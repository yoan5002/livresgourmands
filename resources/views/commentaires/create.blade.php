@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-chat-left-text me-2"></i> Ajouter un nouveau commentaire
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('commentaires.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="livre_id" class="form-label">Sélectionner un livre</label>
                    <select name="livre_id" class="form-select" required>
                        <option value="">-- Choisir un livre --</option>
                        @foreach($livres as $livre)
                            <option value="{{ $livre->id }}">{{ $livre->titre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="contenu" class="form-label">Contenu du commentaire</label>
                    <textarea name="contenu" class="form-control" rows="4" placeholder="Rédigez votre commentaire ici..." required></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send-fill me-1"></i> Soumettre pour validation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

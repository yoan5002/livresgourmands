@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Commentaires à valider</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if($commentaires->isEmpty())
        <div class="alert alert-info">Aucun commentaire à afficher.</div>
    @else
        <ul class="list-group">
            @foreach($commentaires as $commentaire)
                <li class="list-group-item">
                    <p>
                        <strong>{{ $commentaire->user->name ?? 'Utilisateur inconnu' }}</strong> a écrit sur 
                        <em>{{ $commentaire->livre->titre ?? 'Livre inconnu' }}</em> :
                    </p>
                    <blockquote class="blockquote mb-2">{{ $commentaire->contenu }}</blockquote>

                    <div class="d-flex gap-2">
                        <!-- Bouton Valider -->
                        <form method="POST" action="{{ route('commentaires.update', ['id' => $commentaire->id, 'action' => 'valide']) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi bi-check-circle me-1"></i> Valider
                            </button>
                        </form>

                        <!-- Bouton Rejeter -->
                        <form method="POST" action="{{ route('commentaires.update', ['id' => $commentaire->id, 'action' => 'rejete']) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-x-circle me-1"></i> Rejeter
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

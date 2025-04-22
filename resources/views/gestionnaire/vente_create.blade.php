@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Ajouter une vente</h2>
    <form method="POST" action="{{ route('ventes.store') }}">
        @csrf
        <div class="mb-3">
            <label>Client</label>
            <select name="user_id" class="form-select" required>
                <option value="">Sélectionner un utilisateur</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Livre</label>
            <select name="livre_id" class="form-select" required>
                <option value="">Sélectionner un livre</option>
                @foreach($livres as $livre)
                    <option value="{{ $livre->id }}">{{ $livre->titre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <input type="number" name="quantite" class="form-control" placeholder="Quantité" required>
        </div>
        <div class="mb-3">
            <input type="number" step="0.01" name="prix_unitaire" class="form-control" placeholder="Prix unitaire" required>
        </div>
        <button type="submit" class="btn btn-success">Ajouter la vente</button>
    </form>
</div>
@endsection

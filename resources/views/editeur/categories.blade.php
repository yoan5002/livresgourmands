@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestion des Catégories</h1>

    <form action="{{ route('categories.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de la catégorie</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    <h2>Catégories existantes</h2>
    <ul class="list-group">
        @foreach($categories as $categorie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $categorie->nom }}
                <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection

@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container mt-5">
    {{-- Message succès --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    {{-- Messages d’erreur --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreur :</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de création -->
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-person-plus-fill me-2"></i> Créer un nouvel utilisateur
        </div>
        <div class="card-body">
            <form action="{{ route('admin.utilisateurs.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="Nom" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-4">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <select name="role_id" class="form-select" required>
                            <option value="">Choisir un rôle</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                    {{ ucfirst($role->nom) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus-fill me-1"></i> Créer l’utilisateur
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des utilisateurs -->
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <i class="bi bi-people-fill me-2"></i> Utilisateurs existants
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($utilisateurs as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @php
                                    $nomRole = strtolower($user->role->nom ?? '');
                                    $badgeColor = match($nomRole) {
                                        'administrateur' => 'bg-success',
                                        'éditeur' => 'bg-info text-dark',
                                        'gestionnaire' => 'bg-primary',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badgeColor }}">
                                    {{ ucfirst($user->role->nom ?? 'Aucun') }}
                                </span>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.utilisateurs.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucun utilisateur trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

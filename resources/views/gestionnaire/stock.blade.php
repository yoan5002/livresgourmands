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

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-box-seam me-2"></i> Gestion des stocks
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead class="table-light">
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>Stock actuel</th>
                        <th>Modifier le stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($livres as $livre)
                        <tr>
                            <td>{{ $livre->titre }}</td>
                            <td>{{ $livre->auteur }}</td>
                            <td>
                                <span class="badge {{ $livre->stock > 10 ? 'bg-success' : ($livre->stock > 0 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                    {{ $livre->stock }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('stock.update', $livre->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantite" class="form-control form-control-sm w-50" placeholder="+ / - ex: 5 ou -2" required>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-arrow-repeat me-1"></i> Mettre à jour
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Aucun livre trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

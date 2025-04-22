@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-cart-check-fill me-2"></i> Historique des ventes
        </div>

        <div class="card-body p-0">
            @if($ventes->isEmpty())
                <div class="p-4 text-center text-muted">
                    <i class="bi bi-exclamation-circle me-2"></i> Aucune vente enregistrée pour le moment.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Livre</th>
                                <th>Client</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventes as $vente)
                                <tr>
                                    <td>
                                        @if($vente->livre)
                                            {{ $vente->livre->titre }}
                                        @else
                                            <span class="text-danger">Livre supprimé</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $vente->user->name ?? 'Utilisateur inconnu' }}
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $vente->quantite }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ number_format($vente->prix_unitaire, 2) }} $</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(145deg, #2c2c2c, #444);
        font-family: 'Segoe UI', sans-serif;
    }

    .welcome-card {
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        padding: 3rem 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        color: #fff;
        max-width: 550px;
        text-align: center;
        animation: fadeIn 1s ease;
    }

    .welcome-card h1 {
        font-weight: 800;
        font-size: 2.2rem;
    }

    .welcome-card .brand {
        color: #ffc107;
        font-size: 2.3rem;
    }

    .welcome-card p {
        margin-top: 1rem;
        color: #ddd;
        font-size: 1rem;
    }

    .welcome-btn {
        width: 100%;
        font-size: 1.1rem;
        padding: 0.75rem;
    }

    .btn-outline-light {
        border-color: #fff;
        color: #fff;
    }

    .btn-outline-light:hover {
        background-color: #fff;
        color: #000;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="welcome-card">
        <div class="mb-4">
            <h1> Bienvenue sur<br><span class="brand">LivresGourmands.net</span></h1>
            <p>Découvrez, gérez et partagez des livres de cuisine inspirants.<br>Que vous soyez chef ou amateur, un monde de saveurs vous attend.</p>
        </div>

        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-success welcome-btn mb-2">
                <i class="bi bi-speedometer2 me-1"></i> Accéder au tableau de bord
            </a>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-light welcome-btn mb-3">
                <i class="bi bi-box-arrow-in-right me-1"></i> Se connecter
            </a>
            <a href="{{ route('register') }}" class="btn btn-warning text-dark welcome-btn">
                <i class="bi bi-person-plus-fill me-1"></i> Créer un compte
            </a>
        @endauth
    </div>
</div>
@endsection

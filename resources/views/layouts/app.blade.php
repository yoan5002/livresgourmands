<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivresGourmands</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">LivresGourmands</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-1"></i> Tableau de bord
                            </a>
                        </li>

                        @if(Auth::user()->role?->nom === 'administrateur')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.utilisateurs') }}">
                                    <i class="bi bi-people-fill me-1"></i> Utilisateurs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gestionnaire.catalogue') }}">
                                    <i class="bi bi-book me-1"></i> Catalogue
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gestionnaire.stock') }}">
                                    <i class="bi bi-box-seam me-1"></i> Stock
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ventes.index') }}">
                                    <i class="bi bi-cart-check me-1"></i> Ventes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('commentaires.create') }}">
                                    <i class="bi bi-chat-left-text me-1"></i> Ajouter un commentaire
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('commentaires.index') }}">
                                    <i class="bi bi-chat-left-text me-1"></i> Commentaires
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->role?->nom === 'gestionnaire')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gestionnaire.catalogue') }}">
                                    <i class="bi bi-book me-1"></i> Catalogue
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('gestionnaire.stock') }}">
                                    <i class="bi bi-box-seam me-1"></i> Stock
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ventes.index') }}">
                                    <i class="bi bi-cart-check me-1"></i> Ventes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ventes.create') }}">Ajouter une vente</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                    @endauth
                </ul >
                       
                <ul class="navbar-nav ms-auto">

                    @auth
                    @if(Auth::user()->role?->nom === 'éditeur')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('editeur.livres') }}">Livres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('editeur.categories') }}">Catégories</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('commentaires.create') }}">
                                <i class="bi bi-chat-left-text me-1"></i> Ajouter un commentaire
                            </a>
                        </li>
                    @endif
                @endauth


                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

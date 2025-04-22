<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 shadow">
    <a class="navbar-brand" href="{{ route('dashboard') }}">LivresGourmands</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto">
            @auth
                @php $role = Auth::user()->role->nom ?? ''; @endphp

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        Tableau de bord
                    </a>
                </li>

                @if($role === 'administrateur')
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.utilisateurs') }}">Utilisateurs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('commentaires.index') }}">Commentaires</a></li>
                @elseif($role === 'éditeur')
                    <li class="nav-item"><a class="nav-link" href="{{ route('livres.index') }}">Livres</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('commentaires.index') }}">Commentaires</a></li>
                @elseif($role === 'gestionnaire')
                    <li class="nav-item"><a class="nav-link" href="{{ route('ventes.index') }}">Ventes</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('catalogue') }}">Catalogue</a></li>
                @endif
            @endauth
        </ul>

        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-capitalize" href="#" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endauth
        </ul>
    </div>
</nav>

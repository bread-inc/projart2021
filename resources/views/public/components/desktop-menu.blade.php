<nav id="desktop-menu">
    <div class="menu-logo">
        <img src="{{asset('storage/images/logo/logo-white.svg')}}" alt="SwissGuesser">
    </div>

    <a href="{{route('home')}}" class="btn btn-light btn-square">Tableau de bord</a>

    <div class="menu-group">
        <h3>Les quiz</h3>
        <ul>
            <li><a href="{{route('region.index')}}"><i class="far fa-mountains mr-2"></i>Les régions</a></li>
            <li><a href="{{route('map.desktop')}}"><i class="far fa-map mr-2"></i>La carte</a></li>
            <li><a href="{{route('global-ranking')}}"><i class="fas fa-chart-bar mr-2"></i>Classement général</a></li>
        </ul>
    </div>

    @if (auth()->user())
    <div class="menu-group">
        <h3>Mon compte</h3>
        <ul>
            <li><a href="{{route('profile.show', [auth()->id()])}}"><i class="far fa-user mr-2"></i>Mon profil</a></li>
            <li><a href="{{route('profile.show', [auth()->id(), '#favorites'])}}"><i class="fas fa-heart mr-2"></i>Mes favoris</a></li>
            <li><a href="{{route('profile.show', [auth()->id(), '#scores'])}}"><i class="fas fa-history mr-2"></i>Mon historique</a></li>
            @if (auth()->user()->isAdmin)
            <li><a href="{{route('admin.dashboard')}}"><i class="far fa-cog mr-2"></i>Administration</a></li>

            @endif
        </ul>
    </div>

    <form id="logout-form" method="POST" action="{{route('logout')}}" accept-charset="UTF-8">
        @csrf
        <input class="bottom-link" onclick="return confirm('Voulez-vous vraiment vous déconnecter ?')" type="submit" value="Déconnexion">
    </form>
    @else
    <a class="bottom-link" href="{{route('login')}}">Se connecter</a>
    @endif
</nav>

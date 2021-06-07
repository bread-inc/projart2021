<nav class="navbar py-3">
    <div class="container p-0">
        <a href="{{route('home')}}" class="float-left"><i class="fas fa-angle-left fa-2x fa-gradient"></i></a>
    @if(auth()->check() and auth()->user()->isAdmin)
        <a class="menu-btn" href='{{route('admin.dashboard')}}'>Admin</a>
    @endif
    @if(auth()->check())
        <form id="logout-form" method="POST" action="{{route('logout')}}" accept-charset="UTF-8">
            @csrf
            <input class="menu-btn" onclick="return confirm('Voulez-vous vraiment vous déconnecter ?')" type="submit" value="Déconnexion">
        </form>
    @endif
    </div>
</nav>
<div class="menu">
    <div class="d-flex justify-content-center">

    @if(auth()->check())
        <a href="user/{{$user->id}}">
            <img class="rounded-circle" src="{{$user->avatar}}" title="Profil" alt="Profil">
            <span>Profil</span>
        </a>
    @endif

    @if(auth()->check() and auth()->user()->isAdmin)
        <a href='admin' class='btn btn-warning'>dashboard Admin</a>
    @endif
    </div>
</div>
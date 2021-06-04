@if(auth()->check() and auth()->user()->isAdmin)
    <a href='admin' class='btn btn-warning'>dashboard Admin</a>
@endif
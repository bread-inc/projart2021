<nav class="navbar py-3">
    <div class="container p-0">
        <a href="{{route('home')}}"><i class="fas fa-angle-left fa-2x fa-gradient"></i></a>
        <a href="#"><i class="fas fa-cog fa-2x fa-gradient"></i></a>
    @if(auth()->check() and auth()->user()->isAdmin)
        <a href='admin'><i class="fas fa-user-shield fa-2x fa-gradient"></i></a>
    @endif
    </div>
</nav>
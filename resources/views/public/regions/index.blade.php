@extends('.layouts.app')

@section('content')

<nav class="navbar py-3 d-block d-md-none">
    <div class="container p-0">
        <a href="{{route('home')}}"><i class="fas fa-angle-left fa-2x fa-gradient"></i></a>
    </div>
</nav>

<div class="grid">
    <div class="container" id="regions-index-title">
        <div class="row">
            <div class="col-9">
                <h1>Toutes les régions</h1>
            </div>
            @if(auth()->check())
            <div class="col-3">
                <a href="{{route('profile.show', [auth()->id()])}}" class="profile-picture">
                    <img class="rounded-circle" src="{{auth()->user()->avatar}}" title="Profil" alt="Profil">
                    <span>Profil</span>
                </a>
            </div>
            @endif
        </div>
    </div>
    <div class="container box" id="regions-index">
        <div id="vue-app">
            <region-list :regions="{{ $regions }}"></region-list>
        </div>
    </div>
</div>

@endsection

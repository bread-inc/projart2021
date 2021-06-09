@extends('.layouts.app')

@section('content')

<div class="grid">
    <div class="container" id="regional-scores-title">
        <div class="row mb-3">
            <div class="col-8">
                <h1>Classement global</h1>
            </div>
            @if(auth()->check())
                <div class="col-4">
                    <a href="{{route('profile.show', [auth()->id()])}}" class="profile-picture">
                        <img class="rounded-circle" src="{{auth()->user()->avatar}}" title="Profil" alt="Profil">
                        <span>Profil</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <div class="container box" id="regional-scores">
        <div id="vue-app">
            <score-list :scores="{{ $scores }}" :id="{{ auth()->check() }}"></score-list>
        </div>
    </div>
</div>

@endsection

@extends('.layouts.app')

@section('content')

<?php use App\Models\Quiz; ?>

@include('public.components.user_profile_menu')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <img src="{{ $user->avatar }}" alt="{{ $user->pseudo }}" class="rounded-circle">
            <h2 class="m-0 mt-3">{{ $user->pseudo }}</h2>
            <p><small>XXXX points</small></p>
        </div>
    </div>
</div>

<nav id="tabs-bar">
    <a id="btn-badges" class="tab-button tab-selected" href="#badges">Badges</a>
    <a id="btn-favorites" class="tab-button" href="#favorites">Favoris</a>
    <a id="btn-scores" class="tab-button" href="#scores">Scores</a>
</nav>

<div id="vue-app">
    <section id="badges" class="page container bg-white py-3">
        <badge-list :badges="{{ $user->badges()->orderBy('created_at', 'DESC')->get() }}" :auth="{{ auth()->check() }}"></badge-list>
    </section>
    
    <!-- Badge details, à injecter en JS au clic -->
    <div class="badge-detail d-none" id="badge-id">
        <a href="#"><i class="fas fa-times fa-2x fa-gradient"></i></a>
        <div class="badge-detail-container">
            <div class="badge" style="background-color:#6a38db">
                <i class="fas fa-cookie-bite"></i>
            </div>
            <div class="badge-description">
                <h2>Le dévoreur</h2>
                <h4>Tu as dévoré 20 quizzes.</h4>
            </div>
        </div>
    </div>

    <section id="favorites" class="page container bg-white py-3">
        <div class="row">
            @foreach (Quiz::all() as $favoriteQuiz)
            <div class="col-6">
                <a href="#" class="quiz quiz-2x">
                    <div class="quiz-thumb" style="background-image: url('');">
                        <h5>{{$favoriteQuiz->title}}</h5>
                    </div>
                    <div class="label">
                        <small>{{ "date "}}</small>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <section id="scores" class="page container bg-white py-3">
        <!-- Ajouter la class "my-score" à la <tr> de l'utilisateur -->
        <score-list :scores="{{ $scores }}"></score-list>
    </section>
</div>

@endsection

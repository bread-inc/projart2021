@extends('.layouts.app')

@section('content')

<?php use App\Models\Quiz; ?>

@include('public.components.user_profile_menu')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 text-center">
            <img src="{{ $user->avatar }}" alt="{{ $user->pseudo }}" class="rounded-circle user-profile-img">
            <h2 class="m-0 mt-3">{{ $user->pseudo }}</h2>
            <p><small>{{$user_score}} pts</small></p>
        </div>
    </div>
</div>

<nav id="tabs-bar">
    <a id="btn-badges" class="tab-button tab-selected" href="#badges">Mes badges</a>
    <a id="btn-favorites" class="tab-button" href="#favorites">Mes favoris</a>
    <a id="btn-scores" class="tab-button" href="#scores">Historique</a>
</nav>

<div id="vue-app">
    <section id="badges" class="page container bg-white py-4">
        <badge-list :badges="{{ $user->badges()->orderBy('created_at', 'DESC')->get() }}" :auth="{{ auth()->check() }}"></badge-list>
    </section>

    @foreach ($user->badges as $badge)
    <!-- Badge details, à injecter en JS au clic -->
    <div class="badge-detail d-none" id="badge{{$badge->id}}">
        <a href="#badges"><i class="fas fa-times fa-2x fa-gradient"></i></a>
        <div class="badge-detail-container">
            <div class="badge" style="background-color:{{$badge->color}}">
                <i class="fas {{$badge->pictogram}}"></i>
            </div>
            <div class="badge-description">
                <h2>{{$badge->label}}</h2>
                <h4>{{$badge->description}}</h4>
            </div>
        </div>
    </div>
    @endforeach
    

    <section id="favorites" class="page container bg-white py-4">
        <div class="row">
            @foreach ($user->favorites->sortBy('quiz_id') as $favoriteQuiz)
                @if(!empty($favoriteQuiz))
                <div class="col-6 col-md-4">
                    <a href="{{route('game.info', [$favoriteQuiz->quiz->id])}}" class="quiz quiz-2x">
                        <div class="quiz-thumb" style="background-image: url('{{asset($favoriteQuiz->quiz->questions->first()->picture)}}');">
                            <h5>{{$favoriteQuiz->quiz->title}}</h5>
                        </div>
                        <div class="label">
                            <small>Difficulté : {{$favoriteQuiz->quiz->difficulty}}</small>
                        </div>
                    </a>
                </div>
                @endif
            @endforeach
        </div>
    </section>

    <section id="scores" class="page container bg-white py-4">
        <table class="score-table">
            <tbody>
                @foreach ($scores as $score)
                    <tr>
                        <td>{{$score->updated_at->format('d.m.Y')}}</td>
                        <td>
                            <a href="{{route('game.info', [$score->quiz_id])}}"><b>{{$score->quiz->title}}</b></a>
                            <small>{{$score->score}} pts</small>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>

@endsection

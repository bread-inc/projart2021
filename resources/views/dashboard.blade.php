@extends('.layouts.app')

@section('content')

<div class="container">
    <div id="vue-app">
        <div class="row my-5">
            <div class="col-8">
                <h1>
                    @if(auth()->check())
                        <b>Bienvenue</b> {{$user->pseudo}}
                    @else
                        <b>SwissGuesser</b>
                    @endif
                </h1>
            </div>
            <div class="col-4">
                @if(auth()->check())
                    <a href="user/{{$user->id}}" class="profile-picture">
                        <img class="rounded-circle" src="{{$user->avatar}}" title="Profil" alt="Profil">
                        <span>Profil</span>
                    </a>
                @endif
            </div>
        </div>
        <div class="row my-5">
            <div class="col-12">
            @if(isset($region) && !empty($region))
                <h2>à {{$region->name}} <i class="fal fa-location-arrow fa-xs"></i></h2>
                <quiz-list class="mb-2" :quizzes="{{ $region->quizzes }}"></quiz-list>
            @else
                <h2>Impossible de détecter la position</h2>
                Afficher des quizzes aléatoires ?
            @endif
                <a href="{{route('region.index')}}" class="btn btn-border">Voir toutes les régions</a>
            </div>
        </div>
        @if(auth()->check())
        <div class="row my-5">
            <div class="col-12">
                <h2>Derniers quizzes réalisés</h2>
                
                <div class="horizontal-slider-container">
                    <div class="horizontal-slider">
                        @foreach ($user->scores()->orderBy('created_at', 'desc')->get() as $completedQuiz)
                        <!-- element-->
                        <a href="{{route('game.info', [$completedQuiz->quiz->id])}}" class="quiz quiz-3x">
                            <div class="quiz-thumb" style="background-image: url('');">
                                <h5>{{$completedQuiz->quiz->title}}</h5>
                            </div>
                            <div class="label">
                                <small>{{$completedQuiz->created_at->format('d.m.Y')}}</small>
                            </div>
                        </a>
                        <!-- .element -->
                        @endforeach
                    </div>
                </div>
                
                <a href="#" class="btn btn-border">Tous mes quizzes</a>
            </div>
        </div>
        @endif
    
        <div class="row my-5">
            <div class="col-12">
                <h2>Derniers badges obtenus</h2>
            </div>
        @if(auth()->check())
            <div class="col-12">
                <badge-list :badges="{{ $user->badges()->orderBy('created_at', 'DESC')->get() }}" :auth="{{ auth()->check() }}"></badge-list>
            </div>
    
        
            <div class="col-12">
                <a href="user/{{$user->id}}#badges" class="btn btn-border">Tous mes badges</a>
            </div>
        @else
            <div class="col-12">
                <a href="{{route('login')}}" class="btn btn-border">Se connecter</a>
            </div>
        @endif
        </div>
    
    
        <div class="row my-5">
            <div class="col-12">
                <h2>Classement général</h2>
                
                <div id="vue-app">
                    <score-list :scores="{{ $scores }}"></score-list>
                </div>
    
                <a href="{{route('global-ranking')}}" class="btn btn-border">Voir le classement</a>
            </div>
        </div>
    </div>
    
    </div>
@endsection

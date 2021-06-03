@extends('.layouts.app')
<h1>DashboardUser</h1>
@section('content')
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

<div class="container">
    <div id="vue-app">
        <h1>
            @if(auth()->check())
                <b>Bienvenue</b> {{$user->pseudo}}
            @else
                <b>SwissGuesser</b>
            @endif
        </h1>
        <div class="row my-4">
            <div class="col-12">
            @if(isset($region) && !empty($region))
                <h2>À {{$region->name}} <i class="fal fa-location-arrow fa-xs"></i></h2>
                <quiz-list :quizzes="{{ $region->quizzes }}"></quiz-list>
            @else
                <h2>Impossible de détecter la position</h2>
                Afficher des quizzes aléatoires ?
            @endif
                <a href="/region" class="btn btn-primary">Voir toutes les régions</a>
            </div>
        </div>
        @if(auth()->check())
        <div class="row my-4">
            <div class="col-12">
                <h2>Derniers quizzes réalisés</h2>
    
                <ul>
                @foreach ($user->scores()->orderBy('created_at', 'desc')->get() as $completedQuiz)
                    <li>
                        <b>{{$completedQuiz->quiz->title}}</b><br>
                        Score : {{$completedQuiz->score}}<br>
                        Date : {{$completedQuiz->created_at->format('d.m.Y')}}
                    </li>
                @endforeach
                </ul>
                <a href="#" class="btn btn-primary">Tous mes quizzes</a>
            </div>
        </div>
        @endif
    
        <div class="row my-4">
            <div class="col-12">
                <h2>Derniers badges obtenus</h2>
            </div>
    
            <div class="col-12">
                <badge-list :badges="{{ $user->badges()->orderBy('created_at', 'DESC')->get() }}" :auth="{{ auth()->check() }}"></badge-list>            </div>
    
        @if(auth()->check())
            <div class="col-12">
                <a href="user/{{$user->id}}#badges" class="btn btn-primary">Tous mes badges</a>
            </div>
        @else
            <div class="col-12">
                <a href="{{route('login')}}" class="btn btn-primary">Se connecter</a>
            </div>
        @endif
        </div>
    
    
        <div class="row my-4">
            <div class="col-12">
                <h2>Classement général</h2>
                
                <div id="vue-app">
                    <score-list :scores="{{ $scores }}"></score-list>
                </div>
    
                <a href="{{route('global-ranking')}}" class="btn btn-primary">Voir le classement</a>
            </div>
        </div>
    </div>
    
    </div>
@endsection

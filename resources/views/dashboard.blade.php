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

            <ul>
            @foreach ($region->quizzes as $quiz)
                <li><a href="/quiz/{{$quiz->id}}/start">{{$quiz->title}}</a></li>
            @endforeach
            </ul>
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
            <ul>
        @foreach ($badges as $badge)
                <li>
                    <span class="fa-stack fa-2x">
                        <i class="fas fa-square fa-stack-2x" style="color:{{auth()->check() ? $badge->color : 'grey'}}"></i>
                        <i class="fas {{$badge->pictogram}} fa-stack-1x fa-inverse"></i>
                    </span>
                    @if(auth()->check())
                    {{$badge->pivot->created_at}}
                @endif
                </li>
        @endforeach
            </ul>
        </div>

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

@endsection

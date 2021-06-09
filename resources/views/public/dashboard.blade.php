@extends('.layouts.app')

@section('content')

<div id="vue-app" class="grid">
    <section class="container p-md-0 my-5 my-md-0" id="welcome">
        <div class="row">
            <div class="col-8">
                <div class="row">
                    @if(auth()->check())
                        <div class="col-12"><h3>Bienvenue</h3></div>
                        <div class="col-12"><h1>{{$user->pseudo}}</h1></div>
                    @else
                        <div class="col-12"><h1>SwissGuesser</h1></div>
                    @endif
                </div>
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
    </section>
    <section id="desktop-welcome" class="container box d-none d-md-block p-md-3 my-md-0">
        <div class="row">
            @if(auth())
            <div class="col-8"><h2><b>Préparez votre prochaine aventure</b></h2></div>
            <div class="col-4"></div>
            @else
            @endif
        </div>
    </section>
    <section id="regions" class="container box p-md-3 my-5 my-md-0">
        <div class="row">
            <div class="col-12">
            @if(isset($region) && !empty($region))
                <h2>à {{$region->name}} <i class="fal fa-location-arrow fa-xs"></i></h2>
                <?php 
                /* En attendant de corriger la vue
                <quiz-list class="mb-2" :quizzes="{{ $region->quizzes }}"></quiz-list>*/ 
                ?>

                <div class="horizontal-slider-container">
                    <div class="horizontal-slider">
                        @foreach ($region->quizzes as $quiz)
                        <!-- element-->
                        <a href="{{route('game.info', [$quiz->id])}}" class="quiz quiz-3x">
                            @if (file_exists(public_path() .'/'.$quiz->questions->first()->picture))
                            <div class="quiz-thumb" style="background-image: url('{{asset($quiz->questions->first()->picture)}}');">
                            @else
                            <div class="quiz-thumb">
                            @endif
                                <h5>{{$quiz->title}}</h5>
                            </div>
                            <div class="label">
                                <small>{{$quiz->difficulty}}</small>
                            </div>
                        </a>
                        <!-- .element -->
                        @endforeach
                    </div>
                </div>
            @else
                <h2>Impossible de détecter la position</h2>
                Afficher des quizzes aléatoires ?
            @endif
            </div>
            <div class="col-12">
                <a href="{{route('region.index')}}" class="btn btn-border">Voir toutes les régions</a>
            </div>
        </div>
    </section>
    @if(auth()->check())
    <section id="last-quizzes" class="container box p-md-3 my-5 my-md-0">
        <div class="row">
            <div class="col-12">
                <h2>Derniers quizzes réalisés</h2>
                
                <div class="horizontal-slider-container">
                    <div class="horizontal-slider">
                        @foreach ($user->scores()->orderBy('created_at', 'desc')->take(3)->get() as $completedQuiz)
                        <!-- element-->
                        <a href="{{route('game.info', [$completedQuiz->quiz->id])}}" class="quiz quiz-3x">
                            @if (file_exists(public_path() .'/'.$completedQuiz->quiz->questions->first()->picture))
                            <div class="quiz-thumb" style="background-image: url('{{asset($completedQuiz->quiz->questions->first()->picture)}}');">
                            @else
                            <div class="quiz-thumb">
                            @endif
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
                
                <a href="user/{{$user->id}}#favorites" class="btn btn-border">Tous mes quizzes</a>
            </div>
        </div>
    </section>
        @endif
    <section id="badges" class="container box p-md-3 my-5 my-md-0">
        <div class="row">
            <div class="col-12">
                <h2>Derniers badges obtenus</h2>
            </div>
        @if(auth()->check())
            <div class="col-12">
                <badge-list :badges="{{ $user->badges()->orderBy('created_at', 'DESC')->take(3)->get() }}" :auth="{{ auth()->check() }}"></badge-list>
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
    </section>
    
    <section id="scoreboard" class="container box p-md-3 bg-white py-5">    
        <div class="row">
            <div class="col-12">
                <h2>Classement général</h2>
                
                <div id="vue-app">
                    <score-list :scores="{{ $scores }}" :id="{{ Auth::id() }}"></score-list>
                </div>
    
                <a href="{{route('global-ranking')}}" class="btn btn-border">Voir le classement</a>
            </div>
        </div>
    </section>    
</div>
@endsection

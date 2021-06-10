@extends('.layouts.app')

@section('content')

<nav class="navbar py-3 d-block d-md-none">
    <div class="container p-0">
        <a href="{{route('region.index')}}"><i class="fas fa-angle-left fa-2x fa-gradient"></i></a>
    </div>
</nav>

<div class="container h-100">
    <div id="vue-app" class="grid mb-3">
        <section id="region-name">
            <div class="row my-3 m-md-0">
                <div class="col-8">
                    <h1>{{$region->name}}</h1>
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
        </section>

        <section id="region-most-played" class="box">
            <div class="row my-3 m-md-0">
                <div class="col-12">
                    <h2>Les plus populaires</h2>
                </div>
            </div>
            <quiz-list :quizzes="{{ $region->quizzes }}"></quiz-list>
        </section>


        <section id="region-scoreboard" class="box">
            <div class="row my-3 m-md-0">
                <div class="col-12">
                    <h2>Classement régional</h2>
                </div>
            </div>

            <table class="score-table">
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($mergedScores->sortByDesc('score')->take(10) as $score)
                        
                    <tr>
                        <td>{{$i}}</td>
                        <td><img src="{{$score->user->avatar}}" alt="{{$score->user->pseudo}}" class="rounded-circle"></td>
                        <td>
                            <a href="{{route('profile.show', [$score->user_id])}}"><b>{{$score->user->pseudo}}</b></a>
                            <small>{{$score->score}} pts</small>
                        </td>
                    </tr>
                    <?php $i ++; ?>
                    @endforeach
                </tbody>
            </table>

            <a href="{{route('region.scores', [$region->id])}}" class="btn btn-gradient">Afficher le classement complet</a>

        </section>
        <section id="region-recently-added" class="box mt-3 m-md-0">
            <div class="row my-3 m-md-0">
                <div class="col-12">
                    <h2>Tous les quizzes</h2>
                </div>
    
                @foreach ($region->quizzes as $quiz)
                    @if(sizeof($quiz->questions))
                    <div class="col-6"><!-- N'affiche que les quizzes avec question -->
    
                        <a href="{{route('game.info', [$quiz->id])}}" class="quiz quiz-2x">
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
                    </div>
                    @endif
                @endforeach
            </div>
        </section>
    </div>
    
</div>
@endsection

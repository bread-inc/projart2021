@extends('.layouts.app')

@section('content')

<div class="container my-5 m-md-0">
    <div id="vue-app" class="grid">
        <div class="row mb-3 mb-md-0" id="page-title">
            <div class="col-8">
                <h1>{{$quiz->title}}</h1>
                <small>Difficulté : {{$quiz->difficulty}}</small>
            </div>
        </div>
        
        <div class="row box m-md-0" id="quiz-image">
            <div class="col-12 my-2 imgQuizContainer">
                <img src="{{asset($quiz->questions->first()->picture)}}" class="rounded imgQuiz" alt="{{$quiz->title}}">
            </div>
            <div class="col-12">
                <p>{{$quiz->description}}</p>
            </div>

            <div class="col-12 text-center">
                <a href="{{route('game.start', [$quiz->id])}}" class="btn btn-gradient mb-2 d-block d-md-none">Démarrer</a>
                @if(auth()->user())
                    @if(!empty(auth()->user()->favorites->where('quiz_id', $quiz->id)->first()))
                    <!-- If the quiz is already a user's favorite -->
                    <form action="{{route('quiz.del-fav', [$quiz->id, auth()->id()])}}" method="post">
                        @csrf
                        <input type="submit" value="Retirer des favoris" class="btn btn-border mb-2">
                    </form>
                    @else
                    <form action="{{route('quiz.add-fav', [$quiz->id, auth()->id()])}}" method="post">
                        @csrf
                        <input type="submit" value="Ajouter aux favoris" class="btn btn-border mb-2">
                    </form>
                    @endif
                @else
                <small>Connectez-vous pour ajouter ce quiz à vos favoris</small>
                <a href="{{route('login')}}" class="btn btn-border mb-2">Se connecter</a>
                @endif
                <a href="{{url()->previous()}}">Retour</a>
            </div>
        </div>

        <div class="row m-md-0 box" id="region-scoreboard">
            <h3>Les meilleurs scores du quiz</h3>
            <table class="score-table">
                <tbody>
                    <?php $i = 1; ?>
                    @foreach ($quiz->scores->sortByDesc('score')->take(10) as $score)
                    
                    @if(auth()->check() && $score->user_id == auth()->id())
                    <tr class="my-score">
                    @else
                    <tr>
                    @endif
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
        </div>
    </div>
</div>
@endsection

@extends('.layouts.app')

@section('content')

@include('public.components.menu')

<div class="container">
    <div id="vue-app">
        <div class="row my-3">
            <div class="col-8">
                <h1>{{$region->name}}</h1>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12">
                <h2>Les plus populaires</h2>
            </div>
        </div>
        <quiz-list :quizzes="{{ $region->quizzes }}"></quiz-list>

        <div class="row my-3">
            <div class="col-12">
                <h2>Récemment ajoutés</h2>
            </div>
        </div>
        <quiz-list :quizzes="{{ $region->quizzes }}"></quiz-list>

        <div class="row my-3">
            <div class="col-12">
                <h2>Classement régional</h2>
            </div>
        </div>

        <a href="{{route('region.scores', [$region->id])}}" class="btn btn-gradient">Afficher le classement</a>

        <div class="row my-3">
            <div class="col-12">
                <h2>Tous les quizzes</h2>
            </div>

            @foreach ($region->quizzes as $quiz)
                @if(sizeof($quiz->questions))
                <div class="col-6"><!-- N'affiche que les quizzes avec question -->

                    <a href="{{route('game.info', [$quiz->id])}}" class="quiz quiz-2x">
                        <div class="quiz-thumb"  style="background-image: url('{{asset("storage" . $quiz->questions->first()["picture"])}};">
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
    </div>
</div>
@endsection

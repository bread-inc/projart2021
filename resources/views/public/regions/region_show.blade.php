@extends('.layouts.app')

@section('content')

@include('public.components.menu')

<div class="container">
    <div id="vue-app">
        <div class="row mb-3">
            <div class="col-8">
                <h1>{{$region->name}}</h1>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <h2>Les plus populaires</h2>
            </div>
        </div>
        <quiz-list :quizzes="{{ $region->quizzes }}"></quiz-list>

        <div class="row mb-3">
            <div class="col-12">
                <h2>Récemment ajoutés</h2>
            </div>
        </div>
        <quiz-list :quizzes="{{ $region->quizzes }}"></quiz-list>

        <div class="row mb-3">
            <div class="col-12">
                <h2>Classement régional</h2>
            </div>
        </div>

        <a href="{{route('region.scores', [$region->id])}}" class="btn btn-gradient">Afficher le classement</a>

        <div class="row mb-3">
            <div class="col-12">
                <h2>Tous les quizzes</h2>
            </div>

            @foreach ($region->quizzes as $quiz)
            <div class="col-6">
                <a href="{{route('game.info', [$quiz->id])}}" class="quiz quiz-2x">
                    <div class="quiz-thumb" style="background-image: url('');">
                        <h5>{{$quiz->title}}</h5>
                    </div>
                    <div class="label">
                        <small>{{$quiz->ponderation}}</small>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

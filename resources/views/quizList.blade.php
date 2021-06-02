@extends('.layouts.app')
<h1>QuizLits</h1>
@section('content')

<div class="container">
    <div id="vue-app">
        <quiz-list :quizzes="{{ $region->quizzes }}"></quiz-list>
    </div>
</div>


{{-- @foreach ($region->quizzes as $quizze)
<div class="d-flex flex-column">
    <a href="/quizz/{{$quizze->id}}/start" class="btn btn-light" >{{$quizze->title}}</a>
    <label>{{$quizze->description}}</label>
    <img class="p2" src="" alt="">
</div>

@endforeach --}}
<div class="d-flex flex-column">classement général<div>
<div class="d-flex flex-column" id ="popularQuiz">Les plus populaire</div>
<div class="d-flex flex-column" id ="recentQuiz">Récemment ajouté</div>
@endsection

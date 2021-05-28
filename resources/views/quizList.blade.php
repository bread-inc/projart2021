@extends('.layouts.app')
<h1>QuizLits</h1>
@section('content')
@foreach ($region->quizzes as $quizze)
<div class="d-flex flex-column">
    <a href="/quizz/{{$quizze->id}}/start" class="btn btn-light" >{{$quizze->title}}</a>
    <label>{{$quizze->description}}</label>
    <img class="p2" src="" alt="">
</div>
@endforeach
@endsection

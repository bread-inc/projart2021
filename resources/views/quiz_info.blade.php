@extends('.layouts.app')
<h1>QuizStart</h1>
@section('content')
<div class = "quizStart">
<div class="d-flex flex-column">
    <h2>{{$quiz->title}}</h2>
    <label>{{$quiz->description}}</label>
    <a href="{{route('game.start', [$quiz->id])}}" class="btn btn-primary">Démarrer</a>
    <a href="{{url()->previous()}}" class="btn btn-secondary">retour</a>
</div>
</div>
@endsection

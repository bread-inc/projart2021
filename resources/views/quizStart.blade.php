@extends('.layouts.app')
<h1>QuizStart</h1>
@section('content')
<div class = "quizStart">
<div class="d-flex flex-column">
    <h2>{{$quiz->title}}</h2>
    <label>{{$quiz->description}}</label>
    <a href="/quizz/{{$quiz->id}}/game" class="btn btn-primary">Démmarer</a>
    <a href="/region/{{$quiz->region_id}}" class="btn btn-secondary">retour</a>
</div>
</div>
@endsection

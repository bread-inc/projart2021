@extends('.layouts.app')
@section('content')
<p>{{$quiz->title}}</p>


<div class = "question">
    @foreach ($quiz->questions as $question )
    <p>Question : {{$question->description}}</p>
@endforeach
</div>
<div class = "menu">
    <div class="d-flex justify-content-center">
        <!--<a href="/game_success" class="btn btn-success">Valider </a>-->
        <a href="{{route('game.completed', $quiz->id)}}" class="btn btn-success">Valider </a>
        <a href="/game_clue" class="btn btn-info">Indice</a>
    </div>
</div>
 <div id="vue-app">
    <testleaf :cordone = "{{$cordone}}">
    </testleaf>
</div>
@endsection




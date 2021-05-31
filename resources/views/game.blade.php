@extends('.layouts.app')
@section('content')
<h1>Game</h1>
<div class = "question">
@foreach ($question as $questions )
<label>{{$questions->description}}</label>
@endforeach
</div>
<div class = "menu">
    <div class="d-flex justify-content-center">
        <a href="/game_success" class="btn btn-success">Valider </a>
        <a href="/game_clue" class="btn btn-info">Indice</a>
    </div>
</div>
@endsection

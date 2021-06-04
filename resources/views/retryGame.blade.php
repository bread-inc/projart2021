@extends('.layouts.app')

@section('content')
<h1>Oops</h1>

<p>Dommage vous n'êtes pas ecore au bon endroit</p>

<p>Mais ne vous découragez pas !</p>
<a href="/quizz/{{$quiz->id}}/game" class="btn btn-primary">Retour au quiz</a>
@endsection

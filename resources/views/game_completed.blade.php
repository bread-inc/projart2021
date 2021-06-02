@extends('.layouts.app')

@section('content')
<h1>Fin du jeu</h1>

<h3>Vous avez terminé le quiz <b>{{$quiz->title}}</b></h3>

<h2>Votre score : {{$score}}%</h2>
<p>Quiz réalisé en {{App\Http\Controllers\GameController::renderTime($time)}}.</p>



<a href="/home">Retour au menu</a>
@endsection

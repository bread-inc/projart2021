@extends('.layouts.app')

@section('content')
<h1>Fin du jeu</h1>

<h3>Vous avez terminé le quiz <b>{{$quiz->title}}</b></h3>

<h2>Votre score : {{$score}}%</h2>
<p>Quiz réalisé en {{App\Http\Controllers\GameController::renderTime($time)}}.</p>

<h2>Vos nouveaux badges</h2>
@if(!empty($newBadges))
<ul>
    @foreach ($newBadges as $badge)
        <li>{{$badge->id}} - {{$badge->label}}</li>
    @endforeach
</ul>
@else
<p>Vous n'avez pas débloqué de nouveau badge.</p>
@endif



<a href="/home">Retour au menu</a>
@endsection

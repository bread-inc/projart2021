@extends('.layouts.app')

@section('content')

<div class="container">
    <div id="vue-app">
        <div class="row mt-5 mb-3">
            <div class="col-8">
                <h1>{{$quiz->title}}</h1>
                <small>Difficulté : {{$quiz->difficulty}}</small>
            </div>
            <div class="col-12 my-2">
                <img src="{{asset("storage" . $quiz->questions->first()->picture)}}" class="rounded" alt="{{$quiz->title}}">
            </div>
            <div class="col-12">
                <p>{{$quiz->description}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="score-table">
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($quiz->scores->sortByDesc('score') as $score)
                        <tr>
                            <td>{{$i}}</td>
                            <td><img src="{{$score->user->avatar}}" alt="{{$score->user->pseudo}}" class="rounded-circle"></td>
                            <td>
                                <a href="{{route('profile.show', [$score->user_id])}}"><b>{{$score->user->pseudo}}</b></a>
                                <small>{{$score->score}} pts</small>
                            </td>
                        </tr>
                        <?php $i ++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center">
                <a href="{{route('game.start', [$quiz->id])}}" class="btn btn-gradient mb-2">Démarrer</a>
                <a href="{{url()->previous()}}">Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection

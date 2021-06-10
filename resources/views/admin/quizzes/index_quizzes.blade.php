@extends('.admin.template')

@section('content')

<h1>Tous les quizzes</b></h1>

<a class="btn btn-primary float-left" href="{{route('quiz.create')}}">Nouveau quiz</a>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Quiz</th>
            <th>Région</th>
            <th>Créateur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
@foreach($quizzes as $quiz)
        <tr>
            <td>{{$quiz->id}}</td>
            <td><b>{{$quiz->title}}</b></td>
            <td><a href="#" target="_blank">{{$quiz->region->name}}</a></td>
            <td><a href="{{route('user.show', [$quiz->user->id])}}" target="_blank">{{$quiz->user->pseudo}}</a></td>

            <td>
                <a class="btn btn-primary" href="{{route('quiz.show', [$quiz->id])}}">Afficher</a>
                <a class="btn btn-warning" href="{{route('quiz.edit', [$quiz->id])}}">Modifier</a>
                <form class="d-inline" method="POST" action="{{route('quiz.destroy', [$quiz->id])}}" accept-charset="UTF-8">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger" onclick="return confirm('Supprimer ce quiz entrainera la suppression de ses {{sizeof($quiz->questions)}} questions et indices liés. Voulez-vous procéder à sa suppression ?')" type="submit" value="Supprimer">
                </form>
            </td>
        </tr>
@endforeach
    </tbody>
</table>

@endsection
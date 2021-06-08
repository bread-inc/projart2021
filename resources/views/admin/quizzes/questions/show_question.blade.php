@extends('.admin.template')
@section('content')

<a href="{{ url()->previous() }}" class="btn btn-secondary" >Retour</a>
<a class="btn btn-warning" href="{{route('question.edit', [$question->quiz_id, $question->id])}}">Modifier</a>

<h1>Question {{$question->id}}, Quiz {{$question->quiz_id}}</h1>

<div class="form-group">
    <label for="picture">Image</label><br>
    <img src="{{asset($question->picture)}}" alt="{{$question->description}}">
</div>

<div class="form-group">
    <label for="description">Question</label><br>
    <textarea class="form-control" id="description" disabled>{{$question->description}}</textarea>
</div>

<div class="form-group">
    <div id="map">### CARTE ###</div>

    <br><label for="coord_x">Coordonnée X</label>
    <input class="form-control" name="coord_x" type="text" value="{{$question->coord_x}}" disabled>

    <br><label for="coord_y">Coordonnée Y</label>
    <input class="form-control" name="coord_y" type="text" value="{{$question->coord_y}}" disabled>
</div>

<hr>

<h3>Les indices de la question</h3>

<a class="btn btn-primary" href="{{route('clue.create', [$question->quiz_id, $question->id])}}">Nouvel indice</a>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Indice</th>
            <th>Rayon</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
@foreach ($question->clues as $clue)
        <tr>
            <td>{{$clue->id}}</td>
            <td>{{$clue->description}}</td>
            <td>{{$clue->radius}} [m]</td>
            <td>
                <a class="btn btn-warning" href="{{route('clue.edit', [$question->quiz_id, $question->id, $clue->id])}}">Edit</a>
                <form class="d-inline" method="POST" action="{{route('clue.destroy', [$question->quiz_id, $question->id, $clue->id])}}" accept-charset="UTF-8">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger" onclick="return confirm('Vraiment supprimer cet indice ?')" type="submit" value="Supprimer">
                </form>
            </td>
        </tr>
@endforeach
    </tbody>
</table>

@endsection
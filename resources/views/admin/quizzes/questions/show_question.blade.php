@extends('.admin.template')
@section('content')

<a href="{{ url()->previous() }}" class="btn btn-secondary" >Retour</a>
<a class="btn btn-warning" href="">Edit</a>

<h1>Question {{$question->id}}, Quiz {{$question->quiz_id}}</h1>

<div class="form-group">
    <label for="picture">Image</label><br>
    <input type="file" id="picture" name="picture" accept="image/png, image/jpeg">
    
    {!! $errors->first('picture', '<small class="help-block">:message</small>') !!}
</div>

<div class="form-group">
    <label for="description">Question</label><br>
    <textarea class="form-control" id="description" disabled>{{$question->description}}</textarea>
    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
</div>

<div class="form-group">
    <div id="map">### CARTE ###</div>

    <br><label for="coord_x">Coordonnée X</label>
    <input class="form-control" name="coord_x" type="text" value="{{$question->coord_x}}" disabled>
    {!! $errors->first('coord_x', '<small class="help-block">:message</small>') !!}

    <br><label for="coord_y">Coordonnée Y</label>
    <input class="form-control" name="coord_y" type="text" value="{{$question->coord_y}}" disabled>
    {!! $errors->first('coord_y', '<small class="help-block">:message</small>') !!}
</div>

<hr>

<h3>Les indices de la question</h3>

<a class="btn btn-primary" href="#">Nouvel indice</a>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Indice</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
@foreach ($question->clues as $clue)
        <tr>
            <td>{{$clue->id}}</td>
            <td>{{$clue->description}}</td>
            <td>
                <a href="{{ "#"/*route('clue.show',[$quiz->id,$question->id, $clue->id]) */}}" class="btn btn-primary">Show</a> 
                <a href="#">Edit</a> 
                <a href="#">Delete</a>
            </td>
        </tr>
@endforeach
    </tbody>
</table>

@endsection
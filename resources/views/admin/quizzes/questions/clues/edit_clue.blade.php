@extends('.admin.template')

@section('content')
<h1>Modifier l'indice {{$clue->id}}</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>

<form method="POST" action="{{route('clue.update', [$quiz_id, $question_id, $clue->id])}}" accept-charset="UTF-8">
    @csrf
    @method('PUT')

    <input type="hidden" name="id" value="{{$clue->id}}">

    <small>À voir comment mettre en page, si on laisse ces selecteurs, 
        ou si on met juste dans le titre, p.e., les id du quiz et de la question</small>

    <div class="form-group">
        <label for="question_id">Question</label>
        <select name="question_id" id="question_id" class="form-control" disabled>
            <option value="{{$question_id}}" selected>{{$question_id}}</option>
        </select>
        <input type="hidden" name="question_id" value="{{$question_id}}">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description">{{$clue->description}}</textarea>
        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="radius">Rayon</label>
        <input class="form-control" name="radius" type="range" min="30" max="3000" step="10" value="{{$clue->radius}}">
        {!! $errors->first('radius', '<small class="help-block">:message</small>') !!}

        <small>Peut-être afficher en JS la valeur du slider ?</small>
    </div>

    <input type="submit" value="Modifier" class="btn btn-primary">
</form>

@endsection
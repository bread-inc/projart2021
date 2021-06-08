@extends('.admin.template')

@section('content')

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>


<h1>{{$quiz->title}}</h1>

<form action="{{route('quiz.update', [$quiz->id])}}" method="post">
    @csrf
    @method("PUT")

    <div class="form-group">
        <label for="title">Titre du quiz</label><br>
        <input type="text" name="title" value="{{$quiz->title}}" class="form-control">
        {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="description">Description</label><br>
        <textarea id="description" name="description" class="form-control">{{$quiz->description}}</textarea>
        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
    </div> 

    <div class="form-group">
        <label for="region">Région</label><br>
        <select name="region_id" class="form-control">
            @foreach ($regions as $region)
                <option {{$region->id == $quiz->region->id ? "selected" : ""}} value="{{$region->id}}">
                    {{$region->id}} - {{$region->name}}
                </option>
            @endforeach
        </select>
        {!! $errors->first('region_id', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="difficulty">Difficulté</label><br>
        <input type="number" name="difficulty" value="{{$quiz->difficulty}}" class="form-control">
        {!! $errors->first('difficulty', '<small class="help-block">:message</small>') !!}
    </div>

    <input type="submit" value="Enregistrer les modifications" class="btn btn-primary">
</form>
@endsection
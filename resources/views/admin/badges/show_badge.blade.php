@extends('.admin.template')

@section('content')
<h1>{{$badge->label}}</h1>


<pre>{{$badge}}</pre>

<form method="POST" action="{{route('badge.update', [$badge->id])}}" accept-charset="UTF-8">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="label">Nom du badge</label>
        <input class="form-control" placeholder="Label" name="label" type="text" value="{{$badge->label}}">
        {!! $errors->first('label', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <input class="form-control" placeholder="Description" name="description" type="text" value="{{$badge->description}}">
        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="pictogram">Pictogramme</label>
        {!! $errors->first('pictogram', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="color">Couleur</label>
        <input class="form-control" name="color" type="color" value="{{$badge->color}}">
        {!! $errors->first('color', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="color">Type de badge</label>

        <input type="radio" id="type_score" name="type" value="score" checked>
        <label for="type_score">Score</label>
        
        <input type="radio" id="type_time" name="type" value="time">
        <label for="type_time">Temps</label>

        <input type="radio" id="type_region" name="type" value="region">
        <label for="type_region">Régional</label>

        {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
    </div>

</form>

@endsection
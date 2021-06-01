@extends('.admin.template')

@section('content')
<h1>Nouveau badge</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>

<form method="POST" action="{{route('badge.update', [$badge->id])}}" accept-charset="UTF-8">
    @csrf
    @method("PUT")

    <div class="form-group">
        <label for="label">Nom du badge</label>
        <input class="form-control" name="label" type="text" value="{{$badge->label}}">
        {!! $errors->first('label', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <input class="form-control" name="description" type="text" value="{{$badge->description}}">
        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="pictogram">Pictogramme du badge</label><br>

        @foreach ($pictograms_list as $pictogram)
            <input type="radio" id="{{$pictogram}}" name="pictogram" value="{{$pictogram}}" {{$pictogram == $badge->pictogram ? "checked" : ""}}>
            <label for="{{$pictogram}}"><i class="fas {{$pictogram}}"></i></label><br>
        @endforeach
        {!! $errors->first('pictogram', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="color">Couleur</label>
        <input class="form-control" name="color" type="color" value="{{$badge->color}}">
        {!! $errors->first('color', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="color">Type de badge</label><br>

        <input type="radio" id="type_score" name="type" value="score" {{$badge->type == "score" ? "checked" : ""}}>
        <label for="type_score">Score</label><br>
        
        <input type="radio" id="type_time" name="type" value="time" {{$badge->type == "time" ? "checked" : ""}}>
        <label for="type_time">Temps</label><br>

        <input type="radio" id="type_region" name="type" value="region" {{$badge->type == "region" ? "checked" : ""}}>
        <label for="type_region">Régional</label>
        {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
    </div>

    <h1>Améliorer en front end la sélection de critère, et ajouter le quiz/la région lié.e au badge !</h1>

    <div class="form-group">
        <label for="label">Critère de réussite</label>
        <small>À mettre en place avec le front-end</small>
        <input class="form-control" name="criterium" type="text" value="{{$badge->criterium}}">
        {!! $errors->first('criterium   ', '<small class="help-block">:message</small>') !!}
    </div>

    <input type="submit" value="Enregistrer" class="btn btn-primary">
</form>

@endsection
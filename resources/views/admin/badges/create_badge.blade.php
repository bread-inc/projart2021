@extends('.admin.template')

@section('content')
<h1>Nouveau badge</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>

<form method="POST" action="{{route('badge.store')}}" accept-charset="UTF-8">
    @csrf

    <div class="form-group">
        <label for="label">Nom du badge</label>
        <input class="form-control" placeholder="Label" name="label" type="text">
        {!! $errors->first('label', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <input class="form-control" placeholder="Description" name="description" type="text">
        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="pictogram">Pictogramme du badge</label><br>

        @foreach ($badge_list as $badge)
            <input type="radio" id="{{$badge}}" name="pictogram" value="{{$badge}}">
            <label for="{{$badge}}"><i class="fas {{$badge}}"></i></label><br>
        @endforeach

        {!! $errors->first('pictogram', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="color">Couleur</label>
        <input class="form-control" name="color" type="color">
        {!! $errors->first('color', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="color">Type de badge</label><br>

        <input type="radio" id="type_score" name="type" value="score" checked>
        <label for="type_score">Score</label><br>
        
        <input type="radio" id="type_time" name="type" value="time">
        <label for="type_time">Temps</label><br>

        <input type="radio" id="type_region" name="type" value="region">
        <label for="type_region">Régional</label>

        {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
    </div>

    <h1>Améliorer en front end la sélection de critère, et ajouter le quiz/la région lié.e au badge !</h1>

    <div class="form-group">
        <label for="label">Critère de réussite</label>
        <input class="form-control" name="criterium" type="number">
        {!! $errors->first('criterium   ', '<small class="help-block">:message</small>') !!}
    </div>

    <input type="submit" value="Enregistrer">
</form>

@endsection
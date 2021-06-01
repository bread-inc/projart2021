@extends('.admin.template')

@section('content')
<h1>{{$badge->label}}</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
<a href="{{ route('badge.edit', [$badge->id]) }}" class="btn btn-warning">Modifier</a>

<div>
    <div class="form-group">
        <label for="label">Nom du badge</label>
        <input class="form-control" placeholder="Label" name="label" type="text" value="{{$badge->label}}" disabled>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <input class="form-control" placeholder="Description" name="description" type="text" value="{{$badge->description}}" disabled>
    </div>

    <div class="form-group">
        <label for="pictogram">Pictogramme du badge</label><br>

        @foreach ($pictograms_list as $pictogram)
            <input type="radio" id="{{$pictogram}}" name="pictogram" value="{{$pictogram}}" {{$pictogram == $badge->pictogram ? "checked" : ""}} disabled>
            <label for="{{$pictogram}}"><i class="fas {{$pictogram}}"></i></label><br>
        @endforeach
    </div>

    <div class="form-group">
        <label for="color">Couleur</label>
        <input class="form-control" name="color" type="color" value="{{$badge->color}}" disabled>
    </div>

    <div class="form-group">
        <label for="color">Type de badge</label>

        <input type="radio" id="type_score" name="type" value="score" checked disabled>
        <label for="type_score">Score</label>
        
        <input type="radio" id="type_time" name="type" value="time" disabled>
        <label for="type_time">Temps</label>

        <input type="radio" id="type_region" name="type" value="region" disabled>
        <label for="type_region">Régional</label>
    </div>
</div>

@endsection
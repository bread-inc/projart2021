@extends('.admin.template')
@section('content')

<a href="{{ url()->previous() }}" class="btn btn-secondary" >Retour</a>

<h1>Créer une nouvelle question pour le quiz {{$quiz_id}}</h1>

<form action="{{route('question.store', [$quiz_id])}}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
    @csrf

    <input type="hidden" name="quiz_id" value="{{$quiz_id}}">

    <div class="form-group">
        <label for="picture">Image</label><br>

        <input type="file" id="picture" name="picture" accept="image/png, image/jpeg">
        
        {!! $errors->first('picture', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="description">Question</label><br>
        <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <div id="map">### CARTE ###</div>

        <br><label for="coord_x">Coordonnée X</label>
        <input class="form-control" name="coord_x" type="text" value="{{old('coord_x')}}">
        {!! $errors->first('coord_x', '<small class="help-block">:message</small>') !!}

        <br><label for="coord_y">Coordonnée Y</label>
        <input class="form-control" name="coord_y" type="text" value="{{old('coord_y')}}">
        {!! $errors->first('coord_y', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="radius">Rayon</label>
        <input class="form-control" name="radius" type="range" min="30" max="3000" step="10" value="{{old('radius')}}">
        {!! $errors->first('radius', '<small class="help-block">:message</small>') !!}

        <small>Peut-être afficher en JS la valeur du slider ?</small>
    </div>

    <input type="submit" value="Créer" class="btn btn-primary">
</form>
@endsection
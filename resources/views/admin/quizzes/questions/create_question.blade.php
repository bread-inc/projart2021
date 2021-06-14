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
        <label for="end_text">Texte de fin</label><br>
        <textarea class="form-control" id="end_text" name="end_text">{{old('end_text')}}</textarea>
        {!! $errors->first('end_text', '<small class="help-block">:message</small>') !!}
    </div>

    <div id="vue-app">
        <admin-map></admin-map>
    </div>

</form>


@endsection

@extends('.admin.template')
@section('content')

<a href="{{ url()->previous() }}" class="btn btn-secondary" >Retour</a>

<h1>Modifier la question {{$question->id}}</h1>

<form action="{{route('question.update', [$question->quiz_id, $question->id])}}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
    @csrf
    @method("PUT")

    <div class="form-group">
        <label for="picture">Image</label><br>
        <img src="{{asset($question->picture)}}" alt="{{$question->description}}">

        <input type="file" id="picture" name="picture" accept="image/png, image/jpeg">

        {!! $errors->first('picture', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="description">Question</label><br>
        <textarea class="form-control" id="description" name="description">{{$question->description}}</textarea>
        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="end_text">Texte de fin</label><br>
        <textarea class="form-control" id="end_text" name="end_text">{{$question->end_text}}</textarea>
        {!! $errors->first('end_text', '<small class="help-block">:message</small>') !!}
    </div>

    <div id="vue-app">
        <edit-admin-map :data="{{ $question }}" ></edit-admin-map>
    </div>
</form>

<script>


</script>
@endsection

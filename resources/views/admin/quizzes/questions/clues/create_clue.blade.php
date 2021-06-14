@extends('.admin.template')

@section('content')
<h1>Nouvel indice</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>

<form method="POST" action="{{route('clue.store', [$quiz_id, $question_id])}}" accept-charset="UTF-8">
    @csrf

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
        <textarea class="form-control" name="description">{{old('description')}}</textarea>
        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
    </div>

    <div id="vue-app">
        <clue-map :data="{{ $question }}"> </clue-map>
    </div>
</form>

@endsection

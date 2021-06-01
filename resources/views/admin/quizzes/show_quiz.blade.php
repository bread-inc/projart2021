@extends('.admin.template')

@section('content')

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
<a class="btn btn-warning" href="">Modifier</a>

<h1>{{$quiz->title}}</h1>

<div class="form-group">
    <label for="desc">Description</label><br>
    <textarea id="desc" class="form-control" disabled>{{$quiz->description}}</textarea>
</div> 

<div class="form-group">
    <label for="region">Région</label><br>
    <select name="region" class="form-control" disabled>
        <option selected>{{$quiz->region->id}} - {{$quiz->region->name}}</option>
    </select>
</div>

<div class="form-group">
    <label for="ponderation">Pondération</label><br>
    <input type="number" value="{{$quiz->ponderation}}" class="form-control" disabled>
</div>

<hr>

<h3>Les questions du quiz</h3>

<a class="btn btn-primary" href="{{route('question.create', [$quiz->id])}}">Nouvelle question</a>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Question</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
@foreach ($quiz->questions as $question)
        <tr>
            <td>{{$question->id}}</td>
            <td>{{$question->description}}</td>
            <td>
                <a href="{{route('question.show',[$quiz->id,$question->id])}}" class="btn btn-primary">Show</a> 
                <a class="btn btn-warning" href="{{route('question.edit', [$quiz->id, $question->id])}}">Modifier</a>
                <a href="#">Delete</a>
            </td>
        </tr>
@endforeach
    </tbody>
</table>

<hr>
<h3>Les badges du quiz</h3>

<a class="btn btn-primary" href="{{route('badge.index')}}">Modifier les badges</a>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Badge</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
@foreach ($quiz->badges as $badge)
        <tr>
            <td><a href="{{route('badge.show', [$badge->id])}}" target="_blank">{{$badge->id}}</a></td>
            <td><i class="fas {{$badge->pictogram}}"></i> {{$badge->label}}</td>
            <td>{{$badge->description}}</td>
        </tr>
@endforeach
    </tbody>
</table>

@endsection
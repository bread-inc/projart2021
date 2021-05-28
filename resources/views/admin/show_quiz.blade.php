@extends('.layouts.app')
<h1>Show quiz static page</h1>

@section('content')

<a href="{{ url()->previous() }}" class="btn btn-secondary" >Retour</a>
<a class="btn btn-warning" href="">Edit</a>

<h1>{{$quiz->title}}</h1>

<div>
    <label for="desc">Description</label><br>
    <textarea id="desc" disabled>{{$quiz->description}}</textarea>
</div> 

<div>
    <label for="region">Région</label><br>
    <select name="region" disabled>
        <option selected>{{$quiz->region->id}} - {{$quiz->region->name}}</option>
    </select>
</div>

<div>
    <label for="ponderation">Pondération</label><br>
    <input type="number" value="{{$quiz->ponderation}}" disabled>
</div>

<h3>Questions</h3>

<a class="btn btn-primary" href="#">New question</a>

<table>
    <tr>
        <th>#</th>
        <th>Description</th>
    </tr>
@foreach ($quiz->questions as $question)
    <tr>
        <td>{{$question->id}}</td>
        <td>{{$question->description}}</td>
        <td><a href="#">Edit button</a></td>
        <td><a href="#">Delete button</a></td>
    </tr>
@endforeach
</table>

<hr>
<h3>Badges</h3>

<a class="btn btn-primary" href="#">New badge</a>

<table>
    <tr>
        <th>#</th>
        <th>Description</th>
    </tr>
@foreach ($quiz->badges as $badge)
    <tr>
        <td>{{$badge->label}}</td>
        <td>{{$badge->description}}</td>
        <td>{{$badge->pictogram}}</td>
        <td>{{$badge->color}}</td>
        <td><a href="#">Edit button</a></td>
        <td><a href="#">Delete button</a></td>
    </tr>
@endforeach
</table>

@endsection
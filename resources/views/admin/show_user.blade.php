@extends('.layouts.app')
<h1>Show User static page</h1>

@section('content')

<h1>{{$user->pseudo}}</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary" >Retour</a>

<a class="btn btn-warning" href="#">Edit</a>

@if($user->isAdmin)
<div>
    <span class="badge badge-danger">ADMIN</span>
</div>
@endif

<div>
    <label>Pseudo</label>
    <input value="{{$user->pseudo}}" disabled>
</div>

<div>
    <label>E-mail</label>
    <input value="{{$user->email}}" disabled>
</div>

<h3>Scores</h3>

<a class="btn btn-primary" href="#">New question</a>

<table>
    <tr>
        <th>#</th>
        <th>Score</th>
    </tr>
@foreach ($user->scores as $question)
    <tr>
        <td>{{$question->quiz_id}}</td>
        <td>{{$question->score}}</td>
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
@foreach ($user->badges as $badge)
    <tr>
        <td>{{$badge->label}}</td>
        <td>{{$badge->description}}</td>
        <td>{{$badge->pictogram}}</td>
        <td>{{$badge->color}}</td>
        <td><a href="#">Delete button</a></td>
    </tr>
@endforeach
</table>

@endsection
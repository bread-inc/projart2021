@extends('.admin.template')

@section('content')
<h1>{{$user->pseudo}}</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary" >Retour</a>

<a class="btn btn-warning" href="{{route('user.edit', [$user->id])}}">Edit</a>

<div>
    <label>Avatar</label>
    <img src="{{$user->avatar}}">
    
    <div class="form-group">
        <div class="col-sm-6 ml-4">
            @if($user->isAdmin)
                <input name="isAdmin" id="isAdmin" class="form-check-input" value="1" type="checkbox" checked disabled>
            @else
                <input name="isAdmin" id="isAdmin" class="form-check-input" value="1" type="checkbox" disabled>
            @endif
            <label for="isAdmin" class="form-check-label">Administrateur</label><br/>
        </div>
    </div>

    <div class="form-group">
        <label for="label">Pseudo</label>
        <input class="form-control" placeholder="Label" name="label" type="text" value="{{$user->pseudo}}" disabled>
        {!! $errors->first('label', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="description">E-mail</label>
        <input class="form-control" placeholder="Description" name="description" type="text" value="{{$user->email}}" disabled>
        {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
    </div>
</div>

<h3>Les scores de {{$user->pseudo}}</h3>

@if(sizeof($user->scores) != 0)

<table class="table">
    <thead>
        <tr>
            <th>Quiz</th>
            <th>Score</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
@foreach ($user->scores as $score)
        <tr>
            <td><a href="{{route('quiz.show', [$score->quiz_id])}}">{{$score->quiz_id}}</a></td>
            <td>{{$score->score}}</td>
            <td>
                <form class="d-inline" method="POST" action="{{$user->id}}/score/{{$score->id}}" accept-charset="UTF-8">
                    @csrf
                    <input class="btn btn-danger" onclick="return confirm('Vraiment retirer le score de cet utilisateur ?')" type="submit" value="Supprimer">
                </form>
            </td>
        </tr>
@endforeach
    </tbody>
</table>

@else
L'utilisateur n'a pas encore de score.
@endif

<hr>
<h3>Les badges de {{$user->pseudo}}</h3>

<a class="btn btn-primary" href="{{route('user.addBadges', [$user->id])}}">Attribuer un nouveau badge</a>

@if(sizeof($user->badges) != 0)
<div class="row">
@foreach ($user->badges as $badge)
    <div class="col-12 col-sm-4 col-md-3 mb-2">
        <div class="card" style="background-color: {{$badge->color}};">
            <div class="card-body">
                <img src="{{$badge->pictogram}}" class="float-left rounded-circle" alt="{{$badge->label}}">
                <h5 class="card-title">{{$badge->label}}</h5>
                <p class="card-text">{{$badge->description}}</p>

                <form class="d-inline" method="POST" action="{{$user->id}}/badge/{{$badge->id}}" accept-charset="UTF-8">
                    @csrf
                    <input class="btn btn-danger" onclick="return confirm('Vraiment retirer le badge de cet utilisateur ?')" type="submit" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>

@else
L'utilisateur n'a pas encore de badge.
@endif


@endsection
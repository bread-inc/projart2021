@extends('.admin.template')

@section('content')
<h1>Modifier {{$user->pseudo}}</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>

<form method="POST" action="{{route('user.update', [$user->id])}}" accept-charset="UTF-8">
    @csrf
    @method('PUT')

    <div class="form-group">
        <div class="col-sm-6 ml-4">
            @if($user->isAdmin)
                <input name="isAdmin" id="isAdmin" class="form-check-input" value="1" type="checkbox" checked>
            @else
                <input name="isAdmin" id="isAdmin" class="form-check-input" value="1" type="checkbox">
            @endif
            <label for="isAdmin" class="form-check-label">Administrateur</label><br/>
        </div>
    </div>

    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input class="form-control" name="pseudo" type="text" value="{{$user->pseudo}}">
        {!! $errors->first('pseudo', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input class="form-control" name="email" type="email" value="{{$user->email}}">
        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
    </div>

    <input type="submit" value="Enregistrer" class="btn btn-primary">
</form>
@endsection
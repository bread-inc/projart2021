@extends('.admin.template')

@section('content')
<h1>Nouvel utilisateur</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>

<form method="POST" action="{{route('user.store')}}" accept-charset="UTF-8">
    @csrf

    <div class="form-group">
        <div class="col-sm-6 ml-4">
            <input name="isAdmin" id="isAdmin" class="form-check-input" value="1" type="checkbox">
            <label for="isAdmin" class="form-check-label">Administrateur</label><br/>
        </div>
    </div>

    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input class="form-control" placeholder="Pseudonyme" name="pseudo" type="text" value="{{old('pseudo')}}">
        {!! $errors->first('label', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="email">E-mail</label>
        <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{old('email')}}">
        {!! $errors->first('email', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input class="form-control" name="password" type="password">
        {!! $errors->first('password', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmation du mot de passe</label>
        <input class="form-control" name="password_confirmation" type="password">
        {!! $errors->first('password_confirmation', '<small class="help-block">:message</small>') !!}
    </div>

    <input type="submit" value="Enregistrer" class="btn btn-primary">
</form>
@endsection
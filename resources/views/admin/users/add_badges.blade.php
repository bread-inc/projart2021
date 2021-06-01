@extends('.admin.template')

@section('content')
<h1>Modifier les badges de l'utilisateur <b>{{$user->pseudo}}</b></h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>

<form method="POST" action="" accept-charset="UTF-8">
    @csrf

    <input type="hidden" name="user" value="{{$user->id}}">

    <div class="row">


    @foreach ($badges as $badge)
        <div class="col-12 col-sm-4 col-md-3 mb-2">
            <label for="{{$badge->id}}">
                <div class="card" style="background-color: {{$badge->color}};">
                    <div class="card-body">
                        <input type="checkbox"
                            class="btn-check float-right"
                            id="{{$badge->id}}"
                            name="badges[]"
                            value="{{$badge->id}}"
                            {{!empty($user->badges->find($badge->id)) ? "checked" : ""}}
                        >
                        <h5 class="card-title"><i class="fas {{$badge->pictogram}}"></i> {{$badge->label}}</h5>
                        <p class="card-text">{{$badge->description}}</p>
                    </div>
                </div>
            </label>
        </div>
    @endforeach

    </div>


    <input type="submit" value="Enregistrer" class="btn btn-primary">
</form>
@endsection
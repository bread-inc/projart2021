@extends('.admin.template')
@section('content')

<h1>Tous les utilisateurs</h1>

<a class="btn btn-primary float-left" href="{{route('user.create')}}">Nouvel utilisateur</a>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Rôle</th>
            <th></th>
            <th>Pseudonyme</th>
            <th>E-mail</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
@foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>
                @if($user->isAdmin)
                <span class="badge badge-danger">admin</span>
                @endif
            </td>
            <td><img src="{{$user->avatar}}"></td>
            <td>{{$user->pseudo}}</td>
            <td>{{$user->email}}</td>

            <td>
                <a class="btn btn-primary" href="{{route('user.show', [$user->id])}}">Afficher</a>
                <a class="btn btn-warning" href="{{route('user.edit', [$user->id])}}">Modifier</a>
                <form class="d-inline" method="POST" action="{{route('user.destroy', [$user->id])}}" accept-charset="UTF-8">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-danger" onclick="return confirm('Vraiment supprimer cet utilisateur ?')" type="submit" value="Supprimer">
                </form>
            </td>
        </tr>
@endforeach
    </tbody>
</table>

@endsection
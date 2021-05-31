@extends('.admin.template')
<h1>Index static page</h1>

@section('content')

<h1>Tous les badges</h1>

<a class="btn btn-primary" href="{{route('badge.create')}}">Nouveau badge</a>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Badge</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
@foreach($badges as $badge)
    <tr>
        <td>{{$badge->id}}</td>
        <td><i class="fas {{$badge->pictogram}} mr-1"></i> {{$badge->label}}</td>
        <td>{{$badge->description}}</td>

        <td>
            <a class="btn btn-primary" href="{{route('badge.show', [$badge->id])}}">Show</a>
            <a class="btn btn-warning" href="{{route('badge.edit', [$badge->id])}}">Edit</a>
            <form class="d-inline" method="POST" action="{{route('badge.destroy', [$badge->id])}}" accept-charset="UTF-8">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" onclick="return confirm('Vraiment supprimer ce badge ?')" type="submit" value="Supprimer">
            </form>
        </td>
    </tr>
@endforeach
    </tbody>
</table>

@endsection
@extends('.layouts.app')
<h1>Region</h1>
@section('content')

@foreach ($regions as $region )
<div class="d-flex flex-column">
    <a href="/region/{{$region->id}}" class="btn btn-light" >{{$region->name}}</a>
    <img class="p2" src="" alt="">
</div>

@endforeach
@endsection

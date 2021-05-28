@extends('.layouts.app')
<h1>Show static page</h1>

@section('content')

<h1>{{$title}}</h1>

<a href="{{ url()->previous() }}" class="btn btn-secondary" >Retour</a>

<a class="btn btn-warning" href="/admin/{{$elementType}}/{{$element->id}}/edit">Edit</a>

<pre>
    {{$element}}
</pre>

@endsection
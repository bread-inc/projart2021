@extends('.admin.template')
<h1>Index static page</h1>

@section('content')

<h1>{{$title}}</h1>

<table>
@foreach($elements as $element)
<tr>
   <a class="btn btn-primary" href="/admin/{{$elementType}}/{{$element->id}}">Show</a>
   <a class="btn btn-warning" href="/admin/{{$elementType}}/{{$element->id}}/edit">Edit</a>

    <pre>{{$element}}</pre><hr>
</tr>
@endforeach
</table>

@endsection
@extends('.layouts.app')
<h1>Index static page</h1>

@section('content')

<h1>{{$title}}</h1>

<a href="/admin/quiz" class="btn btn-secondary" >Quizzes</a>
<a href="/admin/badge" class="btn btn-secondary">Badges</a>
<a href="/admin/user" class="btn btn-secondary" >Users</a>

<div class="btn-group pull-right">
    <a href='/home' class='btn btn-primary'>Public dashboard</a>
</div>

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
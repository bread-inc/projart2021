@extends('.layouts.app')

@section('contenu')
@if(isset($info))
<div class='row alert alert-info'> {{$info}}</div>
@endif
<h1>DashboardUser</h1>
<button type="button" class="btn btn-primary">Profile</button>
<button type="button" class="btn btn-primary" onclick="window.location.href='/scoreboard'" type="button">Tab of score</button>
@endsection

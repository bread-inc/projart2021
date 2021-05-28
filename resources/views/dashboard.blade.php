@extends('.layouts.app')
<h1>DashboardUser</h1>
@section('content')
<a href="user/{{Auth::id()}}" class="btn btn-light" >Profile</a>
<a href="/globalRanking" class="btn btn-light">Global Ranking</a>
<a href="/region" class="btn btn-light">Region</a>
@if(Auth::check() and Auth::user()->isAdmin)
<div class="btn-group pull-right">
    <a href='admin' class='btn btn-warning'>dashboard Admin</a>
</div>
@else
@endif
@endsection



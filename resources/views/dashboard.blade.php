@extends('.layouts.app')
<h1>DashboardUser</h1>
@section('content')
<div class="menu">
    <div class="d-flex justify-content-center">
        <a href="user/{{Auth::id()}}" class="btn btn-light">Profile</a>
        <a href="/globalRanking" class="btn btn-light">Global Rankings</a>
        <a href="/region" class="btn btn-light">All Regions</a>
        @if(Auth::check() and Auth::user()->isAdmin)
        <a href='admin' class='btn btn-warning'>dashboard Admin</a>
        @endif
    </div>
</div>

@endsection

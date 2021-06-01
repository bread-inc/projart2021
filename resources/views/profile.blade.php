@extends('.layouts.app')

@section('content')

<div class="container">

    <div class="profile d-flex justify-content-center">
        <div class="d-flex flex-column">
            <h2 class="p2 text-center">Profile</h2>
            <img class="rounded-circle" src="{{ $user->avatar }}" alt="Avatar of {{ $user->pseudo }}">
            <h3 class="p2 text-center">{{ $user->pseudo }}</h3>
        </div>
    </div>

    <div id="vue-app">
        <badge-list :badges="{{ $user->badges }}"></badge-list>
    </div>


</div>

@endsection

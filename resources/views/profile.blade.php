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
        <div class="row">
            <div class="col-sm">
                <badge-list :badges="{{ $user->badges()->orderBy('created_at', 'DESC')->get() }}" :auth="{{ auth()->check() }}"></badge-list>
            </div>
            <div class="col-sm">
                <score-list :scores="{{ $scores }}"></score-list>
            </div>
        </div>
    </div>


</div>

@endsection

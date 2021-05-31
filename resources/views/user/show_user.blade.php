@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="profil">
            <div class="d-flex justify-content-center">
                <div class="d-flex flex-column">
                    <h2 class="p2">Profil</h2>
                    <img class="p2" src="" alt="">
                    <h3 class="p2">{{ $user->pseudo }}</h3>
                </div>
            </div>
            
            <div id="app">
                <tmpl-badge :badges="{{ $user->badges }}"></tmpl-badge>
            </div>
            
        </div>

    </div>
@endsection

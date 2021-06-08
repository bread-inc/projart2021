@extends('.layouts.app')
@section('content')
<div id="vue-app">
    <game-desktop-map :regions="{{ $regions }}"> </game-desktop-map>
</div>

@endsection

@extends('.layouts.app')

@section('content')

@include('public.components.menu')

<div class="container">
    <div class="row mt-5 mb-3">
        <div class="col-8">
            <h1>Toutes les régions</h1>
        </div>
    </div>
    <div id="vue-app">
        <region-list :regions="{{ $regions }}"></region-list>
    </div>
</div>

@endsection

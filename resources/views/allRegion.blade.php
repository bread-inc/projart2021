@extends('.layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-8">
            <h1>Toutes les régions</h1>
        </div>
    </div>
    <div id="vue-app">
        <region-list :regions="{{ $regions }}"></region-list>
    </div>
</div>

@endsection

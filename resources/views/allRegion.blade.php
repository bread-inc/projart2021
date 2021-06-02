@extends('.layouts.app')
<h1>Region</h1>
@section('content')
<div id="vue-app">
    <region-list :regions="{{ $regions }}"></region-list>
</div>
@endsection

@extends('.layouts.app')
@section('content')
<div class = "question">
</div>
<div class="container">
    <div id="vue-app">
        <game-container :data="{{ $data }}"></game-container>
    </div>
</div>

{{-- @endsection

<div id="vue-app">
    <testleaf :cordone = "{{ $cordone }}"></testleaf>
</div>
@endsection --}}

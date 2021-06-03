@extends('.layouts.app')
@section('content')
<div class = "question">
</div>
<div class="container">
    <div id="vue-app">
        <game-map :data="{{ $data }}"></game-map>
    </div>
</div>

@endsection

 <div id="vue-app">
    <testleaf :cordone = "{{ $cordone }}"></testleaf>
</div>
@endsection

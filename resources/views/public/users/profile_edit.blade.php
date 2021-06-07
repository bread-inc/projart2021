@extends('.layouts.app')

@section('content')

@include('public.components.menu')

<pre>{{$user}}</pre>

<div class="container">
    <div class="row mb-3">
        <div class="col-8">
            <h1>Réglages</h1>
        </div>
    </div>

    {{$user->pseudo}}

    
</div>

@endsection
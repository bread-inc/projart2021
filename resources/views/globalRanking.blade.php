@extends('.layouts.app')
<h1>GlobalRanking</h1>
@section('content')
@php
    $index = 0;
@endphp
<h2>Score general</h2>
@foreach($arrayScores as $score)
@foreach($score as $scores)
@php
    $index ++;
@endphp
    <div class="GeneralRanking">
    <label>{{$index}}</label>
    <label>{{$scores->user['pseudo']}}</label>
    <label>{{$scores->score}}</label>
    </div>
@endforeach
@endforeach
@endsection

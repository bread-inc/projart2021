@extends('.layouts.app')
<h1>GlobalRanking</h1>
@section('content')
@php
    $index = 0;
@endphp
@foreach($arrayScores as $score)
@foreach($score as $scores)
@php
    $index ++;
@endphp
    <div>
        @csrf
    <label>{{$index}}</label>
    <label >{{$scores->user['pseudo']}}</label>
    <label >{{$scores->score}}</label>
    <table>
        <tr>
        </tr>
    </table>
    </div>
@endforeach
@endforeach
@endsection

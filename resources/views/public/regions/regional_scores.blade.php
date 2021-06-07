@extends('.layouts.app')

@section('content')

@include('public.components.menu')

<div class="container" id="regional-scores">
    <div class="row mb-3">
        <div class="col-8">
            <h1>Classement régional</h1>
            <p>{{$region->name}}</p>
        </div>
    </div>
</div>

<section id="scores" class="container bg-white py-3">
    <table class="score-table">
        <tbody>
            <?php $i = 1; ?>
            @foreach ($mergedScores->sortByDesc('score') as $score)
                
            <tr>
                <td>{{$i}}</td>
                <td><img src="{{$score->user->avatar}}" alt="{{$score->user->pseudo}}" class="rounded-circle"></td>
                <td>
                    <a href="{{route('profile.show', [$score->user_id])}}"><b>{{$score->user->pseudo}}</b></a>
                    <small>{{$score->score}} pts</small>
                </td>
            </tr>
            <?php $i ++; ?>
            @endforeach
        </tbody>
    </table>
</section>

@endsection
@extends('.layouts.app')

@section('content')

@include('public.components.menu')

<div class="grid">
    <div class="container" id="regional-scores-title">
        <div class="row mb-3">
            <div class="col-8">
                <h1>Classement régional</h1>
                <p>{{$region->name}}</p>
            </div>
            @if(auth()->check())
                <div class="col-4">
                    <a href="{{route('profile.show', [auth()->id()])}}" class="profile-picture">
                        <img class="rounded-circle" src="{{auth()->user()->avatar}}" title="Profil" alt="Profil">
                        <span>Profil</span>
                    </a>
                </div>
                @endif
        </div>
    </div>

    <section id="regional-scores" class="box container py-3">
        <table class="score-table">
            <tbody>
                <?php $i = 1; ?>
                @foreach ($mergedScores->sortByDesc('score') as $score)
                    @if(auth()->check() && $score->user_id == auth()->id())
                    <tr class="my-score">
                    @else
                    <tr>
                    @endif
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
</div>

@endsection
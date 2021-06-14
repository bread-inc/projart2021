@extends('.layouts.app')

@section('content')

<div class="container h-100">
    <div id="vue-app" class="grid mb-3">
        <section id="region-name">
            <div class="row my-3 m-md-0">
                <div class="col-8">
                    <h1>Fin du jeu</h1>
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
        </section>

        <section id="regional-scores" class="box">
            <div class="row my-3 m-md-0">
                <div class="col-12">
                    <h3>Vous avez terminé le quiz <b>{{$quiz->title}}</b> !</h3>
                    <h2 class="mt-5 mb-3">Votre score : {{$score}} pts</h2>
                    <p>Quiz réalisé en {{App\Http\Controllers\GameController::renderTime($time)}}.</p>

                    @if(auth()->check())
                        <h2 class="mt-5 mb-3">Vos nouveaux badges</h2>
                        @if(!empty($newBadges))
                        <ul>
                            @foreach ($newBadges as $badge)
                                <li>{{$badge->id}} - {{$badge->label}}</li>
                            @endforeach
                        </ul>
                        @else
                        <p><i>Vous n'avez pas débloqué de nouveau badge.</i></p>
                        @endif
                    @endif

                    <a href="{{route('home')}}" class="btn btn-gradient">Retour au menu</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

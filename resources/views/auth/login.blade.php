@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <div id="login-logo">
                <img src="{{asset('storage/images/logo/logo.png')}}" alt="SwissGuesser">
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row my-5">
            <div class="col-12">
                <div class="form-group row">
                    <h3 for="email" class="col-md-4 text-md-right">E-mail</h3>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <h3 for="password" class="col-md-4 text-md-right">Mot de passe</h3>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif

            </div>
        </div>
        
        <div class="row">
            <div class="col-12">

                <button type="submit" class="btn btn-gradient">
                    Valider
                </button>
    
                <a href="{{route('register')}}" class="d-block text-center my-3">Créer un compte</a>
                <a href="{{route('home')}}" class="d-block text-center my-3">Continuer sans se connecter</a>
                
            </div>
        </div>
    </form>

</div>

@endsection

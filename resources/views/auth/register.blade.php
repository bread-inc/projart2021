@extends('layouts.auth-layout')

@section('content')
<div class="container" id="login">
    <div class="row mt-5 mt-md-0">
        <div class="col-12 col-md-6">
            <h1>S'enregistrer</h1>
        </div>
        <div class="col-12 col-md-6">
            <div id="login-logo">
                <img src="{{asset('storage/images/logo/logo.png')}}" alt="SwissGuesser">
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row my-5">
            <div class="col-12 mx-auto">
                <div class="form-group row">
                    <h3 for="email" class="col-12">E-mail</h3>

                    <div class="col-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <h3 for="password" class="col-12">Mot de passe</h3>

                    <div class="col-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <h3 for="password" class="col-12">Confirmer le mot de passe</h3>

                    <div class="col-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                        @error('password-confirm')
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
            <div class="col-12 mx-auto">

                <button type="submit" class="btn btn-gradient">
                    S'enregistrer
                </button>
    
                <a href="{{route('home')}}" class="d-block text-center my-3">Continuer sans se connecter</a>
                
            </div>
        </div>
    </form>
</div>
@endsection

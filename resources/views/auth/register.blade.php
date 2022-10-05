@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header-custom">{{ __('Registrati') }}</div>
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Nome*') }}</label>
    
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required pattern="[a-zA-Z'-'\s]*" autofocus title="Il nome deve contenere solo lettere">
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('E-mail*') }}</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Password*') }}</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La password deve contenere almeno un numero, una lettera maiuscola, una minuscola e 8 caratteri">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('Conferma Password*') }}</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vat" class="col-md-4 col-form-label text-md-left">{{ __('P.Iva*') }}</label>

                                <div class="col-md-12">
                                    <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ old('vat') }}" required autofocus pattern="[0-9]{11}" title="La p.iva deve avere 11 numeri">

                                    @error('vat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <p>*campo obbligatorio</p>
                            </div>        

                            <div class="form-group row mb-0">
                                <div class="col-md btn-log">
                                    <button type="submit" class="btn" style="background-color: #b45cff">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                            <div class="mt-2" style="text-align: center">
                                <span>Hai già un account? <a href="{{ route('login') }}">{{ __('Accedi') }}</a> ora</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
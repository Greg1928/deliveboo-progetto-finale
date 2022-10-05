@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header-custom">{{ __('Accesso effettuato!') }}</div>
            <div class="card">
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if ($restaurant == false)
                        <div style="text-align: center">
                            <h3>Registra il tuo ristorante</h3>
                            <a href="{{route('admin.restaurants.create')}}" style="background-color: #b45cff; color: white" class="btn">Registra</a>
                        </div>
                    @else
                        <div style="text-align: center">
                            <h3>Hai già registrato il tuo ristorante</h3>
                            <a href="{{route('admin.restaurants.index')}}" class="btn" style="background-color: #b45cff; color: white">Visualizza</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

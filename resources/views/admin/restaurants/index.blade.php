@extends('layouts.app')

@section('content')
<div class="restaurant-index">
    <div class="container">
        <h1>Il tuo ristorante</h1>
            <div class="card-body">
                @if ($restaurant == false)
                    <div class="mb-3">
                        <a href="{{route('admin.restaurants.create')}}" class="btn btn-success">Aggiungi il tuo ristorante</a>
                    </div>
                @endif
                
                <div class="content">
                    <div class="row">
                        <div class="col">
                            @if ($restaurant->image)
                                    <img class="w-100" src="{{asset("storage/{$restaurant['image']}")}}" alt="{{$restaurant['name']}}">
                                @else 
                                    <img class="w-100" src="https://via.placeholder.com/150" alt="placeholder">
                                @endif
                        </div>
                        <div class="col align-self-center">
                            <div class="box">
                                <h2>"{{$restaurant['name']}}"</h2>
                        
                                <a href="{{route('admin.restaurants.show', $restaurant['id'])}}" class="btn">Dettagli</a>
                                <div class="mb-3">
                                    <a href="{{route('admin.dishes.index')}}" class="btn">Visualizza i piatti del tuo ristorante</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
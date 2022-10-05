@extends('layouts.app')

@section('content')
<div class="restaurant-show">
    <div class="container">
            <div class="card">
                <h1>"{{$restaurant['name']}}"</h1>

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="mb-3">
                            @if ($restaurant['image'])
                                <img class="w-100" src="{{asset("storage/{$restaurant['image']}")}}" alt="{{$restaurant['name']}}">
                            @else
                                <img class="w-100" src="https://via.placeholder.com/150" alt="placeholder">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12" style="text-align: center">
                        <div class="row">
                            <div class="col-12">
                                @if(count($restaurant['types']) > 0)
                            <div class="mt-3">
                                <hr>
                                    <h3>Il tuo ristorante è associato alle seguenti tipologie:</h3>
                            </div>
                    
                                
                                    @foreach ($restaurant['types'] as $type)
                                        <p>{{$type['name']}}</p>
                                    @endforeach
                                <hr>
                            </div>
                            <hr>
                        </div>
                        
                            <div class="col-12">
                                <h4>Si trova in: <p>{{$restaurant['address']}}</p></h4>
                            </div>
                    
                   
                        
                        <hr>
                        <a href="{{route('admin.restaurants.edit', $restaurant['id'])}}" class="btn mb-3">Modifica</a>
                        <a href="{{route('admin.restaurants.index', $restaurant['id'])}}" class="btn mb-3">Indietro</a>
                    </div>
                @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection
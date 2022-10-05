@extends('layouts.app')

@section('content')
<div class="restaurant-show">
    <div class="container">
        <div class="card">
            
                <h1>{{$dish['name']}}</h1>

            <div class="card-body">
    
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="mb-3">
                            @if ($dish['image'])
                                <img class="w-100" src="{{asset("storage/{$dish['image']}")}}" alt="{{$dish['name']}}">
                            @else
                                <img class="w-100" src="https://via.placeholder.com/150" alt="placeholder">
                            @endif
            
                        </div>
                        {{-- <div>
                            {{ $dish['visible'] == true ? 'Visibile' : 'Non visibile' }}
                        </div> --}}
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div>
                            <h3>Descrizione:<p> {{$dish['description']}}</p></h3>
                        </div>
                        <hr>
                        <div>
                            <h3>Prezzo:<p> {{$dish['price']}} €</p></h3>
                        </div>
                        <hr>
                        <div>
                            @if ($dish['visible'])
                            <span class="badge badge-pill badge-success">Visibile</span>
                            @else
                            <span class="badge badge-pill badge-secondary">Non visibile</span>
                            @endif
                        </div>
                        <hr>
                        <a href="{{route('admin.dishes.edit', $dish['id'])}}" class="btn">Modifica</a>
                    </div>
                </div>
            
                <div class="mt-3">
                    <a href="{{route('admin.dishes.index')}}" class="btn">Indietro</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
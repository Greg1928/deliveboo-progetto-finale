@extends('layouts.app')

@section('content')
<div class="restaurant-edit">
    <div class="container">
            <h1>Modifica il tuo Ristorante</h1>
            <div class="card">
            <div class="card-body">
                <form action="{{route('admin.restaurants.update', $restaurant['id'])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nome del ristorante*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $restaurant['name'])}}" required autofocus>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Indirizzo*</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address', $restaurant['address'])}}" required autofocus placeholder="Es. Via Roma 12">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="types">Tipologie*</label>
                        <br>
                        @foreach ($types as $type)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="{{$type['slug']}}" value="{{$type['id']}}" name="types[]" {{in_array($type->id, old('types', $restaurantTypes)) ? 'checked' : ''}}>
                                <label class="form-check-label" for="{{$type['slug']}}">{{$type['name']}}</label>
                            </div>
                        @endforeach
                        @error('types')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Immagine</label>
                        @if ($restaurant['image'])
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image', $restaurant['image'])}}">
                            <div class="mt-4">
                                <img width="200" height="100" src="{{asset("storage/{$restaurant['image']}")}}">
                            </div>
                        @else
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image', $restaurant['image'])}}">
                            <div class="mt-4" >
                                <img width="200" height="100" src="https://via.placeholder.com/150">
                            </div>
                        @endif
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <p>*campo obbligatorio</p>
                    </div>

                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                        Modifica
                    </button>
                    
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Attenzione</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                Sei sicuro di voler salvare le modifiche?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn">Salva modifiche</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <a href="{{route('admin.restaurants.show', $restaurant['id'])}}" class="btn">Annulla</a>
                </form>
            </div>
        </div>
        </div>
    </div>
    </div>  
@endsection 
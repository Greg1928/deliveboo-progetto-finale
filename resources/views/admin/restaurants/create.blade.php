@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Aggiungi il tuo ristorante</h1>
        <div class="card">
        
            <div class="card-body">
                <form action="{{route('admin.restaurants.store')}}" method="POST" enctype="multipart/form-data"> 
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome del ristorante*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required autofocus>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Indirizzo*</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{old('address')}}" required autofocus placeholder="Es. Via Roma 12">
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="types">Tipologie*</label>
                        <br>
                        @foreach ($types as $type)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="{{$type['slug']}}" value="{{$type['id']}}" name="types[]" {{in_array($type['id'], old('types', [])) ? 'checked' : ''}} accepted>
                                <label class="form-check-label" for="{{$type['slug']}}">{{$type['name']}}</label>
                            </div>
                        @endforeach
                        @error('types')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Immagine</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image')}}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <p>*campo obbligatorio</p>
                    </div>
                    
                    <button type="submit" class="btn" style="background-color: #b45cff">Aggiungi</button>
                </form>

            </div>
        </div>
    </div>
@endsection
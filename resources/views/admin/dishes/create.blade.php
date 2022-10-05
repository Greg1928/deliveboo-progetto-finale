@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Crea un nuovo piatto</h1>
            </div>
            <div class="card-body">
                <form action="{{route('admin.dishes.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome del piatto*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Descrizione*</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10" required>{{old('description')}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Prezzo*</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price')}}" required min="0.10" step="0.01">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Immagine</label>
                        <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image')}}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input @error('visible') is-invalid @enderror" id="visible" name="visible" {{old('visible') ? 'checked' : ''}}>
                        <label class="form-check-label" for="visible">Visibile</label>
                        @error('visible')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <p>*campo obbligatorio</p>
                    </div>

                    <button type="submit" style="background-color: #b45cff; color: white;" class="btn">Crea</button>
                    <a href="{{route('admin.dishes.index')}}" style="background-color: #b45cff; color: white;" class="btn">Indietro</a>
                </form>
            </div>
        </div>
    </div>
@endsection
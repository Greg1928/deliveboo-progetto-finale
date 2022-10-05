@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 style="text-align: center">Modifica il tuo piatto:</h1>
        <h2 style="text-align: center">{{$dish['name']}}</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.dishes.update', $dish['id'])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nome del piatto*</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $dish['name'])}}" required>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Descrizione*</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10" required>{{old('description', $dish['description'])}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Prezzo*</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{old('price', $dish['price'])}}" required min="0.1" step="0.01">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Immagine</label>

                        @if ($dish['image'])
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image', $dish['image'])}}">
                            <div class="mt-4">
                                <img width="200" height="100" src="{{asset("storage/{$dish['image']}")}}">
                            </div>
                        @else
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image', $dish['image'])}}">
                            <div class="mt-4" >
                                <img width="200" height="100" src="https://via.placeholder.com/150">
                            </div>
                        @endif
                        
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input @error('visible') is-invalid @enderror" id="visible" name="visible" {{old('visible', $dish['visible']) ? 'checked' : ''}}>
                        <label class="form-check-label" for="visible">Visibile</label>
                        @error('visible')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <p>*campo obbligatorio</p>
                    </div>        

                    <button type="button" class="btn" style="background-color: #b45cff; color: white" data-toggle="modal" data-target="#exampleModal">
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
                            <button type="button" class="btn" data-dismiss="modal" style="background-color: #b45cff; color: white">Chiudi</button>
                            <button type="submit" class="btn" style="background-color: #b45cff; color: white">Salva modifiche</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <a href="{{route('admin.dishes.show', $dish['id'])}}" style="background-color: #b45cff; color: white" class="btn">Annulla</a>
                  
                </form>
            </div>
        </div>
    </div>
@endsection
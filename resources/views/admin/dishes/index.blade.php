@extends('layouts.app')

@section('content')
<div class="dishes-index">
    <div class="container">
        <h1>I tuoi Piatti</h1> 
        <div class="mb-3">
            <a href="{{route('admin.dishes.create')}}" class="btn">Aggiungi un nuovo piatto</a>
        </div>
        <div class="row mt-4">
            @foreach ($dishes as $dish)
                <div class="col-lg-4 mt-4 col-md-6 col-sm-12">
                    <div class="dish">
                        <div class="content">
                            @if ($dish->image)
                                <img width="150" height="100" src="{{asset("storage/{$dish->image}")}}" alt="{{$dish->name}}"></td>
                            @else 
                                <img width="150" height="100" src="https://via.placeholder.com/150" alt="placeholder"></td>
                            @endif
                            <p>{{$dish['name']}} </p>
                            <p>{{$dish['price']}} €</p>
                            <div>
                                <a href="{{route('admin.dishes.show', $dish['id'])}}" class="btn">Visualizza</a>
                                    
                                <form action="{{route('admin.dishes.destroy', $dish['id'])}}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                                        Cancella
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
                                                Sei sicuro di voler eliminare il piatto?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">Annulla</button>
                                                <button type="submit" class="btn">Elimina</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>
    </div>
</div>
@endsection 
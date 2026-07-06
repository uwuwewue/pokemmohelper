@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-12">
            <h2 class="text-warning fw-bold border-bottom border-secondary pb-2">Interactive Pokedex</h2>
            <p class="text-poke-light"></p>
        </div>
    </div>

    <div class="row">
       @foreach ($pokemons as $pokemon)
            <div class="col-md-2 mb-4">
                
                <div class="card bg-dark text-white h-100 shadow-sm {{ in_array($pokemon->id, $caughtPokemonIds) ? 'border-warning border-3' : 'border-secondary' }}" 
                     data-bs-toggle="modal" 
                     data-bs-target="#pokemonModal-{{ $pokemon->id }}" 
                     style="cursor: pointer; transition: transform 0.2s;">
                    <div class="card-body text-center">
                        <img src="{{ $pokemon->image_url }}" alt="{{ $pokemon->name }} image">
                    </div>
                </div>

                <div class="modal fade" id="pokemonModal-{{ $pokemon->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        
                        <div class="modal-content bg-dark text-white border-warning">
                            
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title fw-bold text-warning" id="pokemonModalLabel-{{ $pokemon->id }}">
                                    Pokemon Details
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            
                            <div class="modal-body text-center">
                                <img src="{{ $pokemon->image_url }}" alt="{{ $pokemon->name }} image">
                                <p class="text-secondary">{{ $pokemon->name }} #{{ $pokemon->id }}</p>
                                
                                <hr class="border-secondary">
                                
                                <p>sssssssssssss</p>
                                
                            </div>
                            
                            <div class="modal-footer border-secondary justify-content-center">
                                <form action="{{ route('pokedex.toggle', $pokemon->id) }}" method="POST">
                                    @csrf @if (in_array($pokemon->id, $caughtPokemonIds))
                                        <button type="submit" class="btn btn-outline-danger">Release</button>
                                    @else
                                        <button type="submit" class="btn btn-warning text-dark fw-bold">Catch</button>
                                    @endif
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                </div>
        @endforeach
    </div>
</div>
@endsection
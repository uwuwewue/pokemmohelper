@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-poke-light">
        <div class="row justify-content-center text-center">
            <div class="col-md-8">
                <div class="border rounded border-warning p-4 bg-poke-dark shadow">
                    <h2 class="text-poke-gold mb-4">Edit your Shiny</h2>
                    <hr class="border-secondary my-4">
                    
                    <form method="POST" action="{{ route('shiny.update', $shiny->id)  }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="fw-bold text-poke-light mb-3">Sprite</h4>
                                <hr class="border-secondary my-3">
                                <div class="d-flex justify-content-center align-items-center flex-grow-1">
                                    <img id="pokemon_sprite" 
                                        src="https://img.pokemondb.net/sprites/black-white/shiny/{{ Str::lower($shiny->pokemon_name) }}.png" 
                                        alt="Shiny {{ $shiny->pokemon_name }}"
                                        style="width: 150px; height: 150px; image-rendering: pixelated; object-fit: contain;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4 class="fw-bold text-poke-light">Stats</h4>
                                <hr class="border-secondary my-3">
                                <label for="pokemon_name" class="form-label text-poke-light">Pokemon</label>
                                <div class="position-relative">
                                    <input type="text" id="pokemon_name" name="pokemon_name" class="form-control form-control-poke" value="{{ $shiny->pokemon_name }}" readonly>
                                    <div id="custom_pokemon_list" class="custom-dropdown-list d-none"></div>
                                </div>
                                
                                <div class="position-relative">
                                    <label for="nature" class="form-label text-poke-light">Nature</label>
                                    <input type="text" class="form-control form-control-poke" id="nature" name="nature" value="{{ $shiny->nature }}" placeholder="np. Adamant" autocomplete="off">
                                    <div id="custom_nature_list" class="custom-dropdown-list d-none"></div>
                                </div>

                                <label for="hp_iv" class="form-label text-poke-light mt-3">HP IV</label>
                                <input type="number" class="form-control form-control-poke" id="hp_iv" name="hp_iv" value="{{ $shiny->hp_iv }}" placeholder="0-31" min="0" max="31">

                                <label for="attack_iv" class="form-label text-poke-light mt-3">Attack IV</label>
                                <input type="number" class="form-control form-control-poke" id="attack_iv" name="attack_iv" value="{{ $shiny->attack_iv }}" placeholder="0-31" min="0" max="31">

                                <label for="defense_iv" class="form-label text-poke-light mt-3">Defense IV</label>
                                <input type="number" class="form-control form-control-poke" id="defense_iv" name="defense_iv" value="{{ $shiny->defense_iv }}" placeholder="0-31" min="0" max="31">

                                <label for="sp_attack_iv" class="form-label text-poke-light mt-3">Sp. Attack IV</label>
                                <input type="number" class="form-control form-control-poke" id="sp_attack_iv" name="sp_attack_iv" value="{{ $shiny->sp_attack_iv }}" placeholder="0-31" min="0" max="31">
                                
                                <label for="sp_defense_iv" class="form-label text-poke-light mt-3">Sp. Defense IV</label>
                                <input type="number" class="form-control form-control-poke" id="sp_defense_iv" name="sp_defense_iv" value="{{ $shiny->sp_defense_iv }}" placeholder="0-31" min="0" max="31">

                                <label for="speed_iv" class="form-label text-poke-light mt-3">Speed IV</label>
                                <input type="number" class="form-control form-control-poke" id="speed_iv" name="speed_iv" value="{{ $shiny->speed_iv }}" placeholder="0-31" min="0" max="31">

                                <hr class="border-secondary my-3">

                                <label for="encounters" class="form-label text-poke-light mt-3">Encounters</label>
                                <input type="number" class="form-control form-control-poke" id="encounters" name="encounters" value="{{ $shiny->encounters }}" placeholder="12345" min="0" max="1000000">

                                <label for="catch_date" class="form-label text-poke-light mt-3">Catch Date</label>
                                <input type="date" class="form-control form-control-poke mb-3" id="catch_date" name="catch_date" value="{{ $shiny->catch_date }}">
                            </div>
                       </div>
                       <hr class="border-secondary my-4">
                        <div class="text-center">
                            <a href="{{ route('profile.show', Auth::user()->username) }}" class="btn btn-secondary shadow-sm fw-bold m-3">Cancel</a>
                            <button type="submit" class="btn btn-warning px-5 fw-bold shadow">Save</button>
                        </div>
                    </form>
                </div>       
            </div>
        </div>

    </div>
    @vite('resources/js/shiny-create.js')
@endsection
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::all();
        $caughtPokemonIds = auth()->user()->pokemons->pluck('id')->toArray();

        return view('pokedex',  compact('pokemons', 'caughtPokemonIds'));
    }

    public function toggleCatch(Pokemon $pokemon)
    {
        auth()->user()->pokemons()->toggle($pokemon->id);
        return back();
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class PokemonController extends Controller
{
    public function index()
    {
        $search = request('search');
        if($search){
            $pokemons = Pokemon::where('name', 'like', '%' . $search . '%')->orWhere('pokedex_number', $search)->get();
        }
        else{
            $pokemons = Pokemon::all();
        }

        $caughtPokemonIds = auth()->user()->pokemons->pluck('id')->toArray();

        $typeColors = [
        'Normal' => '#A8A77A', 'Fire' => '#EE8130', 'Water' => '#6390F0',
        'Electric' => '#F7D02C', 'Grass' => '#7AC74C', 'Ice' => '#96D9D6',
        'Fighting' => '#C22E28', 'Poison' => '#A33EA1', 'Ground' => '#E2BF65',
        'Flying' => '#A98FF3', 'Psychic' => '#F95587', 'Bug' => '#A6B91A',
        'Rock' => '#B6A136', 'Ghost' => '#735797', 'Dragon' => '#6F35FC',
        'Dark' => '#705848', 'Steel' => '#B7B7CE', 'Fairy' => '#D685AD',
        'Default' => '#6c757d'
        ];

        return view('pokedex',  compact('pokemons', 'caughtPokemonIds', 'typeColors'));
    }

    public function toggleCatch(Pokemon $pokemon)
    {
        auth()->user()->pokemons()->toggle($pokemon->id);
        return back();
        
    }
}

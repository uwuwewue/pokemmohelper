<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pokemons = [
            ['pokedex_number' => 1, 'name' => 'Bulbasaur', 'type_1' => 'Grass', 'type_2' => 'Poison', 'image_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png'],
            ['pokedex_number' => 4, 'name' => 'Charmander', 'type_1' => 'Fire', 'type_2' => null, 'image_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png'],
            ['pokedex_number' => 7, 'name' => 'Squirtle', 'type_1' => 'Water', 'type_2' => null, 'image_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/7.png'],
            ['pokedex_number' => 25, 'name' => 'Pikachu', 'type_1' => 'Electric', 'type_2' => null, 'image_url' => 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png'],
        ];

        foreach ($pokemons as $pokemon) {
            \App\Models\Pokemon::create($pokemon);
        }
    }
}

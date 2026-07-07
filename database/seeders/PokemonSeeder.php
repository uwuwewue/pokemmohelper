<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pokemon;
use Illuminate\Support\Facades\Http;

class PokemonSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Odpalam maszynę losującą... Pobieram 649 Pokemonów. Zrób sobie herbatę, to potrwa ok. 1-2 minuty!');

        for ($i = 1; $i <= 649; $i++) {
            
            $response = Http::retry(3, 1000)->get("https://pokeapi.co/api/v2/pokemon/{$i}");

            if ($response->successful()) {
                $data = $response->json();

                $name = ucfirst($data['name']);
                $type1 = ucfirst($data['types'][0]['type']['name']);
                $type2 = isset($data['types'][1]) ? ucfirst($data['types'][1]['type']['name']) : null;
                $imageUrl = "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/{$i}.png";

                Pokemon::updateOrCreate(
                    ['pokedex_number' => $i], 
                    [                         
                        'name' => $name,
                        'type_1' => $type1,
                        'type_2' => $type2,
                        'image_url' => $imageUrl
                    ]
                );
            }
        }

        $this->command->info('BOOM! Pokedex loaded!');
    }
}
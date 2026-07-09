<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserShinyController extends Controller
{
    public function create()
    {
        return view('shiny.create');
    }

    public function store(Request $request)
    {
        $ivRule = 'nullable|integer|between:0,31';

        $validated = $request->validate([
            'pokemon_name' => 'required|string|max:255',
            'nature' => ['nullable', 'string', Rule::in([
                'Adamant', 'Bashful', 'Bold', 'Brave', 'Calm', 'Careful', 'Docile', 'Gentle', 'Hardy', 'Hasty',
                'Impish', 'Jolly', 'Lax', 'Lonely', 'Mild', 'Modest', 'Naive', 'Naughty', 'Quiet', 'Quirky',
                'Rash', 'Relaxed', 'Sassy', 'Serious', 'Timid'
            ])],
            'hp_iv' => $ivRule,
            'attack_iv' => $ivRule,
            'defense_iv' => $ivRule,
            'sp_attack_iv' => $ivRule,
            'sp_defense_iv' => $ivRule,
            'speed_iv' => $ivRule,
            'encounters' => 'nullable|integer|between:0,1000000',
            'catch_date' => 'nullable|date',
        ]);

        $request->user()->shinies()->create($validated);

        return redirect()->route('profile.show', $request->user()->username);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserShinyController extends Controller
{
    public function create()
    {
        return view('shiny.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pokemon_name' => 'required|string|max:255',
            'nature' => 'nullable|string|max:255',
            'hp_iv' => 'nullable|integer|between:0,31',
            'attack_iv' => 'nullable|integer|between:0,31',
            'defense_iv' => 'nullable|integer|between:0,31',
            'sp_attack_iv' => 'nullable|integer|between:0,31',
            'sp_defense_iv' => 'nullable|integer|between:0,31',
            'speed_iv' => 'nullable|integer|between:0,31',
            'encounters' => 'nullable|integer|between:0,1000000',
            'catch_date' => 'nullable|date',
        ]);

        $request->user()->shinies()->create($validated);

        return redirect()->route('profile.show', $request->user()->username);
    }
}

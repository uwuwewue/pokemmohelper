<?php

namespace App\Http\Controllers;

use App\Models\UserShiny;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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

    public function edit(string $id)
    {
        $shiny = UserShiny::findOrFail($id);

        if ($shiny->user_id !== Auth::id()){
            abort(403, 'You cant edit someones else pokemon!');
        }

        return view('shiny.edit', compact('shiny'));
    }

    public function update(Request $request, string $id)
    {
        $shiny = UserShiny::findOrFail($id);

        if (Auth::id() !== $shiny->user_id){
            abort(403, 'Unauthorized action.');
        }

        $shiny->update([
            'nature'  => $request->input('nature'),
            'hp_iv' => $request->input('hp_iv'),
            'attack_iv' => $request->input('attack_iv'),
            'defense_iv' => $request->input('defense_iv'),
            'sp_attack_iv' => $request->input('sp_attack_iv'),
            'sp_defense_iv' => $request->input('sp_defense_iv'),
            'speed_iv' => $request->input('speed_iv'),
            'encounters' => $request->input('encounters'),
            'catch_date' => $request->input('catch_date'),
        ]);

        return to_route('profile.show', Auth::user()->username)->withFragment('shinyshowcase')->with('success', 'Shiny updated!');
    }

    public function destroy(string $id)
    {
        $shiny = UserShiny::findOrFail($id);

        if (Auth::id() !== $shiny->user_id){
            abort(403, 'You cant delete someones else pokemon!');
        }

        $shiny->delete();

        return to_route('profile.show', Auth::user()->username)->withFragment('shinyshowcase')->with('success', 'Shiny has been released!');
    }
}

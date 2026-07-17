<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecruitmentController extends Controller
{
    public function index()
    {
        $recruitments = Recruitment::with('user')->latest()->paginate(6);

        return view('recruitment.index', compact('recruitments'));
    }

    public function create()
    {
        return view('recruitment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_name' => 'required|string|max:255',
            'playstyle' => 'required|string|max:255',
            'requirements' => 'required|string|max:1000',
            'description' => 'required|string|max:1000',
        ]);

        $request->user()->recruitments()->create($validated);

        return redirect()->route('recruitment.index')->with('success', 'Recruitment posted!');
    }

    public function edit(Recruitment $recruitment)
    {
        if (Auth::id() !== $recruitment->user_id){
            abort(403, 'Unauthorized action.');
        }
        
        return view('recruitment.edit', compact('recruitment'));
    }

    public function update(Request $request, Recruitment $recruitment)
    {
        if (Auth::id() !== $recruitment->user_id){
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'team_name' => 'required|string|max:255',
            'playstyle' => 'required|string|max:255',
            'requirements' => 'required|string|max:1000',
            'description' => 'required|string|max:1000',
        ]);

        $recruitment->update($validated);

        return redirect()->route('recruitment.index')->with('success', 'Recruitment post updated!');
    }

    public function destroy(Recruitment $recruitment)
    {
        if (Auth::id() !== $recruitment->user_id){
            abort(403, 'Unauthorized action.');
        }

        $recruitment->delete();

        return redirect()->route('recruitment.index')->with('success', 'Recruitment post deleted!');
    }
}

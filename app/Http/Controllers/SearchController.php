<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function liveSearch(Request $request)
    {
        $query = $request->input('query');

        if (strlen($query) < 2){
            return response()->json([]);
        }

        $users = User::where('username', 'LIKE', "%{$query}%")->take(5)->get(['id', 'username']);

        return response()->json($users);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggle(User $user)
    {
        $me = Auth::user();

        if ($me->id === $user->id){
            return back()->with(['follow_error' => 'You cannot follow yourself!']);
        }

        $me->following()->toggle($user->id);

        return back()->with('success','Your follow status has been updated!');
    }
}

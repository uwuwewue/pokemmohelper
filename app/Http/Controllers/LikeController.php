<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(string $id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();

        $existingLike = $post->likes()->where('user_id', $user->id)->first();

        if ($existingLike){
            $existingLike->delete();
            $isLiked = false;
        }else{
            $post->likes()->create([
                'user_id' => $user->id,
            ]);
            $isLiked = true;
        }

        return response()->json([
            'status' => 'success',
            'liked' => $isLiked,
            'likes_count' => $post->likes()->count(),
        ]);
    }
}

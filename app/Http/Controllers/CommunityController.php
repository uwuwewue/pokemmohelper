<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommunityController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();

        return view('community.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')){
            $path = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id'=> Auth::id(),
            'content' => $request->input('content'),
            'image_path' => $path,
        ]);

        return back();
    }

    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id){
            abort(403, 'You dont have permissions to delete this post.');
        }

        if ($post->image_path){
            Storage::disk('public')->delete($post->image_path);
        }

        $post->delete();

        return back()->with('success', 'Post deleted!');
    }
}

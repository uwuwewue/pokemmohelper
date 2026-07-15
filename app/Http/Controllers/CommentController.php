<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, string $id)
    {
        $validated= $request->validate([
            'comment'=> 'nullable|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!$request->filled('comment') && !$request->hasFile('image')){
            return back()->withErrors(['comment' => 'You must provide a text or an image.']);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('comments_images', 'public');
        }

        Comment::create([
            'comment' => $request->input('comment'),
            'post_id' => $id,
            'user_id'=> Auth::id(),
            'image_path' => $imagePath,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }
}

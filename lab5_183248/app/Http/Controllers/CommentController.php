<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $postSlug)
    {
        // Validate the request data
        $request->validate([
            'body' => 'required|string',
        ]);

        // Find the post by slug
        $post = Post::where('slug', $postSlug)->firstOrFail();

        // Create a new comment
        $comment = new Comment([
            'body' => $request->input('body'),
        ]);

        // Associate the comment with the post and the currently authenticated user
        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());

        // Save the comment
        $comment->save();

        // Redirect back to the post with a success message
        return redirect()->route('post.show', ['slug' => $post->slug])->with('success', 'Comment added successfully');
    }
}

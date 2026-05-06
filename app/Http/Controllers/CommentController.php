<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'testo' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->post_id = $post->post_id;
        $comment->user_id = auth()->id();
        $comment->testo = $validated['testo'];
        $comment->save();

        return back()->with('success', 'Commento aggiunto!');
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Commento eliminato!');
    }
}

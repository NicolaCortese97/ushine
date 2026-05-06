<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.user', 'likes'])
                    ->latest()
                    ->get();

        return view('pages.homepage', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contenuto' => 'required|string|max:2000',
        ]);

        $post = new Post();
        $post->user_id = auth()->id();
        $post->contenuto = $validated['contenuto'];
        $post->tipo = 'Testo';
        $post->visibile_a = 'Tutti';
        $post->approvato = true;
        
        $post->save();

        return back()->with('success', 'Post pubblicato con successo!');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Non sei autorizzato a eliminare questo post.');
        }

        $post->delete();

        return back()->with('success', 'Post eliminato con successo!');
    }
}

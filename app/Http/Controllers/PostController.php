<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.user', 'comments.likes', 'likes'])
                    ->latest()
                    ->get();

        return view('pages.homepage', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contenuto' => 'nullable|string|max:2000',
            'media'     => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi,webm|max:51200',
        ]);

        // Almeno testo o media obbligatorio
        if (empty($validated['contenuto']) && !$request->hasFile('media')) {
            return back()->withErrors(['contenuto' => 'Inserisci del testo o un file media.']);
        }

        $post = new Post();
        $post->user_id   = auth()->id();
        $post->contenuto = $validated['contenuto'] ?? '';
        $post->visibile_a = 'Tutti';
        $post->approvato  = true;

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            
            if (!$file->isValid()) {
                return back()->withErrors(['media' => 'Errore durante il caricamento del file: potrebbe essere troppo grande.']);
            }

            $mimeType  = $file->getMimeType();
            $isVideo   = str_starts_with($mimeType, 'video/');
            
            // Usiamo move() invece di store() per evitare bug di getRealPath() su Windows
            $fileName = $file->hashName();
            $file->move(storage_path('app/public/posts'), $fileName);
            $path = 'posts/' . $fileName;

            $post->media_path = $path;
            $post->media_type = $isVideo ? 'video' : 'image';
            $post->tipo       = $isVideo ? 'Video' : 'Foto';
        } else {
            $post->tipo = 'Testo';
        }

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

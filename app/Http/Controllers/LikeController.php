<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $userId = auth()->id();
        
        $like = Like::where('post_id', $post->post_id)
                    ->where('user_id', $userId)
                    ->first();

        if ($like) {
            $like->delete();
            $status = 'unliked';
        } else {
            Like::create([
                'post_id' => $post->post_id,
                'user_id' => $userId,
                'tipo_reazione' => 'Like',
            ]);
            $status = 'liked';
        }

        // Return JSON if the request wants JSON (useful for AJAX later)
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'status' => $status,
                'likes_count' => $post->likes()->count()
            ]);
        }

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;

class CommentLikeController extends Controller
{
    public function toggle(Comment $comment)
    {
        $userId = auth()->id();

        $like = CommentLike::where('commento_id', $comment->commento_id)
                           ->where('user_id', $userId)
                           ->first();

        if ($like) {
            $like->delete();
            $status = 'unliked';
        } else {
            CommentLike::create([
                'commento_id' => $comment->commento_id,
                'user_id'     => $userId,
            ]);
            $status = 'liked';
        }

        return response()->json([
            'status'      => $status,
            'likes_count' => $comment->likes()->count(),
        ]);
    }
}

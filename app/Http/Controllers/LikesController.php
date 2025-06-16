<?php

namespace App\Http\Controllers;

use App\Models\likes;
use App\Models\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    // like specified post
    public function like(Post $post)
    {
        $userId = auth()->user()->userId;

        // Cek apakah user sudah like
        $alreadyLiked = $post->likes()->where('user_id', $userId)->exists();

        if (!$alreadyLiked) {
            $post->likes()->create([
                'user_id' => $userId,
            ]);
        }

        return back();
    }

    // unlike specified post
    public function unlike(Post $post)
    {
        $userId = auth()->user()->userId;

        $post->likes()->where('user_id', $userId)->delete();

        return back();
    }
}

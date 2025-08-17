<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;

class PostLikeController extends Controller

{
    public function verify(Post $post)
    {
        return response()->json([
            'liked' => $post->likes()->where('user_id', auth()->id())->exists()
        ]);
    }

    public function store(Post $post)
    {
        PostLike::firstOrCreate([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'liked' => true,
            'count' => $post->likes()->count()
        ]);
    }

    public function destroy(Post $post)
    {
        PostLike::where('post_id', $post->id)
            ->where('user_id', auth()->id())
            ->delete();

        return response()->json([
            'liked' => false,
            'count' => $post->likes()->count()
        ]);
    }


}

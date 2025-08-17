<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;

class DashboardController extends Controller

{

    public function index()
    {
        $topics = Topic::orderBy('name')->get();
        $heading = 'Todos os Posts';
        $posts = Post::with(['user', 'topic'])->latest()->get();
        $topicId = null;
        return view('dashboard', compact('posts', 'heading', 'topics', 'topicId'));
    }
    public function postPerId()

    {
        $topics = Topic::orderBy('name')->get();
        $heading = 'Meus Posts';
        $posts = Post::where('user_id', auth()->id())->with(['user', 'topic'])->latest()->get();
        return view('dashboard', compact('posts', 'heading', 'topics'));
    }
    public function postsPerTopic($Id)

    {
        $topic = Topic::find($Id);
        $heading = "Posts sobre o Tópico '{$topic->name}' ";
        $topics = Topic::orderBy('name')->get();
        $posts = Post::where('topic_id', $Id)->with(['user', 'topic'])->latest()->get();
        $topicId = $Id;
        return view('dashboard', compact('posts', 'heading','topics', 'topicId'));
    }

    public function postsMostLiked()
    {
        $heading = "Top 10 Posts Mais Curtidos ";


        $posts = Post::with('user', 'likes')
            ->withCount('likes')
            ->orderByDesc('likes_count')
            ->limit(10)
            ->get();

        return view('dashboard', compact('posts', 'heading'));
    }

}

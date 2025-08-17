<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function createTopic()
    {
        $topics = Topic::orderBy('name')->get();
        return view('posts.create', compact('topics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required|min:10',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'topic_id' => 'nullable|exists:topics,id',
            'new_topic_name' => 'nullable|string|max:255'
        ]);

        if ($request->filled('new_topic_name')) {
            $topic = Topic::firstOrCreate([
                'name' => $request->new_topic_name,
                'user_id' => Auth::id()
            ]);
            $topic_id = $topic->id;
        } else {
            $topic_id = $request->topic_id;
        }

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $path = $file->store('posts', 'public');
            $validated['image_path'] = '/storage/' . $path;
        }

        Post::create([
            'title' => $validated['title'],
            'body' => $validated['body'],
            'image_path' => $validated['image_path'],
            'user_id' => Auth::id(),
            'topic_id' => $topic_id
        ]);

        return redirect()->route('dashboard-posts')->with('success', 'Post criado com sucesso!');
    }


}

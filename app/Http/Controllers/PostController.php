<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user', 'likes')->latest()->get();

        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        Post::create([
            'content' => $request->content,
            'user_id' => session('user_id')
        ]);

        return back();
    }

    public function edit($id)
    {
        $post = \App\Models\Post::find($id);

        if (!$post || session('user_id') != $post->user_id) {
            return back()->with('error', 'Vous ne pouvez pas modifier ce post');
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = \App\Models\Post::find($id);

        if (!$post || session('user_id') != $post->user_id) {
            return back()->with('error', 'Vous ne pouvez pas modifier ce post');
        }

        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $post->content = $request->content;
        $post->save();

        return redirect('/posts')->with('success', 'Post modifié avec succès');
    }
    public function destroy($id)
    {
        $post = \App\Models\Post::find($id);

        // Check si user connecté howa propriétaire
        if (!$post || session('user_id') != $post->user_id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer ce post');
        }

        $post->delete();
        return back()->with('success', 'Post supprimé avec succès');
    }
}
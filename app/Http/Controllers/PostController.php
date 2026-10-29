<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Old posts page now just goes to the dashboard
    public function index()
    {
        return redirect()->route('dashboard');
    }

    // SHOW CREATE FORM
    public function create()
    {
        return view('posts.create');
    }

    // STORE DATA
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        Post::create($request->only('title', 'body'));

        return redirect()->route('dashboard')
                         ->with('success', 'Post created successfully.');
    }

    // SHOW SINGLE POST
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // SHOW EDIT FORM
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // UPDATE DATA
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $post->update($request->only('title', 'body'));

        return redirect()->route('dashboard')
                         ->with('success', 'Post updated successfully.');
    }

    // DELETE DATA
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('dashboard')
                         ->with('success', 'Post deleted successfully.');
    }
}
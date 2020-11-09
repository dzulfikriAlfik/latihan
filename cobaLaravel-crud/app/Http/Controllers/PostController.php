<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function add()
    {
        return view('posts.add');
    }

    public function create(Request $request)
    {
        Post::create([
            'title'     => $request->title,
            'content'   => $request->content,
            'user_id'   => auth()->user()->id,
            'thumbnail' => $request->thumbnail,
        ]);
        return redirect()->route('posts.index')->with('success', 'Post Berhasil Ditambahkan');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/posts')->with('success', 'Berhasil Delete Post');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        // validasi
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required',
            'thumbnail' => 'required',
        ]);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Berhasil Update Post');
    }
}

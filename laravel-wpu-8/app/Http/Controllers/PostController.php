<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {

        $subMenu = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $subMenu = ' in ' . $category->name;
        }
        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $subMenu = ' by ' . $author->name;
        }

        $data = [
            'title' => 'posts',
            'subMenu' => 'All Posts' . $subMenu,
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString() //method filter didapat dari method scopeFilter di model Post
        ];
        return view('posts', $data);
    }

    public function show(Post $post)
    {
        $data = [
            'title' => 'posts',
            'post' => $post
        ];
        return view('post', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $data = [
         'title' => 'Dashboard Posts',
         'posts' => Post::where('user_id', auth()->user()->id)->get()
      ];
      return view('dashboard.posts.index', $data);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('dashboard.posts.create', [
         'title'      => 'Create New Posts',
         'categories' => Category::all()
      ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $validatedData = $request->validate([
         'title'       => 'required|max:150',
         'slug'        => 'required|unique:posts',
         'category_id' => 'required',
         'image'       => 'image|file|max:1024',
         'body'        => 'required'
      ]);

      if ($request->file('image')) {
         $validatedData['image'] = $request->file('image')->store('post-images');
      }

      $validatedData['user_id'] = auth()->user()->id;
      $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

      Post::create($validatedData);

      return redirect('/dashboard/posts')->with('success', 'New post has been added');
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function show(Post $post)
   {
      $data = [
         'title' => 'Detail Post',
         'post'  => $post
      ];
      return view('dashboard.posts.show', $data);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function edit(Post $post)
   {
      return view('dashboard.posts.edit', [
         'title'      => 'Create New Posts',
         'post'       => $post,
         'categories' => Category::all()
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Post $post)
   {
      $rules = [
         'title'       => 'required|max:150',
         'category_id' => 'required',
         'image'       => 'image|file|max:1024',
         'body'        => 'required'
      ];

      if ($request->slug != $post->slug) {
         $rules['slug'] = 'required|unique:posts';
      }

      $validatedData = $request->validate($rules);

      if ($request->file('image')) {
         if ($request->oldImage) {
            Storage::delete($request->oldImage);
         }
         $validatedData['image'] = $request->file('image')->store('post-images');
      }

      $validatedData['user_id'] = auth()->user()->id;
      $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);

      Post::where('id', $post->id)
         ->update($validatedData);

      return redirect('/dashboard/posts')->with('success', 'Post has been updated');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */
   public function destroy(Post $post)
   {
      if ($post->image) {
         Storage::delete($post->image);
      }
      Post::destroy($post->id);

      return redirect('/dashboard/posts')->with('success', 'Post has been deleted');
   }

   public function checkSlug(Request $request)
   {
      $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
      return response()->json(['slug' => $slug]);
   }
}

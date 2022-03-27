@extends('layouts.main')

@section('content')
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <h1 class="text-center">Halaman Single Post</h1>
            <h2>{{ $post->title }}</h2>
            <p>By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category={{ $post->category->slug }}"
                  class="text-decoration-none">{{ $post->category->name }}</a></p>

            @if ($post->image)
               <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid d-block mt-3" />
            @else
               <img src="{{ asset('storage/post-images/no-post-image.png') }}" alt="{{ $post->category->name }}" class="img-fluid mt-3" />
               {{-- <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3" /> --}}
            @endif

            <article class="my-3">
               {!! $post->body !!}
            </article>
            <a href="/posts" class="text-decoration-none d-block mb-5">Back to blog</a>
         </div>
      </div>
   </div>
@endsection

@extends('layouts.main')

@section('content')
   <h1 class="mb-3 text-center">{{ $subMenu ? $subMenu : 'All Posts' }}</h1>

   <div class="row justify-content-center mb-3">
      <div class="col-md-6">
         <form action="/posts">
            @if (request('category'))
               <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('author'))
               <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
            <div class="input-group mb-3">
               <input type="text" class="form-control" id="inputSearch" placeholder="Search..." name="search" value="{{ request('search') }}">
               <button class="btn btn-dark" type="submit">Search</button>
            </div>
         </form>
      </div>
   </div>

   @if ($posts->count())
      <div class="card d-flex mb-5">
         @if ($posts[0]->image)
            <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid d-block justify-content-center" width="200" />
         @else
            <img src="{{ asset('storage/post-images/no-post-image.png') }}" alt="{{ $posts[0]->category->name }}" class="img-fluid" />
            {{-- <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3" /> --}}
         @endif
         <div class="card-body text-center">
            <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
            <p>
               <small>By <a href="/posts?author={{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a> in <a href="/posts?category={{ $posts[0]->category->slug }}"
                     class="text-decoration-none">{{ $posts[0]->category->name }}</a> {{ $posts[0]->created_at->diffForHumans() }}
               </small>
            </p>
            <p class="card-text">{{ $posts[0]->excerpt }}</p>

            <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read more</a>
         </div>
      </div>

      <div class="container">
         <div class="row mb-3">
            @foreach ($posts->skip(1) as $post)
               <div class="col-md-4 p-2">
                  <div class="card" style="width: 18rem;">
                     <a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none text-white">
                        <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, .7)">{{ $post->category->name }}</div>
                     </a>
                     @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid d-block mt-3" />
                     @else
                        <img src="{{ asset('storage/post-images/no-post-image.png') }}" alt="{{ $post->category->name }}" class="img-fluid mt-3" />
                        {{-- <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3" /> --}}
                     @endif
                     <div class="card-body">
                        <h5 class="card-title"><a href="/posts/{{ $post->slug }}" class="text-decoration-none">{{ $post->title }}</a></h5>
                        <p>
                           <small>By <a href="/posts?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> {{ $post->created_at->diffForHumans() }}
                           </small>
                        </p>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="/posts/{{ $post->slug }}" class="text-decoration-none btn btn-primary">Read more</a>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
   @else
      <p class="fs-4 text-center">No post found.</p>
   @endif

   <div class="d-flex justify-content-center" style="margin-bottom: 100px">{{ $posts->links() }}</div>

@endsection

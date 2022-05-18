@extends('dashboard.layouts.main')

@section('content')
   <div class="container mt-4">
      <div class="row">
         <div class="col-lg-8">
            <h2>{{ $post->title }}</h2>

            <a href="/dashboard/posts" class="btn btn-success btn-sm"><span data-feather="arrow-left"></span> Back to all my post</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning btn-sm"><span data-feather="edit"></span> Edit</a>
            <form action="/dashboard/posts/{{ $post->slug }}" class="d-inline" method="post">
               @method('delete')
               @csrf
               <button class="btn btn-danger btn-sm border-0" onclick="return confirm('Yakin hapus data ini?')"><span data-feather="x-circle"></span> Delete</button>
            </form>

            @if ($post->image)
               <div style="max-height: 350px; overflow: hidden">
                  <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid d-block mt-3" />
               </div>
            @else
               <img src="{{ asset('storage/post-images/no-post-image.png') }}" alt="{{ $post->category->name }}" class="img-fluid mt-3" />
               {{-- <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" alt="{{ $post->category->name }}" class="img-fluid mt-3" /> --}}
            @endif

            <article class="my-3">
               {!! $post->body !!}
            </article>
         </div>
      </div>
   </div>
@endsection

@extends('dashboard.layouts.main')

@section('content')
   <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
      <h1 class="h2">Create New Posts</h1>
   </div>
   <div class="col-lg-8 mb-5">
      <form method="POST" action="/dashboard/posts" enctype="multipart/form-data">
         @csrf
         <div class="mb-2">
            <label for="title" class="form-label">Post title</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" autocomplete="off" value="{{ old('title') }}" autofocus>
            @error('title')
               <small class="invalid-feedback">{{ $message }}</small>
            @enderror
         </div>
         <div class="mb-2">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" autocomplete="off" readonly value="{{ old('slug') }}">
            @error('slug')
               <small class="invalid-feedback">{{ $message }}</small>
            @enderror
         </div>
         <div class="mb-2">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id">
               @foreach ($categories as $category)
                  @if (old('category_id') == $category->id)
                     <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                  @else
                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endif
               @endforeach
            </select>
         </div>
         <div class="mb-2">
            <label for="image" class="form-label">Post Image</label>
            <img class="img-preview img-fluid col-sm-5 mb-3">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
               <small class="invalid-feedback">{{ $message }}</small>
            @enderror
         </div>
         <div class="mb-2">
            <label for="body" class="form-label">Body post</label>
            @error('body')
               <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
            <trix-editor input="body"></trix-editor>
         </div>
         <button type="submit" class="btn btn-primary">Create Post</button>
      </form>
   </div>

   <script>
      const title = document.querySelector('#title');
      const slug = document.querySelector('#slug');

      title.addEventListener('change', function() {
         fetch('/dashboard/posts/checkSlug?title=' + title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
      });

      document.addEventListener('trix-file-accept', function(e) {
         e.preventDefault()
      });

      function previewImage() {
         const image = document.querySelector('#image');
         const imgPreview = document.querySelector('.img-preview');

         imgPreview.style.display = 'block';

         const oFReader = new FileReader();
         oFReader.readAsDataURL(image.files[0]);

         oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
         }
      }
   </script>
@endsection

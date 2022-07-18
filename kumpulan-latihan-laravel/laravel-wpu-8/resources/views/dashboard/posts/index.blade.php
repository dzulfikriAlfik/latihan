@extends('dashboard.layouts.main')

@section('content')
<div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
   <h1 class="h2">My Posts</h1>
</div>
<div class="table-responsive col-lg-10">
   <a href="/dashboard/posts/create" class="btn btn-primary btn-sm mb-3">Tambah data</a>
   @if (session()->has('success'))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   @endif
   <table class="table-striped table-sm table">
      <thead>
         <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($posts as $post)
         <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td>
               <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
               <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
               <form action="/dashboard/posts/{{ $post->slug }}" class="d-inline" method="post">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Yakin hapus data ini?')"><span data-feather="x-circle"></span></button>
               </form>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@endsection

@extends('layouts.main')

@section('title', 'Posts')

@section('content')
<!-- OVERVIEW -->
<div class="panel panel-headline">
  <div class="panel-heading">
    <div class="row">
      <div class="left">
        <h2>Posts</h2>
      </div>
      <div class="right">
        <a href="{{ route('posts.add') }}" class="btn btn-primary btn-sm float-right">Tambah Berita</a>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md">
        <table class="table table-bordered table-hover table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">TITLE</th>
              <th class="text-center">USER</th>
              <th class="text-center">AKSI</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
              <td>{{$post->id}}</td>
              <td>{{$post->title}}</td>
              <td>{{$post->user->name}}</td>
              <td class="text-center">
                <a href="{{ route('site.single.post', $post->slug) }}" target="_blank"
                  class="btn btn-info btn-xs">View</a>
                <a href="/posts/{{$post->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                <a href="/posts/{{$post->id}}/delete" class="btn btn-danger btn-xs tombolDelete">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- END OVERVIEW -->
@endsection

@section('footer')
<script>
  $('.tombolDelete').click(function(e) {
    e.preventDefault();
    const href    = $(this).attr('href');

    swal({
    title: "Yakin?",
    text: "Menghapus data Post ini?",
    icon: "warning",
    buttons: true,
    dangerMode: true
    })
    .then((result) => {
      if (result) {
        window.location = href
      } else {
        // 
      }
    });
  });
</script>
@endsection
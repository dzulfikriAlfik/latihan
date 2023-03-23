@extends('layouts.main')

@section('title', 'Posts')

@section('header')
<style>
  .ck-editor__editable {
    min-height: 300px;
  }
</style>
@endsection

@section('content')
<!-- OVERVIEW -->
<div class="panel panel-headline">
  <div class="panel-heading">
    <div class="row">
      <div class="text-center">
        <h2>Edit Berita {{ $post->title }}</h2>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <form action="/posts/{{ $post->id }}/update" method="POST" enctype="multipart/form-data">
        <div class="col-md-8">
          {{-- Form --}}
          {{csrf_field()}}
          <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
            <label for="title">Judul Berita</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Masukan Judul Berita"
              value="{{$post->title}}">
            @if ($errors->has('title'))
            <span class="help-block">{{$errors->first('title')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('content') ? 'has-error' : ''}}">
            <label for="content">Isi konten</label>
            <textarea name="content" id="content" rows="6" class="form-control">{!!$post->content!!}</textarea>
            @if ($errors->has('content'))
            <span class="help-block">{{$errors->first('content')}}</span>
            @endif
          </div>
        </div>
        <div class="col-md-4">
          {{-- Thumbnail --}}
          <div class="input-group">
            <span class="input-group-btn">
              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                <i class="fa fa-picture-o"></i> Choose
              </a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="thumbnail">
          </div>
          <img id="holder" style="margin-top:15px;max-height:100px;">
          <div class="input-group">
            <input type="submit" value="submit" class="btn btn-info">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END OVERVIEW -->
@endsection

@section('footer')
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
  ClassicEditor
  .create( document.querySelector( '#content' ) )
  .catch( error => {
      console.error( error );
  } );

  $(document).ready(function() {
    $('#lfm').filemanager('image');
  });
</script>
@endsection
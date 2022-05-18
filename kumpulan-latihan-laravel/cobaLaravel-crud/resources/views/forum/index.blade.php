@extends('layouts.main')

@section('title', 'Forum')

@section('content')
<!-- OVERVIEW -->
<div class="panel panel-headline">
  <div class="panel-heading">
    <div class="row">
      <div class="left">
        <h2>Forum</h2>
      </div>
      <div class="right">
        <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addForum">Tambah Forum</a>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md" style="margin-left: 20px">
        <ul class="list-unstyled activity-list">
          @foreach ($forums as $forum)
          <li>
            <img src="{{ $forum->user->siswa->getAvatar() }}" alt="Avatar" class="img-circle pull-left avatar">
            <p>
              <a href="/forum/{{ $forum->id }}/view">{{ $forum->user->siswa->nama_lengkap() }}</a> : {{ $forum->judul }}
              <span class="timestamp">{{ $forum->created_at->diffForHumans() }}</span>
            </p>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- END OVERVIEW -->

<div class="modal fade" id="addForum" tabindex="-1" role="dialog" aria-labelledby="addForumLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addForumLabel">Tambah Forum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/forum/create" method="POST">
          {{csrf_field()}}
          <div class="form-group {{$errors->has('judul') ? 'has-error' : ''}}">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" id="judul" placeholder="Judul"
              value="{{old('judul')}}">
            @if ($errors->has('judul'))
            <span class="help-block">{{$errors->first('judul')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('konten') ? 'has-error' : ''}}">
            <label for="konten">Isi konten</label>
            <textarea name="konten" id="konten" rows="6" class="form-control">{{old('konten')}}</textarea>
            @if ($errors->has('konten'))
            <span class="help-block">{{$errors->first('konten')}}</span>
            @endif
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" value="Submit" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('footer')
<script>
  // Modal Siswa
  @if (count($errors) > 0)
    $('#siswaModal').modal('show');
  @endif
  // TombolDelete
  $('.tombolDelete').click(function(e) {
    e.preventDefault();
    const href       = $(this).attr('href');
    const siswa_nama = $(this).attr('siswa_nama');
    const siswa_id   = $(this).attr('siswa_id');

    swal({
    title: "Yakin?",
    text: "Menghapus data " + siswa_nama + "?",
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
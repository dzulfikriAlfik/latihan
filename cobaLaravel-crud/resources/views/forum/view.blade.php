@extends('layouts.main')

@section('title', 'Detail Forum')

@section('content')
<div class="panel panel-headline">
  <div class="panel-heading">
    <h3 class="panel-title">{{ $forum->judul }}</h3>
    <p class="panel-subtitle">{{ $forum->created_at->diffForHumans() }}</p>
    <div class="right">
      <a href="/forum" class="btn btn-warning btn-xs">Kembali</a>
    </div>
  </div>
  <div class="panel-body">
    {{ $forum->konten }}
    <hr>
    <div class="btn-group" style="margin-bottom: 20px">
      <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-up"></i> Suka</button>
      <button class="btn btn-default btn-xs" id="btnKomentarUtama"><i class="fa fa-comment"></i> Komentar</button>
    </div>
    <form action="" method="post" id="komentarUtama" style="display: none">
      @csrf
      <input type="hidden" name="forum_id" value="{{ $forum->id }}">
      <input type="hidden" name="parent" value="0">
      <textarea name="konten" class="form-control" style="margin-bottom: 20px" rows="3"></textarea>
      <input type="submit" class="btn btn-primary btn-sm" value="Kirim">
    </form>
    <p style="margin-top: 20px; margin-bottom: 0"><b>Komentar :</b></p>
    @foreach ($forum->komentar()->where('parent', 0)->orderBy('created_at', 'desc')->get() as $komentar)
    <ul class="list-unstyled activity-list">
      <li>
        <img src="{{ $komentar->user->siswa->getAvatar() }}" alt="Avatar" class="img-circle pull-left avatar">
        <p>
          <a href="#">{{ $komentar->user->siswa->nama_lengkap() }}</a> <br> {{ $komentar->konten }}
          <span class="timestamp">{{ $komentar->created_at->diffForHumans() }}</span>
        </p>
        <form action="" method="post" style="padding-left: 50px;">
          @csrf
          <input type="hidden" name="forum_id" value="{{ $forum->id }}">
          <input type="hidden" name="parent" value="{{ $komentar->id }}">
          <input type="text" name="konten" class="form-control" style="margin: 10px 0" placeholder="Komentari ...">
          <input type="submit" class="btn btn-primary btn-xs" value="Kirim">
        </form>
        @foreach ($komentar->childs as $child)
        <p style="margin: 20px 0">
          <a href="#">{{ $child->user->siswa->nama_lengkap() }}</a> {{ $child->konten }}
          <span class="timestamp">{{ $child->created_at->diffForHumans() }}</span>
        </p>
        @endforeach
      </li>
    </ul>
    @endforeach
  </div>
</div>
@endsection

@section('footer')
<script>
  $(document).ready(function () {
    $('#btnKomentarUtama').click(function() {
      $('#komentarUtama').toggle('slide');
    });
  });
</script>
@endsection
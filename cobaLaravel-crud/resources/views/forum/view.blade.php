@extends('layouts.main')

@section('title', 'Detail Forum')

@section('content')
<div class="panel panel-headline">
  <div class="panel-heading">
    <h3 class="panel-title">{{ $forum->judul }}</h3>
    <p class="panel-subtitle">{{ $forum->created_at->diffForHumans() }}</p>
    <div class="right">
      <a href="{{ url()->previous() }}" class="btn btn-warning btn-xs">Kembali</a>
    </div>
  </div>
  <div class="panel-body">
    {{ $forum->konten }}
    <hr>
    <p><b>Komentar :</b></p>
    <ul class="list-unstyled activity-list">
      <li>
        <img src="{{ $forum->user->siswa->getAvatar() }}" alt="Avatar" class="img-circle pull-left avatar">
        <p>
          <a href="/forum/{{ $forum->id }}/view">{{ $forum->user->siswa->nama_lengkap() }}</a> : {{ $forum->judul }}
          <span class="timestamp">{{ $forum->created_at->diffForHumans() }}</span>
        </p>
      </li>
    </ul>
  </div>
</div>
@endsection
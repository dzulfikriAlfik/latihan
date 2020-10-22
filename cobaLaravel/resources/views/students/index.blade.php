@extends('layout.main')

@section('title', 'Daftar Mahasiswa')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Daftar Mahasiswa</h1>

            <a href="/students/create" class="btn btn-primary my-3">Tambah</a>

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            {{-- list Students --}}
            <ul class="list-group">
                @foreach ($students as $student)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $student->nama }}
                    <a href="/students/{{ $student->id }}" class="badge badge-info badge-pill">detail</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
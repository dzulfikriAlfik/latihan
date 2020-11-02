@extends('layout.main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-6">
  <div class="panel">
    <div class="panel-heading">
      <h3 class="panel-title">Ranking 3 besar</h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-center">Ranking</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Nilai</th>
          </tr>
        </thead>
        <tbody>
          @foreach (ranking3Besar() as $value)
          <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{$value->nama_lengkap()}}</td>
            <td class="text-center">{{$value->raportnilai}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="panel">
    <div class="panel-body">
      <div class="col-md-6">
        <div class="metric">
          <span class="icon"><i class="fa fa-download"></i></span>
          <p>
            <span class="number">{{totalSiswa()}}</span>
            <span class="title">Total Siswa</span>
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="metric">
          <span class="icon"><i class="fa fa-download"></i></span>
          <p>
            <span class="number">{{totalGuru()}}</span>
            <span class="title">Total Guru</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
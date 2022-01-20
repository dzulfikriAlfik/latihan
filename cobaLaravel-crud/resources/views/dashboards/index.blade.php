@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
{{-- Statistik --}}
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-headline">
      <div class="panel-heading">
        <div class="row">
          <h2 class="panel-title text-center">Statistik Sekolah</h2>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-4">
            <div class="metric">
              <span class="icon"><i class="fa fa-child"></i></span>
              <p>
                <span class="number">{{totalSiswa()}}</span>
                <span class="title">Total Siswa</span>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="metric">
              <span class="icon"><i class="fa fa-users"></i></span>
              <p>
                <span class="number">{{totalGuru()}}</span>
                <span class="title">Total Guru</span>
              </p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="metric">
              <span class="icon"><i class="fa fa-book"></i></span>
              <p>
                <span class="number">{{totalMapel()}}</span>
                <span class="title">Total Mata Pelajaran</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Statistik --}}

{{-- Ranking 5 Besar --}}
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-headline">
      <div class="panel-heading">
        <div class="row">
          <h2 class="panel-title text-center">Ranking 5 Besar</h2>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md">
            <table class="table table-bordered table-hover table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>RANKING</th>
                  <th>NAMA</th>
                  <th>NILAI</th>
                </tr>
              </thead>
              <tbody>
                @foreach (getRanking5Besar() as $value)
                <tr>
                  <td class="col-md-2">{{$loop->iteration}}</td>
                  <td class="col-md-8">{{$value->nama_lengkap()}}</td>
                  <td class="col-md-2">{{$value->rataNilai}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Ranking 5 Besar --}}
@endsection
@extends('layouts.main')

@section('title', 'Profile Siswa')

@section('header')
<style>
  .profile {
    width: 100px;
    height: 100px
  }

  .tinggi {
    height: 500px
  }
</style>
@endsection

@section('content')
<div class="panel panel-profile tinggi">
  <div class="clearfix">
    <!-- LEFT COLUMN -->
    <div class="profile-left">
      <!-- PROFILE HEADER -->
      <div class="profile-header">
        <div class="overlay"></div>
        <div class="profile-main">
          <img src="{{$siswa->getAvatar()}}" class="img-circle profile" alt="Avatar">
          <h3 class="name">{{$siswa->nama_lengkap()}}</h3>
        </div>
        <div class="profile-stat">
          <div class="row">
            <div class="col-md-6 stat-item">
              {{$siswa->mapel->count()}} <span>Pelajaran</span>
            </div>
            <div class="col-md-6 stat-item">
              {{$siswa->rataNilai()}} <span>Rata-rata Nilai</span>
            </div>
          </div>
        </div>
      </div>
      <!-- END PROFILE HEADER -->
      <!-- PROFILE DETAIL -->
      <div class="profile-detail">
        <div class="profile-info">
          <h4 class="heading">Profile Singkat</h4>
          <ul class="list-unstyled list-justify">
            <li>Nama Lengkap <span>{{$siswa->nama_lengkap()}}</span></li>
            <li>Jenis Kelamin <span>{{$siswa->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki'}}</span>
            </li>
            <li>Agama <span>{{$siswa->agama}}</span></li>
            <li>Alamat <span>{{$siswa->alamat}}</span></li>
          </ul>
        </div>
      </div>
      <!-- END PROFILE DETAIL -->
    </div>
    <!-- END LEFT COLUMN -->
    <!-- RIGHT COLUMN -->
    <div class="profile-right">
      <h4 class="heading">Daftar Mata Pelajaran</h4>
      <!-- TABBED CONTENT -->
      <div class="tab-content">
        <div class="panel">
          <div class="panel-body">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>KODE</th>
                  <th>MATA PELAJARAN</th>
                  <th>SEMESTER</th>
                  <th>NILAI</th>
                  <th>GURU</th>
                </tr>
              </thead>
              <tbody>
                @if ($siswa->mapel->count() > 0)
                @foreach ($siswa->mapel as $mapel)
                <tr>
                  <td>{{$mapel->kode}}</td>
                  <td>{{$mapel->nama}}</td>
                  <td>{{$mapel->semester}}</td>
                  <td>{{$mapel->pivot->nilai}}</td>
                  <td>{{$mapel->guru->nama}}</td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="5" class="text-center">~ Tidak ada data ~</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- END TABBED CONTENT -->
      {{-- Highchart --}}
      <div class="tab-content">
        <div class="panel">
          <div class="panel-heading">
            <div id="chartSiswa"></div>
          </div>
        </div>
      </div>
      {{-- End Highchart --}}
    </div>
    <!-- END RIGHT COLUMN -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addNilai" tabindex="-1" role="dialog" aria-labelledby="addNilaiLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNilaiLabel">Tambah Nilai Mata Pelajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- Tambah Nilai Mata Pelajaran --}}
        <form action="/siswa/{{$siswa->id}}/addnilai" method="POST">
          {{csrf_field()}}
          <div class="form-group {{$errors->has('mapel') ? 'has-error' : ''}}">
            <label for="mapel">Mata Pelajaran</label>
            <select class="form-control" name="mapel" id="mapel">
              {{-- @foreach($mpel as $matapel)
              <option value="{{$matapel->id}}">{{$matapel->nama}}</option>
              @endforeach --}}
            </select>
            @if ($errors->has('mapel'))
            <span class="help-block">{{$errors->first('mapel')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('nilai') ? 'has-error' : ''}}">
            <label for="nilai">Nilai</label>
            <input type="text" name="nilai" class="form-control" id="nilai" placeholder="Nilai"
              value="{{old('nilai')}}">
            @if ($errors->has('nilai'))
            <span class="help-block">{{$errors->first('nilai')}}</span>
            @endif
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>

</script>
@endsection
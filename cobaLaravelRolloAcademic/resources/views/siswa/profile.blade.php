@extends('layout.main')

@section('title', 'Profile Siswa')

@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
  rel="stylesheet" />
@endsection

@section('content')
<div class=" panel panel-profile">
  <div class="clearfix">
    <!-- LEFT COLUMN -->
    <div class="profile-left">
      <!-- PROFILE HEADER -->
      <div class="profile-header">
        <div class="overlay"></div>
        <div class="profile-main">
          <img src="{{$siswa->getAvatar()}}" class="img-circle" alt="Avatar" style="width: 100px">
          <h3 class="name">{{$siswa->nama_lengkap()}}</h3>
          <span class="online-status status-available">Available</span>
        </div>
        <div class="profile-stat">
          <div class="row">
            <div class="col-xs-4 stat-item">
              {{$siswa->mapel->count()}} <span>Mata Pelajaran</span>
            </div>
            <div class="col-xs-4 stat-item">
              {{$siswa->raportnilai()}} <span>Rata-rata Nilai</span>
            </div>
            <div class="col-xs-4 stat-item">
              2174 <span>Points</span>
            </div>
          </div>
        </div>
      </div>
      <!-- END PROFILE HEADER -->
      <!-- PROFILE DETAIL -->
      <div class="profile-detail">
        <div class="profile-info">
          <h4 class="heading">Data Diri</h4>
          <ul class="list-unstyled list-justify">
            <li>Jenis Kelamin <span>{{$siswa->jenis_kelamin}}</span></li>
            <li>Agama <span>{{$siswa->agama}}</span></li>
            <li>Alamat <span>{{$siswa->alamat}}</span></li>
          </ul>
        </div>
        <div class="text-center">
          <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-primary">Edit Profile</a>
          <a href="/siswa" class="btn btn-warning">Kembali</a>
        </div>
      </div>
      <!-- END PROFILE DETAIL -->
    </div>
    <!-- END LEFT COLUMN -->
    <!-- RIGHT COLUMN -->
    <div class="profile-right">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNilai">Tambah
        Pelajaran
      </button>
      <div class="panel">
        <div class="panel-heading">
          <h3 class="panel-title">Mata Pelajaran</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Mata Pelajaran</th>
                <th>Semseter</th>
                <th>Nilai</th>
                <th>Guru</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @if ($siswa->mapel->count() > 0)
              @foreach ($siswa->mapel as $mapel)
              <tr>
                <td>{{$mapel->kode}}</td>
                <td>{{$mapel->nama_mapel}}</td>
                <td>{{$mapel->semester}}</td>
                <td>
                  <a href="#" class="nilai" data-type="text" data-pk="{{$mapel->id}}"
                    data-url="/api/siswa/{{$siswa->id}}/editnilai" data-title="Masukan Nilai">{{$mapel->pivot->nilai}}
                  </a>
                </td>
                <td><a href="/guru/{{$mapel->guru_id}}/profile">{{$mapel->guru->nama_guru}}</a></td>
                <td>
                  <a href="/siswa/{{$siswa->id}}/{{$mapel->id}}/deletenilai" onclick="return confirm('Yakin?')"
                    class="btn btn-danger btn-xs">delete</a>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="4" class="text-center">~ Tidak ada data ~</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <!-- END TABBED CONTENT -->
      <div class="panel">
        <div id="chartNilai"></div>
      </div>
    </div>
    <!-- END RIGHT COLUMN -->
  </div>
</div>

{{-- Modal Tambah Data Pelajaran --}}
<div class="modal fade float-right" id="addNilai" tabindex="-1" role="dialog" aria-labelledby="addNilaiLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNilaiLabel">Tambah Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/siswa/{{$siswa->id}}/addnilai">
          {{csrf_field()}}
          <div class="form-group {{$errors->has('mapel') ? 'has-error' : ''}}">
            <label for="mapel">Mata Pelajaran</label>
            <select class="form-control" name="mapel" id="mapel">
              @foreach ($matapel as $mp)
              <option value="{{$mp->id}}">{{$mp->nama_mapel}}</option>
              @endforeach
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
        <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
@stop


@section('footer')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js">
</script>
{{-- <script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> --}}
<script>
  // Highchars
  Highcharts.chart('chartNilai', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Laporan Nilai Siswa'
  },
  xAxis: {
    categories: {!!json_encode($categories)!!},
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Nilai'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [{
    name: 'Nilai',
    data: {!!json_encode($data)!!}
  }]
});
  // EndHighchars

// Show Modal error validation
  @if (count($errors) > 0)
  $('#addNilai').modal('show');
  @endif
// EndShow Modal error validation

// Xeditable
$(document).ready(function() {
  $('.nilai').editable();
});
// End Xeditable
</script>
@stop
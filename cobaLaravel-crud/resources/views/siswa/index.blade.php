@extends('layouts.main')

@section('title', 'Daftar Siswa')

@section('header')
<style>
  table.dataTable th,
  table.dataTable td {
    white-space: nowrap;
  }
</style>
@endsection

@section('content')
<!-- OVERVIEW -->
<div class="panel panel-headline">
  <div class="panel-heading">
    <div class="row">
      <div class="left">
        <h2>Daftar Siswa</h2>
      </div>
      <div class="right">
        <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#importSiswa">
          Import XLS
        </a>
        <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#siswaModal">
          Tambah Siswa
        </a>
        <a href="/siswa/exportExcel" class="btn btn-success btn-sm float-right">
          Export Excel
        </a>
        <a href="/siswa/exportPdf" target="_blank" class="btn btn-default btn-sm float-right">
          Export PDF
        </a>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md">
        <table class="table table-striped table-hover table-bordered table-responsive" cellspacing="0" width="100%"
          id="dataSiswaTable">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">NAMA</th>
              <th class="text-center">JENIS KELAMIN</th>
              <th class="text-center">AGAMA</th>
              <th class="text-center">ALAMAT</th>
              <th class="text-center">RATA NILAI</th>
              <th class="text-center">AKSI</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- END OVERVIEW -->

<!-- Siswa Modal -->
<div class="modal fade" id="siswaModal" tabindex="-1" role="dialog" aria-labelledby="siswaModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="siswaModalLabel">Form Tambah Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- Form Tambah Siswa --}}
        <form action="/siswa/create" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group {{$errors->has('nama_depan') ? 'has-error' : ''}}">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" name="nama_depan" class="form-control" id="nama_depan" placeholder="Nama Depan"
              value="{{old('nama_depan')}}">
            @if ($errors->has('nama_depan'))
            <span class="help-block">{{$errors->first('nama_depan')}}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" name="nama_belakang" class="form-control" id="nama_belakang" placeholder="Nama Belakang"
              value="{{old('nama_belakang')}}">
          </div>
          <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email"
              value="{{old('email')}}">
            @if ($errors->has('email'))
            <span class="help-block">{{$errors->first('email')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('jenis_kelamin') ? 'has-error' : ''}}">
            <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
              <option value="L" {{old('jenis_kelamin') == 'L' ? 'selected' : ''}}>Laki-laki</option>
              <option value="P" {{old('jenis_kelamin') == 'P' ? 'selected' : ''}}>Perempuan</option>
            </select>
            @if ($errors->has('jenis_kelamin'))
            <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('agama') ? 'has-error' : ''}}">
            <label for="agama">Agama</label>
            <input type="text" name="agama" class="form-control" id="agama" placeholder="Agama"
              value="{{old('agama')}}">
            @if ($errors->has('agama'))
            <span class="help-block">{{$errors->first('agama')}}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" class="form-control">{{old('alamat')}}</textarea>
          </div>
          <div class="form-group {{$errors->has('avatar') ? 'has-error' : ''}}">
            <label for="avatar">Avatar</label>
            <input type="file" name="avatar" class="form-control" id="avatar">
            @if ($errors->has('avatar'))
            <span class="help-block">{{$errors->first('avatar')}}</span>
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
{{-- Import Modal --}}
<div class="modal fade" id="importSiswa" tabindex="-1" role="dialog" aria-labelledby="importSiswaLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importSiswaLabel">Import </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'siswa.import', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data'])
        !!}

        {!! Form::file('data_siswa') !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" value="Import" class="btn btn-primary">
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  $(document).ready(function () {
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
  // DataTable
    $('#dataSiswaTable').DataTable({
      processing: true,
      serverside: true,
      responsive: true,
      bAutowidth: false,
      ajax: "{{ route('ajax.get.data.siswa') }}",
      columns: [
        { data: null,sortable: true, 
        render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
                }  
        },
        {data: 'nama_lengkap', name: 'nama_lengkap'},
        {data: 'jenis_kelamin', name: 'jenis_kelamin'},
        {data: 'agama', name: 'agama'},
        {data: 'alamat', name: 'alamat'},
        {data: 'rataNilai', name: 'rataNilai'},
        {data: 'aksi', name: 'aksi', sortable:false},
      ]
    });
  });
</script>
@endsection
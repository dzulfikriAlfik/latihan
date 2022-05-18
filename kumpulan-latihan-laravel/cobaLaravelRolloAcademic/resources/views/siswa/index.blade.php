@extends('layout.main')

@section('title', 'Daftar Siswa')

@section('content')
<div class="row">
  <div class="col-md-12">
    <!-- BASIC TABLE -->
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Daftar Siswa</h3>
        <div class="right">
          <a href="/siswa/exportExcel" class="btn btn-success btn-xs page-title">
            Export Excel
          </a>
          <a href="/siswa/exportPdf" class="btn btn-default btn-xs page-title">
            Export PDF
          </a>
          <a class="btn btn-primary btn-xs page-title" data-toggle="modal" data-target="#addSiswa">
            Tambah Data
          </a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr class="text-center">
              <th>#</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Agama</th>
              <th>Alamat</th>
              <th>Rata-rata Nilai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data_siswa as $siswa)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td><a href="/siswa/{{$siswa->id}}/profile">{{ $siswa->nama_lengkap() }}</a></td>
              <td>{{ $siswa->jenis_kelamin }}</td>
              <td>{{ $siswa->agama }}</td>
              <td>{{ $siswa->alamat }}</td>
              <td>{{ $siswa->raportnilai() }}</td>
              <td class="text-center">
                <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning btn-sm">edit</a>
                <a href="#" class="btn btn-danger btn-sm tombolDelete" siswa_id="{{$siswa->id}}"
                  siswa_nama="{{$siswa->nama_lengkap()}}">delete</a>
              </td>
            </tr>
            @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Modal Tambah Data Siswa --}}
<div class="modal fade float-right" id="addSiswa" tabindex="-1" role="dialog" aria-labelledby="addSiswaLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSiswaLabel">Form Tambah Data Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/siswa/create" enctype="multipart/form-data">
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
              <option value="Laki-laki" {{old('jenis_kelamin') == 'Laki-laki' ? 'selected' : ''}}>Laki-laki</option>
              <option value="Perempuan" {{old('jenis_kelamin') == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
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
        <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script>
  @if (count($errors) > 0)
  $('#addSiswa').modal('show');
  @endif

  $('.tombolDelete').click(function() {
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
        window.location = "/siswa/" + siswa_id + "/delete"
        // swal({
        //   title: "Data " + siswa_nama,
        //   text: "berhasi dihapus!",
        //   buttons: false,
        //   icon: "success",
        //   timer: 1500,
        //   footer: "Aplikasi Pengelolaan Siswa"
        // });
      } else {
        // 
      }
    });
  });

</script>
@endsection
@extends('layouts.main')

@section('title', 'Daftar Guru')

@section('content')
<!-- OVERVIEW -->
<div class="panel panel-headline">
  <div class="panel-heading">
    <div class="row">
      <div class="left">
        <h2>Daftar Guru</h2>
      </div>
      <div class="right">
        <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#guruModal">
          Tambah Guru
        </a>
        <a href="/guru/exportExcel" class="btn btn-success btn-sm float-right">
          Export Excel
        </a>
        <a href="/guru/exportPdf" target="_blank" class="btn btn-default btn-sm float-right">
          Export PDF
        </a>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md">
        <table class="table table-bordered table-hover table-striped">
          <thead class="thead-dark">
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">NAMA GURU</th>
              <th class="text-center">NO. TELPON</th>
              <th class="text-center">ALAMAT</th>
              <th class="text-center">AKSI</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data_guru as $guru)
            <tr>
              <td class="text-center">{{$loop->iteration}}</td>
              <td><a href="/guru/{{$guru->id}}/profile">{{$guru->nama}}</a></td>
              <td>{{$guru->telpon}}</td>
              <td>{{$guru->alamat}}</td>
              <td class="text-center">
                <a href="/guru/{{$guru->id}}/edit" class="btn btn-warning btn-xs">Edit</a>
                <a href="/guru/{{$guru->id}}/delete" class="btn btn-danger btn-xs tombolDelete" guru_id="{{$guru->id}}"
                  guru_nama="{{$guru->nama}}">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- END OVERVIEW -->

<!-- Modal -->
<div class="modal fade" id="guruModal" tabindex="-1" role="dialog" aria-labelledby="guruModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="guruModalLabel">Form Tambah Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- Form Tambah Guru --}}
        <form action="/guru/create" method="POST">
          {{csrf_field()}}
          <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
            <label for="nama">Nama Guru</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Guru"
              value="{{old('nama')}}">
            @if ($errors->has('nama'))
            <span class="help-block">{{$errors->first('nama')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('telpon') ? 'has-error' : ''}}">
            <label for="telpon">No. Telpon</label>
            <input type="text" name="telpon" class="form-control" id="telpon" placeholder="Masukan No. Telpon"
              value="{{old('telpon')}}">
            @if ($errors->has('telpon'))
            <span class="help-block">{{$errors->first('telpon')}}</span>
            @endif
          </div>
          <div class="form-group {{$errors->has('alamat') ? 'has-error' : ''}}">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" class="form-control">{{old('alamat')}}</textarea>
            @if ($errors->has('alamat'))
            <span class="help-block">{{$errors->first('alamat')}}</span>
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
  @if (count($errors) > 0)
  $('#guruModal').modal('show');
  @endif

  $('.tombolDelete').click(function(e) {
    e.preventDefault();
    const href      = $(this).attr('href');
    const guru_nama = $(this).attr('guru_nama');
    const guru_id   = $(this).attr('guru_id');

    swal({
    title: "Yakin?",
    text: "Menghapus data " + guru_nama + "?",
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
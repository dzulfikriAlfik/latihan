<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <h1>Edit Siswa {{$siswa->nama_depan . ' ' . $siswa->nama_belakang}}</h1>
        </div>

        <form action="/siswa/{{$siswa->id}}/update" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label for="nama_depan">Nama Depan</label>
                <input type="text" name="nama_depan" class="form-control" id="nama_depan"
                    placeholder="Masukan Nama Depan" value="{{$siswa->nama_depan}}">
            </div>
            <div class="form-group">
                <label for="nama_belakang">Nama Belakang</label>
                <input type="text" name="nama_belakang" class="form-control" id="nama_belakang"
                    placeholder="Masukan Nama Belakang" value="{{$siswa->nama_belakang}}">
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    <option value="L" {{$siswa->jenis_kelamin == 'L' ? 'selected' : ''}}>Laki-laki</option>
                    <option value="P" {{$siswa->jenis_kelamin == 'P' ? 'selected' : ''}}>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="agama">Agama</label>
                <input type="text" name="agama" class="form-control" id="agama" placeholder="Agama"
                    value="{{$siswa->agama}}">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="aalamat" rows="3" class="form-control">{{$siswa->alamat}}</textarea>
            </div>
            <a href="{{url()->previous()}}" class="btn btn-warning">Back</a>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
    </div>

    {{-- Script --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
<table class="table" style="border: 1px solid black">
  <thead>
    <tr>
      <th style="border: 1px solid black">NAMA LENGKAP</th>
      <th style="border: 1px solid black">JENIS KELAMIN</th>
      <th style="border: 1px solid black">AGAMA</th>
      <th style="border: 1px solid black">RATA-RATA NILAI</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($siswa as $value)
    <tr>
      <td style="border: 1px solid black">{{$value->nama_lengkap()}}</td>
      <td style="border: 1px solid black">{{$value->jenis_kelamin}}</td>
      <td style="border: 1px solid black">{{$value->agama}}</td>
      <td style="border: 1px solid black">{{$value->raportnilai()}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
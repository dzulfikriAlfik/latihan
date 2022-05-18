<table class="table" style="border: 1px solid #ddd">
  <thead>
    <tr>
      <th style="border: 1px solid #ddd; text-align: center;">NAMA LENGKAP</th>
      <th style="border: 1px solid #ddd; text-align: center;">JENIS KELAMIN</th>
      <th style="border: 1px solid #ddd; text-align: center;">AGAMA</th>
      <th style="border: 1px solid #ddd; text-align: center;">RATA-RATA NILAI</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($siswa as $value)
    <tr>
      <td style="border: 1px solid #ddd;">{{$value->nama_lengkap()}}</td>
      <td style="border: 1px solid #ddd; text-align: center;">{{$value->getJenisKelamin()}}</td>
      <td style="border: 1px solid #ddd; text-align: center;">{{$value->agama}}</td>
      <td style="border: 1px solid #ddd; text-align: center;">{{$value->rataNilai()}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<table class="table" style="border: 1px solid #ddd">
  <thead>
    <tr>
      <th style="border: 1px solid #ddd; text-align: center;">KODE MATA PELAJARAN</th>
      <th style="border: 1px solid #ddd; text-align: center;">NAMA MATA PELAJARAN</th>
      <th style="border: 1px solid #ddd; text-align: center;">SEMESTER</th>
      <th style="border: 1px solid #ddd; text-align: center;">GURU PENGAJAR</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($mapel as $value)
    <tr>
      <td style="border: 1px solid #ddd; text-align: center;">{{$value->kode}}</td>
      <td style="border: 1px solid #ddd;">{{$value->nama}}</td>
      <td style="border: 1px solid #ddd; text-align: center;">{{$value->semester}}</td>
      <td style="border: 1px solid #ddd;">{{$value->guru->nama}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
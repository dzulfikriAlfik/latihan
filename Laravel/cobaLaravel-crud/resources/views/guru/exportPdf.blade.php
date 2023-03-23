<table class="table" style="border: 1px solid #ddd">
  <thead>
    <tr>
      <th style="border: 1px solid #ddd; text-align: center;">NAMA GURU</th>
      <th style="border: 1px solid #ddd; text-align: center;">NO. TELPON</th>
      <th style="border: 1px solid #ddd; text-align: center;">ALAMAT</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($guru as $value)
    <tr>
      <td style="border: 1px solid #ddd;">{{$value->nama}}</td>
      <td style="border: 1px solid #ddd; text-align: center;">{{$value->telpon}}</td>
      <td style="border: 1px solid #ddd;">{{$value->alamat}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
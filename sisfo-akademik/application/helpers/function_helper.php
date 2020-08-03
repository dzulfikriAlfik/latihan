<?php

function skorNilai($nilai, $sks)
{
   if ($nilai == 'A' || $nilai == 'a') $skor = 4 * $sks;
   else if ($nilai == 'B' || $nilai == 'b') $skor = 3 * $sks;
   else if ($nilai == 'C' || $nilai == 'c') $skor = 2 * $sks;
   else if ($nilai == 'D' || $nilai == 'd') $skor = 1 * $sks;
   else $skor = 0;

   return $skor;
}

function cekNilai($nim, $kode, $nilKhs)
{
   $nilai = get_instance();
   $nilai->load->model('transkrip_model');

   $nilai->db->select('*');
   $nilai->db->from('transkrip_nilai');
   $nilai->db->where('nim', $nim);
   $nilai->db->where('kode_matakuliah', $kode);
   $query = $nilai->db->get()->row();

   if ($query != null) {
      if ($nilKhs < $query->nilai) {
         $nilai->db->set('nilai', $nilKhs)
            ->where('nim', $nim)
            ->where('kode_matakuliah', $kode)
            ->update('transkrip_nilai');
      }
   } else {
      $data = [
         'nim'             => $nim,
         'nilai'           => $nilKhs,
         'kode_matakuliah' => $kode
      ];

      $nilai->transkrip_model->insert($data);
   }
}

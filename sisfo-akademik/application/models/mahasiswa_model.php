<?php

class Mahasiswa_model extends CI_Model
{

   public function tampil_data($table)
   {
      return $this->db->get($table);
   }

   public function ambil_id_mahasiswa($id)
   {
      $result = $this->db->where('id_mahasiswa', $id)->get('mahasiswa');

      if ($result->num_rows() > 0) {
         return $result->result();
      } else {
         return false;
      }
   }
}

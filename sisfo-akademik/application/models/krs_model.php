<?php

class Krs_model extends CI_Model
{

   public function tampil_data($table)
   {
      return $this->db->get($table);
   }

   public $table  = 'krs';
   public $id     = 'id_krs';

   public function insert($data)
   {
      $this->db->insert($this->table, $data);
   }

   public function update_data($where, $data, $table)
   {
      $this->db->where($where);
      $this->db->update($table, $data);
   }

   public function hapus_data($where, $table)
   {
      $this->db->where($where);
      $this->db->delete($table);
   }
}

<?php

class Tahunakademik_model extends CI_Model
{

   public function tampil_data($table)
   {
      return $this->db->get($table);
   }

   public function input_data($data, $table)
   {
      $this->db->insert($table, $data);
   }
}

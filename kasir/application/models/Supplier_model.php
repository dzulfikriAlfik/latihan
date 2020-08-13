<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{

   public function get($id = null)
   {
      $this->db->from('supplier');
      if ($id != null) {
         $this->db->where('supplier_id', $id);
      }
      return $this->db->get();
   }

   public function delete($where, $table)
   {
      $this->db->where($where);
      $this->db->delete($table);
   }
}

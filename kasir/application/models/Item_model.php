<?php
defined('BASEPATH') or exit('No direct script access allowed');

class item_model extends CI_Model
{

   public function get($id = null)
   {
      $this->db->from('p_item');
      if ($id != null) {
         $this->db->where('item_id', $id);
      }
      return $this->db->get();
   }

   public function add($post)
   {
      $params = [
         'barcode'      => $post['barcode'],
         'name'         => $post['product_name'],
         'category_id'  => $post['category'],
         'unit_id'      => $post['unit'],
         'price'        => $post['price'],
      ];
      $this->db->insert('p_item', $params);
   }

   public function edit($post)
   {
      $params = [
         'barcode'      => $post['barcode'],
         'name'         => $post['product_name'],
         'category_id'  => $post['category'],
         'unit_id'      => $post['unit'],
         'price'        => $post['price'],
         'updated'      => date('Y-m-d H:i:s')
      ];
      $this->db->where('item_id', $post['item_id']);
      $this->db->update('p_item', $params);
   }

   public function delete($where, $table)
   {
      $this->db->where($where);
      $this->db->delete($table);
   }
}

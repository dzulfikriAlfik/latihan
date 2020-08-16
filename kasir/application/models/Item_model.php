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
         'image'        => $post['image'],
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
      if ($post['image'] != null) {
         $params['image'] = $post['image'];
      }

      $this->db->where('item_id', $post['item_id']);
      $this->db->update('p_item', $params);
   }

   public function check_barcode($code, $id = null)
   {
      $this->db->from('p_item');
      $this->db->where('barcode', $code);
      if ($id != null) {
         $this->db->where('item_id !=', $id);
      }
      $query = $this->db->get();
      return $query;
   }

   public function delete($where, $table)
   {
      $this->db->where($where);
      $this->db->delete($table);
   }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_model extends CI_Model
{

   public function get($id = null)
   {
      $this->db->from('t_stock');
      if ($id != null) {
         $this->db->where('stock_id', $id);
      }
      return $this->db->get();
   }

   public function add_stock_in($post)
   {
      $params = [
         'item_id'      => $post['item_id'],
         'type'         => 'in',
         'detail'       => $post['detail'],
         'supplier_id'  => $post['supplier'] == '' ? null : $post['supplier'],
         'qty'          => $post['qty'],
         'date'         => $post['date'],
         'user_id'      => $this->session->userdata('userid')
      ];
      $this->db->insert('t_stock', $params);
   }
}

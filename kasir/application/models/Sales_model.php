<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_model extends CI_Model
{
   public function invoice_no()
   {
      $sql     = "SELECT MAX(MID(invoice,12,4)) AS invoice_no 
                  FROM t_sales 
                  WHERE MID(invoice,6,6) = DATE_FORMAT(CURDATE(), '%y%m%d') ";
      $query   = $this->db->query($sql);

      if ($query->num_rows() > 0) {
         $row     = $query->row();
         $n       = ((int)$row->invoice_no) + 1;
         $no      = sprintf("%'.04d", $n);
      } else {
         $no = "0001";
      }
      $invoice = "MYKSR" . date('ymd') . $no;
      return $invoice;
   }

   public function get_cart($params = null)
   {
      $this->db->select('*, p_item.name as item_name, t_cart.price as cart_price');
      $this->db->from('t_cart');
      $this->db->join('p_item', 't_cart.item_id = p_item.item_id');
      if ($params != null) {
         $this->db->where($params);
      }
      $this->db->where('user_id', $this->session->userdata('userid'));
      return $this->db->get();
   }

   public function add_cart($post)
   {
      $query = $this->db->query("SELECT MAX(cart_id) AS cart_no FROM t_cart");
      if ($query->num_rows() > 0) {
         $row = $query->row();
         $car_no = ((int)$row->cart_no) + 1;
      } else {
         $car_no = "1";
      }

      $params = [
         'cart_id' => $car_no,
         'item_id' => $post['item_id'],
         'price' => $post['price'],
         'qty' => $post['qty'],
         'total' => ($post['price'] * $post['qty']),
         'user_id' => $this->session->userdata('userid')
      ];
      $this->db->insert('t_cart', $params);
   }

   public function update_cart_qty($post)
   {
      $query = "UPDATE t_cart SET price = '$post[price]', 
               qty = qty + '$post[qty]',
               total = '$post[price]' * qty
               WHERE item_id = '$post[item_id]' ";
      $this->db->query($query);
   }
}

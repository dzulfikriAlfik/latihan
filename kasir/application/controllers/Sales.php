<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model(['sales_model', 'customer_model', 'item_model']);
      cek_not_login();
   }

   public function index()
   {
      $data = [
         'row'       => $this->customer_model->get()->result(),
         'item'      => $this->item_model->get()->result_array(),
         'cart'      => $this->sales_model->get_cart(),
         'aktif'     => 'sales',
         'menu'      => 'sales',
         'invoice'   => $this->sales_model->invoice_no()
      ];
      $this->template->load('template', 'transaction/sales/sales_form', $data);
   }

   public function load_cart_data()
   {
      $data['cart'] = $this->sales_model->get_cart();
      $this->load->view('transaction/sales/cart_data', $data);
   }

   public function process()
   {
      $post = $this->input->post(null, TRUE);

      if (isset($_POST['add_cart'])) {

         $item_id = $this->input->post('item_id');
         $check_cart = $this->sales_model->get_cart(['t_cart.item_id' => $item_id])->num_rows();
         if ($check_cart > 0) {
            $this->sales_model->update_cart_qty($post);
         } else {
            $this->sales_model->add_cart($post);
         }

         if ($this->db->affected_rows() > 0) {
            $params  = ['success' => true];
         } else {
            $params  = ['success' => false];
         }
         echo json_encode($params);
      }
   }
}

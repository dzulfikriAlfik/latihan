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
         'aktif'     => 'sales',
         'menu'      => 'sales',
         'invoice'   => $this->sales_model->invoice_no()
      ];
      $this->template->load('template', 'transaction/sales/sales_form', $data);
   }

   public function process()
   {
      $data = $this->input->post(null, TRUE);

      if(isset($_POST['add_cart'])) {
         $this->sales_model->add_cart($data);
      }

      if ($this->db->affected_rows() > 0) {
         $params  = ['success' => true];
      } else {
         $params  = ['success' => false];
      }

      echo json_encode($params);
      
   }
}

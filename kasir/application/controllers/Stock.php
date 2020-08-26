<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model(['stock_model', 'supplier_model', 'item_model']);
      cek_not_login();
   }

   public function stock_in_data()
   {
      $data = [
         'row'    => $this->stock_model->get()->result_array(),
         'aktif'  => 'stock_in',
         'menu'   => 'Stok In',
      ];
      $this->template->load('template', 'transaction/stock_in/stock_in_data', $data);
   }

   public function stock_in_add()
   {
      $data = [
         'item'      => $this->item_model->get()->result_array(),
         'supplier'  => $this->supplier_model->get()->result_array(),
         'aktif'     => 'stock_in',
         'menu'      => 'Stok In',
         'page'      => 'in_add',
      ];
      $this->template->load('template', 'transaction/stock_in/stock_in_form', $data);
   }

   public function process()
   {
      $post = $this->input->post(null, TRUE);

      if (isset($_POST['in_add'])) {
         $this->stock_model->add_stock_in($post);
         $this->item_model->update_stock_in($post);
         pesan_alert('success', 'Data Stock-In Berhasil ditambahkan', 'stock/in');
      }
   }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('stock_model');
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
      $stock = new stdClass();
      $stock->stock_id  = null;
      $stock->item_id  = null;
      $stock->date      = date('Y-m-d');
      $data = [
         'row'    => $stock,
         'aktif'  => 'stock_in',
         'menu'   => 'Stok In',
         'page'   => 'in_add',
      ];
      $this->template->load('template', 'transaction/stock_in/stock_in_form', $data);
   }

   public function process()
   {
      $post = $this->input->post(null, TRUE);

      if (isset($_POST['in_add'])) {
         $this->stock_model->in_add($post);
         pesan_alert('success', 'Data Supplier Berhasil ditambahkan', 'supplier');
      } else if (isset($_POST['edit'])) {
         $this->stock_model->in_edit($post);
         pesan_alert('success', 'Data Supplier Berhasil diupdate', 'supplier');
      }
   }
}

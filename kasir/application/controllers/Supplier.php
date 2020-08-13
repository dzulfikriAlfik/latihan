<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('supplier_model');
      cek_not_login();
   }

   public function index()
   {
      $data = [
         'row'    => $this->supplier_model->get()->result_array(),
         'aktif'  => 'supplier'
      ];
      $this->template->load('template', 'supplier/supplier_data', $data);
   }

   public function delete($id)
   {
      $where = ['supplier_id' => $id];
      $this->supplier_model->delete($where, 'supplier');
      pesan_alert('danger', 'Data Supplier Berhasil dihapus', 'supplier');
   }
}

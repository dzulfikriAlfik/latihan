<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('customer_model');
      cek_not_login();
   }

   public function index()
   {
      $data = [
         'row'    => $this->customer_model->get()->result_array(),
         'aktif'  => 'customer'
      ];
      $this->template->load('template', 'customer/customer_data', $data);
   }

   public function add()
   {
      $customer = new stdClass();
      $customer->customer_id = null;
      $customer->name = null;
      $customer->gender = null;
      $customer->phone = null;
      $customer->address = null;
      $data = [
         'aktif'  => 'customer',
         'page'   => 'add',
         'row'    => $customer
      ];
      $this->template->load('template', 'customer/customer_form', $data);
   }

   public function edit($id)
   {
      $query = $this->customer_model->get($id);
      if ($query->num_rows() > 0) {
         $customer = $query->row();
         $data = [
            'aktif'  => 'customer',
            'page'   => 'edit',
            'row'    => $customer
         ];
         $this->template->load('template', 'customer/customer_form', $data);
      } else {
         pesan_alert('danger', 'Data Customer tidak ditemukan', 'customer');
      }
   }

   public function process()
   {
      $post = $this->input->post(null, TRUE);

      if (isset($_POST['add'])) {
         $this->customer_model->add($post);
         pesan_alert('success', 'Data Customer Berhasil ditambahkan', 'customer');
      } else if (isset($_POST['edit'])) {
         $this->customer_model->edit($post);
         pesan_alert('success', 'Data Customer Berhasil diupdate', 'customer');
      }
   }

   public function delete($id)
   {
      $where = ['customer_id' => $id];
      $this->customer_model->delete($where, 'customer');
      pesan_alert('danger', 'Data customer Berhasil dihapus', 'customer');
   }
}

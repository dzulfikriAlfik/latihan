<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model(['item_model', 'category_model', 'unit_model']);
      cek_not_login();
   }

   public function index()
   {
      $data = [
         'row'    => $this->item_model->get()->result_array(),
         'aktif'  => 'item',
         'menu'   => 'item',
      ];
      $this->template->load('template', 'product/item/item_data', $data);
   }

   public function add()
   {
      $item = new stdClass();
      $item->item_id = null;
      $item->barcode = null;
      $item->name = null;
      $item->price = null;

      $query_category   = $this->category_model->get();
      $query_unit       = $this->unit_model->get();
      $unit[null]       = '-- Pilih Unit --';
      foreach ($query_unit->result() as $unt) {
         $unit[$unt->unit_id] = $unt->name;
      }

      $data = [
         'aktif'           => 'item',
         'menu'            => 'item',
         'page'            => 'add',
         'row'             => $item,
         'category'        => $query_category,
         'unit'            => $unit,
         'selected_unit'   => null
      ];
      $this->template->load('template', 'product/item/item_form', $data);
   }

   public function edit($id)
   {
      $query = $this->item_model->get($id);
      if ($query->num_rows() > 0) {
         $item = $query->row();
         $data = [
            'aktif'  => 'item',
            'menu'   => 'item',
            'page'   => 'edit',
            'row'    => $item
         ];
         $this->template->load('template', 'product/item/item_form', $data);
      } else {
         pesan_alert('danger', 'Data Item tidak ditemukan', 'item');
      }
   }

   public function process()
   {
      $post = $this->input->post(null, TRUE);

      if (isset($_POST['add'])) {
         $this->item_model->add($post);
         pesan_alert('success', 'Data Item Berhasil ditambahkan', 'item');
      } else if (isset($_POST['edit'])) {
         $this->item_model->edit($post);
         pesan_alert('success', 'Data Item Berhasil diupdate', 'item');
      }
   }

   public function delete($id)
   {
      $where = ['item_id' => $id];
      $this->item_model->delete($where, 'p_item');
      pesan_alert('danger', 'Data Item Berhasil dihapus', 'item');
   }
}

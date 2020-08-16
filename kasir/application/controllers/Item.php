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
      $item->item_id       = set_value('item_id');
      $item->category_id   = set_value('category_id');
      $item->barcode       = set_value('barcode');
      $item->name          = set_value('name');
      $item->price         = set_value('price');
      $item->image         = set_value('image');

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
         $item             = $query->row();

         $query_category   = $this->category_model->get();
         $query_unit       = $this->unit_model->get();
         $unit[null]       = '-- Pilih Unit --';
         foreach ($query_unit->result() as $unt) {
            $unit[$unt->unit_id] = $unt->name;
         }
         $data = [
            'aktif'              => 'item',
            'menu'               => 'item',
            'page'               => 'edit',
            'row'                => $item,
            'category'           => $query_category,
            'unit'               => $unit,
            'selected_category'  => $item->category_id,
            'selected_unit'      => $item->unit_id
         ];
         $this->template->load('template', 'product/item/item_form', $data);
      } else {
         pesan_alert('danger', 'Data Item tidak ditemukan', 'item');
      }
   }

   public function process()
   {
      $post = $this->input->post(null, TRUE);

      $config['upload_path']    = './uploads/product/';
      $config['allowed_types']  = 'gif|jpg|png|jpeg';
      $config['max_size']       = 2048;
      $config['file_name']      = "item-$post[product_name]-" . date('dmY') . '-' . substr(md5(rand()), 0, 10);
      $this->load->library('upload', $config);

      // ADD
      if (isset($_POST['add'])) {
         if ($this->item_model->check_barcode($post['barcode'])->num_rows() > 0) {
            pesan_alert('danger', "Barcode $post[barcode] sudah dipakai barang lain", 'item/add');
         } else {
            if (@$_FILES['image']['name'] != null) {
               if ($this->upload->do_upload('image')) {
                  $post['image'] = $this->upload->data('file_name');
                  $this->item_model->add($post);
                  pesan_alert('success', 'Data Item Berhasil ditambahkan', 'item');
               } else {
                  $error = $this->upload->display_errors();
                  pesan_alert('danger', $error, 'item/add');
               }
            } else {
               $post['image'] = null;
               $this->item_model->add($post);
               pesan_alert('success', 'Data Item Berhasil ditambahkan', 'item');
            }
         }
         // EDIT
      } else if (isset($_POST['edit'])) {
         if ($this->item_model->check_barcode($post['barcode'], $post['item_id'])->num_rows() > 0) {
            pesan_alert('danger', "Barcode $post[barcode] sudah dipakai barang lain", "item/edit/$post[item_id]");
         } else {
            if (@$_FILES['image']['name'] != null) {
               if ($this->upload->do_upload('image')) {
                  $item = $this->item_model->get($post['item_id'])->row();
                  if ($item->image != null) {
                     $target_file   = "./uploads/product/$item->image";
                     unlink($target_file);
                  }

                  $post['image'] = $this->upload->data('file_name');
                  $this->item_model->edit($post);
                  pesan_alert('success', 'Data Item Berhasil diupdate', 'item');
               } else {
                  $error = $this->upload->display_errors();
                  pesan_alert('danger', $error, 'item/add');
               }
            } else {
               $post['image'] = null;
               $this->item_model->edit($post);
               pesan_alert('success', 'Data Item Berhasil diupdate', 'item');
            }
         }
      }
   }

   public function delete($id)
   {
      $item = $this->item_model->get($id)->row();
      if ($item->image != null) {
         $target_file   = "./uploads/product/$item->image";
         unlink($target_file);
      }
      $where = ['item_id' => $id];
      $this->item_model->delete($where, 'p_item');
      pesan_alert('danger', 'Data Item Berhasil dihapus', 'item');
   }
}

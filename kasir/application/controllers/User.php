<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('user_model');
      cek_not_login();
   }

   public function index()
   {
      $data['row'] = $this->user_model->get()->result_array();

      $this->template->load('template', 'user/user_data', $data);
   }

   public function _rules()
   {
      $this->form_validation->set_rules('fullname', 'Nama', 'required');
      $this->form_validation->set_rules('username', 'Username', 'required|min_length[7]|is_unique[user.username]');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
      $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|min_length[8]|matches[password]', [
         'matches' => 'Konfirmasi Password Harus sesuai dengan Password'
      ]);
      $this->form_validation->set_rules('level', 'Level', 'required');
      $this->form_validation->set_message('required', '%s Harus diisi!');
      $this->form_validation->set_message('min_length', '{field} harus diisi minimal {param} karakter.');
      $this->form_validation->set_message('is_unique', '%s sudah ada di database, silahkan pilih username lain.');
      // error delimiters
      $this->form_validation->set_error_delimiters('<span class="text-red small">', '</span>');
   }

   public function add()
   {
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
         $this->template->load('template', 'user/user_form_add');
      } else {
         $post = $this->input->post(null, TRUE);
         $this->user_model->add($post);

         if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data User Berhasil ditambahkan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('user');
         }
      }
   }

   public function delete($id)
   {
      $where = ['user_id' => $id];
      $this->user_model->delete($where, 'user');
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data User Berhasil dihapus<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('user');
   }
}

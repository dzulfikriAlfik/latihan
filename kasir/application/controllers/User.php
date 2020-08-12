<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('User_model');
      cek_not_login();
   }

   public function index()
   {
      $data['row'] = $this->User_model->get()->result_array();

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
   }

   public function add()
   {
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
         $this->template->load('template', 'user/user_form_add');
      } else {
         echo "Kontol";
      }
   }
}
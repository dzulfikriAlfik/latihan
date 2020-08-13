<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('User_model');
   }

   // -------------------------------------------------------------------------
   public function login()
   {
      cek_already_login();
      $this->load->view('login');
   }

   // -------------------------------------------------------------------------
   public function process()
   {
      $post = $this->input->post(null, TRUE);

      if (isset($post['login'])) {
         $query = $this->User_model->login($post);
         if ($query->num_rows() > 0) {
            $row     = $query->row();
            $params  = [
               'userid' => $row->user_id,
               'level'  => $row->level
            ];
            $this->session->set_userdata($params);
            echo "<script>
                     alert('Login Berhasil!');
                     window.location='" . site_url('dashboard') . "';
                  </script>";
         } else {
            pesan_alert('danger', 'Username/Password Salah!', 'auth/login');
         }
      }
   }

   // -------------------------------------------------------------------------
   public function logout()
   {
      $params = ['userid', 'level'];
      $this->session->unset_userdata($params);
      pesan_alert('success', 'Berhasil Logout', 'auth/login');
   }
}

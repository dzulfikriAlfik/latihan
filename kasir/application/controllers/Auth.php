<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('User_model');
   }

   // BEGIN Login
   public function login()
   {
      $this->load->view('login');
   }
   // END

   // -------------------------------------------------------------------------

   // BEGIN Process
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
            echo "<script>
                     alert('Login Gagal! Username/Password Salah!');
                     window.location='" . site_url('auth/login') . "';
                  </script>";
         }
      }
   }
   // END
}

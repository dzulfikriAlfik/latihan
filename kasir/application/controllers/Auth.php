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
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Login Gagal! Username/Password Salah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('auth/login');
         }
      }
   }
   // END

   // -------------------------------------------------------------------------

   // BEGIN Logout
   public function logout()
   {
      $params = ['userid', 'level'];
      $this->session->unset_userdata($params);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil Logout<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      redirect('auth/login');
   }
   // END
}

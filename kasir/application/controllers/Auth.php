<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
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
      echo 'Proses';
   }
   // END
}

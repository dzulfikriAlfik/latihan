<?php

class Transkrip_nilai extends CI_Controller
{

   public function index()
   {
      $data = [
         'nim'    => set_value('nim')
      ];

      $this->load->view('templates_administrator/header');
      $this->load->view('templates_administrator/sidebar');
      $this->load->view('administrator/masuk_transkrip', $data);
      $this->load->view('templates_administrator/footer');
   }


}

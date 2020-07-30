<?php 

class Tahun_akademik extends CI_Controller
{

   public function index() 
   {
      $data['tahun_akademik'] = $this->tahunakademik_model->tampil_data('tahun_akademik')->result();

      $this->load->view('templates_administrator/header');
      $this->load->view('templates_administrator/sidebar');
      $this->load->view('administrator/tahun_akademik', $data);
      $this->load->view('templates_administrator/footer');
   }

}

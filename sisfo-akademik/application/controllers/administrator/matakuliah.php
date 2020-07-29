<?php 

class matakuliah extends CI_Controller
{

   public function index() 
   {
      $data['matakuliah'] = $this->matakuliah_model->tampil_data('matakuliah')->result();

      $this->load->view('templates_administrator/header');
      $this->load->view('templates_administrator/sidebar');
      $this->load->view('administrator/matakuliah', $data);
      $this->load->view('templates_administrator/footer');
   }

}

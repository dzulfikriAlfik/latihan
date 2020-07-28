<?php

class Jurusan extends CI_Controller
{
   public function index()
   {
      $data['jurusan'] = $this->jurusan_model->tampil_data()->result();

      $this->load->view('templates_administrator/header');
      $this->load->view('templates_administrator/sidebar');
      $this->load->view('administrator/jurusan', $data);
      $this->load->view('templates_administrator/footer');
   }

   public function input()
   {
      $data = [
         'id_jurusan' => set_value('id_jurusan'),
         'kode_jurusan' => set_value('kode_jurusan'),
         'nama_jurusan' => set_value('nama_jurusan')
      ];

      $this->load->view('templates_administrator/header');
      $this->load->view('templates_administrator/sidebar');
      $this->load->view('administrator/jurusan_form', $data);
      $this->load->view('templates_administrator/footer');
   }

   public function input_aksi()
   {
      $this->_rules();

      if ($this->form_validation->run() == FALSE) {
         $this->input();
      } else {
         $data = [
            'kode_jurusan' => $this->input->post('kode_jurusan', TRUE),
            'nama_jurusan' => $this->input->post('nama_jurusan', TRUE)
         ];

         $this->jurusan_model->input_data($data);
         $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data jurusan berhasil ditambahkan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
         redirect('administrator/jurusan');
      }
   }

   public function _rules()
   {
      $this->form_validation->set_rules('kode_jurusan', 'Kode Jurusan', 'required', [
         'required' => 'Kode jurusan harus diisi'
      ]);
      $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required', [
         'required' => 'Nama jurusan harus diisi'
      ]);
   }
}
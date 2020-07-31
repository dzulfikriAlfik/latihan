<?php

class Krs extends CI_Controller
{
   public function index()
   {
      $data = [
         'nim' => set_value('nim'),
         'id_thn_aka' => set_value('id_thn_aka')
      ];

      $this->load->view('templates_administrator/header');
      $this->load->view('templates_administrator/sidebar');
      $this->load->view('administrator/masuk_krs', $data);
      $this->load->view('templates_administrator/footer');
   }

   public function _rulesKrs()
   {
      $this->form_validation->set_rules('nim', 'NIM', 'required', ['required' => 'NIM harus diisi']);
      $this->form_validation->set_rules('id_thn_aka', 'id tahun akademik', 'required');
   }

   public function krs_aksi()
   {
      $this->_rulesKrs();

      if ($this->form_validation->run() == FALSE) {
         $this->index();
      } else {
         $nim     = $this->input->post('nim', TRUE);
         $thn_aka = $this->input->post('id_thn_aka', TRUE);
      }

      if ($this->mahasiswa_model->get_by_id($nim) == null) {
         $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data NIM yang anda input belum terdaftar<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
         redirect('administrator/krs');
      }

      $data = [
         'nim'          => $nim,
         'id_thn_aka'   => $thn_aka,
         'nama_lengkap' => $this->mahasiswa_model->get_by_id($nim)->nama_lengkap
      ];

      $dataKrs = [
         'krs_data'        => $this->baca_krs($nim, $thn_aka),
         'nim'             => $nim,
         'id_thn_aka'      => $thn_aka,
         'tahun_akademik'  => $this->tahunakademik_model->get_by_id($thn_aka)->tahun_akademik,
         'semester'        => $this->tahunakademik_model->get_by_id($thn_aka)->semester == 'Ganjil' ? 'Ganjil' : 'Genap',
         'nama_lengkap'    => $this->mahasiswa_model->get_by_id($nim)->nama_lengkap,
         'prodi'           => $this->mahasiswa_model->get_by_id($nim)->nama_prodi,
      ];

      $this->load->view('templates_administrator/header');
      $this->load->view('templates_administrator/sidebar');
      $this->load->view('administrator/krs_list', $dataKrs);
      $this->load->view('templates_administrator/footer');
   }

   public function baca_krs($nim, $thn_aka)
   {
      $this->db->select('k.id_krs, k.kode_matakuliah, m.nama_matakuliah, m.sks');
      $this->db->from('krs as k');
      $this->db->where('k.nim', $nim);
      $this->db->where('k.id_thn_aka', $thn_aka);
      $this->db->join('matakuliah as m', 'm.kode_matakuliah = k.kode_matakuliah');

      $krs = $this->db->get()->result();
      return $krs;
   }
}

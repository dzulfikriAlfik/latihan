<?php

class Nilai extends CI_Controller
{

   public function index()
   {
      $data = [
         'nim'          => set_value('nim'),
         'id_thn_aka'   => set_value('id_thn_aka')
      ];

      $this->load->view('templates_administrator/header');
      $this->load->view('templates_administrator/sidebar');
      $this->load->view('administrator/masuk_khs', $data);
      $this->load->view('templates_administrator/footer');
   }

   public function _rules()
   {
      $this->form_validation->set_rules('id_thn_aka', 'id tahun akademik', 'required');
      $this->form_validation->set_rules('nim', 'NIM', 'required', ['required' => 'NIM harus diisi']);
      $this->form_validation->set_rules('kode_matakuliah', 'Kode Matakuliah', 'required', ['required' => 'Kode Matakuliah harus diisi']);
   }

   public function _rulesKhs()
   {
      $this->form_validation->set_rules('nim', 'NIM', 'required', ['required' => 'NIM harus diisi']);
      $this->form_validation->set_rules('id_thn_aka', 'id tahun akademik', 'required');
   }

   public function nilai_aksi()
   {
      $this->_rulesKhs();

      if ($this->form_validation->run() == FALSE) {
         $this->index();
      } else {
         $nim           = $this->input->post('nim', TRUE);
         $id_thn_aka    = $this->input->post('id_thn_aka', TRUE);

         $query =
            "SELECT 
               krs.id_thn_aka,
               krs.kode_matakuliah,
               matakuliah.nama_matakuliah,
               matakuliah.sks,
               krs.nilai
               FROM 
                  krs INNER JOIN matakuliah
               ON (krs.kode_matakuliah = matakuliah.kode_matakuliah)
               WHERE krs.nim = '$nim' AND krs.id_thn_aka = '$id_thn_aka'
               ";
         $sql        = $this->db->query($query)->result();
         $smt        = $this->db->select('tahun_akademik, semester')
            ->from('tahun_akademik')
            ->where(['id_thn_aka' => $id_thn_aka])->get()->row();
         $query_str  = "SELECT 
                        mahasiswa.nim,
                        mahasiswa.nama_lengkap,
                        prodi.nama_prodi
                        FROM
                        mahasiswa INNER JOIN prodi
                        ON (mahasiswa.nama_prodi = prodi.nama_prodi)
                        ";
         $mhs        = $this->db->query($query_str)->row();

         if ($smt->semester == 'Ganjil') {
            $tampilSemester = 'Ganjil';
         } else {
            $tampilSemester = 'Genap';
         }

         $data = [
            'mhs_data'  => $sql,
            'mhs_nim'   => $nim,
            'mhs_nama'  => $this->mahasiswa_model->get_by_id($nim)->nama_lengkap,
            'mhs_prodi' => $this->mahasiswa_model->get_by_id($nim)->nama_prodi,
            'thn_aka'   => $smt->tahun_akademik . "(" . $tampilSemester . ")"
         ];

         $this->load->view('templates_administrator/header');
         $this->load->view('templates_administrator/sidebar');
         $this->load->view('administrator/khs', $data);
         $this->load->view('templates_administrator/footer');
      }
   }

   public function input_nilai() 
   {
      $data = [
         'kode_matakuliah'    => set_value('kode_matakuliah'),
         'id_thn_aka'         => set_value('id_thn_aka')
      ];

      $this->load->view('templates_administrator/header');
      $this->load->view('templates_administrator/sidebar');
      $this->load->view('administrator/input_nilai_form', $data);
      $this->load->view('templates_administrator/footer');
   }
}

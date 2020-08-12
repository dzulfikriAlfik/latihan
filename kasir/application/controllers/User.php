<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      $this->load->model('User_model');
   }

   public function index()
   {
      cek_not_login();

      $data['row'] = $this->User_model->get()->result_array();

      $this->template->load('template', 'user/user_data', $data);
   }

   public function add()
   {
      $this->template->load('template', 'user/user_form_add');
   }
}

<?php

function cek_already_login()
{
   $instance = &get_instance();
   $user_session = $instance->session->userdata('userid');

   if ($user_session) {
      redirect('dashboard');
   }
}

function cek_not_login()
{
   $instance = &get_instance();
   $user_session = $instance->session->userdata('userid');

   if (!$user_session) {
      redirect('auth/login');
   }
}

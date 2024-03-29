<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Requests_client_test extends CI_Controller {

    public function index()
    {
        $this->load->helper('url');

        $result = null;
        $status_code = null;
        $content_type = null;

        $code_example = <<<EOT

        \$user_id = 1;

        \$this->load->helper('url');

        \$headers = array('Accept' => 'application/json');
        \$options = array(
            'auth' => array('admin', '1234'),
            'verify' => false,  // Disable SSL verification, this option value is insecure and should be avoided!
        );
        \$request = Requests::get(site_url('api/example/users/id/'.\$user_id.'/format/json'), \$headers, \$options);

        \$result = \$request->body;
        \$status_code = \$request->status_code;
        \$content_type = \$request->headers['content-type'];

EOT;

        eval($code_example);

        $this->load->view('requests_client_test', compact('code_example', 'result', 'status_code', 'content_type'));
    }
}

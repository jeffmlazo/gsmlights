<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class login extends CI_Controller {

    public function index()
    {
        $this->load->view('login');
    }

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */
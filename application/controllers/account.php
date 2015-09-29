<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('account_model');
    }

    public function index() {
        $this->load->view('login');
    }

    public function check_user() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $query_user = $this->account_model->getUser($username, $password);
        if ($query_user) {

            if ($query_user->password === $password) {
                redirect('uisystemcontain');
            }
            else {
                echo 'incorrect password';
            }
        }
        else {
            echo 'account is not existing';
        }
    }

    public function logout() {
        redirect('account');
    }

    public function save() {
        $department = $this->input->post('department');
        $job_title_id = $this->input->post('job-title');
        $username = $this->input->post('username');
        $phone_number = $this->input->post('phone-number');
        $firstname = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');
        $lastname = $this->input->post('lastname');

        $arr_data = array(
            'department' => $department,
            'job_title_id' => $job_title_id,
            'username' => $username,
            'phone_number' => $phone_number,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname
        );

        $this->account_model->save($arr_data);
    }

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
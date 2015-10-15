<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Uisystemcontain extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('job_title_model');
        $this->load->model('department_model');
    }

    public function index()
    {
        $data['job_title_options'] = '';
        $query_job_titles = $this->job_title_model->getJobTitles();
        if ($query_job_titles->num_rows() > 0)
        {

            $job_title_data = '';
            foreach ($query_job_titles->result() as $job_title)
            {

                $job_title_data .= '<option value="' . $job_title->id . '">' . $job_title->name . '</option>';
            }

            $data['job_title_options'] = $job_title_data;
        }

        $data['department_options'] = '';
        $query_departments = $this->department_model->getDepartments();
        if ($query_departments->num_rows() > 0)
        {

            $department_data = '';
            foreach ($query_departments->result() as $department)
            {

                $department_data .= '<option value="' . $department->id . '">' . $department->name . '</option>';
            }

            $data['department_options'] = $department_data;
        }

        $this->load->view('uisystemcontain', $data);
    }

    public function navs()
    {
        $nav_type = $this->uri->segment(3);

        $error_msg = '';
        switch ($nav_type)
        {
            case 'registration':
                redirect('account/display_registration');
                break;

            case 'file':
                redirect('account/files/display');
                break;

            case 'message-create':
                redirect('message');
                break;

            case 'message-inbox':
                redirect('message/messages/display');
                break;

            case 'user-add':
                redirect('user');
                break;

            case 'user-view-list':
                redirect('user/users/display');
                break;
        }

        echo '<div class="col-lg-2 col-md-2 col-sm-2"></div>' .
        '<div class="col-lg-8 col-md-8 col-sm-8">' .
        '<div class="alert alert-danger" role="alert">' .
        '<strong>Warning!</strong> ' . $error_msg .
        '</div>' .
        '</div>' .
        '<div class="col-lg-2 col-md-2 col-sm-2"></div>';
    }

}

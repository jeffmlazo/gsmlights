<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Account extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model('job_title_model');
        $this->load->model('department_model');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function check_user()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $query_user = $this->account_model->getUser($username);
        $json_msg = array();
        if ($query_user)
        {

            if ($query_user->password === $password)
            {
                $json_msg = array('status' => 'success');
            }
            else
            {
                $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_incorrect_password'));
            }
        }
        else
        {
            $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_account_not_exist'));
        }

        echo json_encode($json_msg);
    }

    public function logout()
    {
        redirect('account');
    }

    public function save()
    {
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
        $json_msg = array('status' => 'success', 'msg' => $this->lang->line('success_account_add'));
        echo json_encode($json_msg);
    }

    public function display_registration()
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

        $this->load->view('contents/registration', $data);
    }

    public function files()
    {
        $action = $this->uri->segment(3);

        $data['file_results'] = '';
        $query_results = $this->account_model->getAccounts();
        if ($query_results->num_rows() > 0)
        {
            $file_data = array();
            foreach ($query_results->result() as $file)
            {
                $query_job_title = $this->job_title_model->getJobTitle($file->job_title_id);
                $file_data[] = array(
                    '<input type="checkbox" class="checkbox">',
                    $file->phone_number,
                    $file->username,
                    $file->firstname,
                    $file->middlename,
                    $file->lastname,
                    $query_job_title->name,
                    $file->id
                );
            }

            $data['json_data'] = json_encode($file_data);
        }

        switch ($action)
        {
            case 'display':
                $this->load->view('contents/file', $data);
                break;

            case 'reload':
                $this->load->view('contents/file_table', $data);
                break;
        }
    }

    public function prompt_file()
    {
        $prompt_type = $this->uri->segment(3);
        $file_data = $this->input->get('arr_data');

        $data = array(
            'phone_number' => $file_data[0],
            'username' => $file_data[1],
            'firstname' => $file_data[2],
            'middlename' => $file_data[3],
            'lastname' => $file_data[4],
            'account_id' => $file_data[6]
        );

        if ($prompt_type === 'edit')
        {
            $data['job_title_options'] = '';
            $query_job_titles = $this->job_title_model->getJobTitles();
            if ($query_job_titles->num_rows() > 0)
            {
                $job_title_data = '';
                foreach ($query_job_titles->result() as $job_title)
                {
                    $selected = '';
                    if ($job_title->name === $file_data[5])
                    {
                        $selected = 'selected';
                    }

                    $job_title_data .= '<option value="' . $job_title->id . '" ' . $selected . '>' . $job_title->name . '</option>';
                }

                $data['job_title_options'] = $job_title_data;
            }

            $this->load->view('contents/edit_file', $data);
        }
        else if (strpos($prompt_type, 'delete') !== FALSE)
        {
            if (strpos($prompt_type, 'all') !== FALSE)
            {
                $check_rows = $this->input->get('checked_rows');

                $accounts = '';
                $account_ids = array();
                foreach ($check_rows as $row_data)
                {
                    $firstname = $row_data[2];
                    $middlename = $row_data[3];
                    $lastname = $row_data[4];

                    $account_ids[] = $row_data[6];
                    $accounts .= '<strong>' . $firstname . ' ' . substr(ucfirst($middlename), 0, 1) . '. ' . $lastname . '<br/></strong>';
                }

                $data['accounts'] = $accounts;
                $data['account_ids'] = $account_ids;
            }

            $data['prompt_type'] = $prompt_type;
            $this->load->view('contents/delete_file', $data);
        }
        else
        {
            echo $this->lang->line('error_redirect_prompt_file');
        }
    }

    public function update_file()
    {
        $account_id = $this->input->post('account-id');
        $job_title_id = $this->input->post('job-title');
        $username = $this->input->post('username');
        $phone_number = $this->input->post('phone-number');
        $firstname = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');
        $lastname = $this->input->post('lastname');

        $arr_data = array(
            'job_title_id' => $job_title_id,
            'username' => $username,
            'phone_number' => $phone_number,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname
        );

        $this->account_model->update($arr_data, $account_id);
        $json_msg = array('status' => 'success', 'msg' => $this->lang->line('success_account_update'));
        echo json_encode($json_msg);
    }

    public function delete_file()
    {
//        $action = $this->uri->segment(3);
        $account_id = $this->input->post('account_id');
        $this->account_model->delete($account_id);
        $msg = $this->lang->line('success_account_delete');

        $json_msg = array('status' => 'success', 'msg' => $msg);
        echo json_encode($json_msg);
    }

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
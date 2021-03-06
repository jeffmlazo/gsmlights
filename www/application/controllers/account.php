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
        // user is already logged in
        if ($this->auth->loggedin())
        {
            redirect('uisystemcontain');
        }

        $this->load->view('login');
    }

    public function check_user()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember') ? TRUE : FALSE;
        $config = $this->config->item('form_validations');
        $this->form_validation->set_rules($config['login_validation']);

        if ($this->form_validation->run())
        {
            $json_msg = array();
            $query_user = $this->account_model->getAccount($username);
            if ($query_user)
            {
                // Check password hash with the feeded password in the form
                if (password_verify($password, $query_user->password))
                {
                    // Update the user table for the last_login
                    $data = array('last_login' => TRUE);
                    $affected_row = $this->account_model->update($data, $query_user->id);
                    if ($affected_row > 0)
                    {
                        $json_msg = array('status' => 'success');
                        $session_data = array(
                            'account_id' => $query_user->id,
                            'username' => $query_user->username,
                            'account_type' => $query_user->account_type
                        );

                        if ($remember)
                        {
                            $this->auth->login($query_user->id);
                        }
                        else
                        {
                            $this->auth->login($query_user->id, FALSE);
                        }

                        $this->session->set_userdata($session_data);
                    }
                    else
                    {
                        $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_update'));
                    }
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
        }
        else
        {
            /**
             * Store the errors ex. <p>Username invalid.</p><p>Username invalid.</p>
             * in the variable $str_errors and change the error delimiters with space
             */
            $str_errors = $this->form_validation->error_string(' ', ' ');
            /**
             * Explode the strings using the period "." and store it in a variable 
             * which is $explode_errors 
             */
            $explode_errors = explode('.', $str_errors);

            /**
             * Create a array variable $arr_errors to store the newly formatted array
             * and loop all exploded arrays.
             */
            $arr_errors = array();
            foreach ($explode_errors as $error)
            {
                // Trim first the errors to avoid start and end spaces
                $trim_error = trim($error);
                // Check if the exploded value is not empty string
                if (!empty($trim_error))
                {
                    // Store the new error string in the array ending with period
                    $arr_errors[] = $trim_error . '.';
                }
            }

            $json_msg = array('status' => 'error', 'msg' => $arr_errors);
        }

        echo json_encode($json_msg);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->auth->logout();
        redirect('account');
    }

    public function save()
    {
        $config = $this->config->item('form_validations');
        $this->form_validation->set_rules($config['add_file_validation']);

        if ($this->form_validation->run())
        {
            $department_id = $this->input->post('department');
            $job_title_id = $this->input->post('job-title');
            $username = $this->input->post('username');
            $phone_number = $this->input->post('phone-number');
            $firstname = $this->input->post('firstname');
            $middlename = $this->input->post('middlename');
            $lastname = $this->input->post('lastname');
            $password = $this->input->post('password');

            // Password hash for secure password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if (empty($phone_number))
            {
                $phone_number = NULL;
            }
            else
            {
                $phone_number = '+63' . $phone_number;
            }

            $arr_data = array(
                'department_id' => $department_id,
                'job_title_id' => $job_title_id,
                'username' => $username,
                'phone_number' => $phone_number,
                'firstname' => $firstname,
                'middlename' => $middlename,
                'lastname' => $lastname,
                'password' => $password_hash
            );

            $entity_id = $this->account_model->save($arr_data);
            if ($entity_id)
            {
                $log_data = array(
                    'account_id' => $entity_id,
                    'table_name' => 'account',
                );

                $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_add'), 'account'));
                $this->log_model->save($log_data);
            }
            else
            {
                $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_insert'));
            }
        }
        else
        {
            /**
             * Store the errors ex. <p>Username invalid.</p><p>Username invalid.</p>
             * in the variable $str_errors and change the error delimiters with space
             */
            $str_errors = $this->form_validation->error_string(' ', ' ');
            /**
             * Explode the strings using the period "." and store it in a variable 
             * which is $explode_errors 
             */
            $explode_errors = explode('.', $str_errors);

            /**
             * Create a array variable $arr_errors to store the newly formatted array
             * and loop all exploded arrays.
             */
            $arr_errors = array();
            foreach ($explode_errors as $error)
            {
                // Trim first the errors to avoid start and end spaces
                $trim_error = trim($error);
                // Check if the exploded value is not empty string
                if (!empty($trim_error))
                {
                    // Store the new error string in the array ending with period
                    $arr_errors[] = $trim_error . '.';
                }
            }

            $json_msg = array('status' => 'error', 'msg' => $arr_errors);
        }

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

        $this->load->view('contents/files/registration', $data);
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
                // Check if the account type is admin if true skip the admin to display
                if ($file->account_type === 'admin')
                {
                    continue;
                }

                $phone_number = !empty($file->phone_number) ? $file->phone_number : 'n/a';

                $file_data[] = array(
                    '<input type="checkbox" class="checkbox">',
                    $phone_number,
                    $file->username,
                    $file->firstname,
                    $file->middlename,
                    $file->lastname,
                    $file->job_title_name,
                    $file->department_name,
                    $file->created_on,
                    $file->id
                );
            }

            $data['json_data'] = json_encode($file_data);
        }

        switch ($action)
        {
            case 'display':
                $this->load->view('contents/files/file', $data);
                break;

            case 'reload':
                $this->load->view('contents/files/file_table', $data);
                break;
        }
    }

    public function prompt_file()
    {
        $prompt_type = $this->uri->segment(3);
        $file_data = $this->input->get('arr_data');

        $data = array(
            'username' => $file_data[1],
            'firstname' => $file_data[2],
            'middlename' => $file_data[3],
            'lastname' => $file_data[4],
            'account_id' => $file_data[8]
        );

        if ($prompt_type === 'edit')
        {
            $phone_number = '';
            if (!empty($file_data[0]) && stripos($phone_number, '+63') !== false)
            {
                $explode_phone_number = explode('+63', $file_data[0]);
                $phone_number = $explode_phone_number[1];
            }

            $arr_phone_number = array('phone_number' => $phone_number);
            $data = array_merge($data, $arr_phone_number);

            $data['department_options'] = '';
            $query_departments = $this->department_model->getDepartments();
            if ($query_departments->num_rows() > 0)
            {
                $department_data = '';
                foreach ($query_departments->result() as $department)
                {
                    $selected = '';
                    if ($department->name === $file_data[6])
                    {
                        $selected = 'selected';
                    }

                    $department_data .= '<option value="' . $department->id . '"' . $selected . '>' . $department->name . '</option>';
                }

                $data['department_options'] = $department_data;
            }

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

            $this->load->view('contents/files/edit_file', $data);
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

                    $account_ids[] = $row_data[8];
                    $accounts .= '<strong>' . $firstname . ' ' . substr(ucfirst($middlename), 0, 1) . '. ' . $lastname . '<br/></strong>';
                }

                $data['accounts'] = $accounts;
                $data['account_ids'] = $account_ids;
            }

            $data['prompt_type'] = $prompt_type;
            $this->load->view('contents/files/delete_file', $data);
        }
        else
        {
            echo sprintf($this->lang->line('error_redirect_prompt'), 'account');
        }
    }

    public function update_file()
    {
        $account_id = $this->input->post('account-id');
        $job_title_id = $this->input->post('job-title');
        $department_id = $this->input->post('department');
        $username = $this->input->post('username');
        $phone_number = $this->input->post('phone-number');
        $firstname = $this->input->post('firstname');
        $middlename = $this->input->post('middlename');
        $lastname = $this->input->post('lastname');
        $config = $this->config->item('form_validations');
        $this->form_validation->set_rules($config['update_file_validation']);

        if ($this->form_validation->run())
        {
            if (empty($phone_number))
            {
                $phone_number = NULL;
            }
            else
            {
                $phone_number = '+63' . $phone_number;
            }

            $arr_data = array(
                'job_title_id' => $job_title_id,
                'department_id' => $department_id,
                'username' => $username,
                'phone_number' => $phone_number,
                'firstname' => $firstname,
                'middlename' => $middlename,
                'lastname' => $lastname
            );

            $affected_row = $this->account_model->update($arr_data, $account_id);
            if ($affected_row > 0)
            {
                $log_data = array(
                    'account_id' => $account_id,
                    'table_name' => 'account',
                    'action' => 'update'
                );
                $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_update'), 'account'));
                $this->log_model->save($log_data);
            }
            else
            {
                $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_update'));
            }
        }
        else
        {
            /**
             * Store the errors ex. <p>Username invalid.</p><p>Username invalid.</p>
             * in the variable $str_errors and change the error delimiters with space
             */
            $str_errors = $this->form_validation->error_string(' ', ' ');
            /**
             * Explode the strings using the period "." and store it in a variable 
             * which is $explode_errors 
             */
            $explode_errors = explode('.', $str_errors);

            /**
             * Create a array variable $arr_errors to store the newly formatted array
             * and loop all exploded arrays.
             */
            $arr_errors = array();
            foreach ($explode_errors as $error)
            {
                // Trim first the errors to avoid start and end spaces
                $trim_error = trim($error);
                // Check if the exploded value is not empty string
                if (!empty($trim_error))
                {
                    // Store the new error string in the array ending with period
                    $arr_errors[] = $trim_error . '.';
                }
            }

            $json_msg = array('status' => 'error', 'msg' => $arr_errors);
        }

        echo json_encode($json_msg);
    }

    public function delete_file()
    {
        $delete_type = $this->uri->segment(3);
        $account_id = $this->input->post('account_id');
        $affected_row = $this->account_model->delete($account_id);
        if ($affected_row > 0)
        {
            if ($delete_type === 'delete-all')
            {
                $log_data = array();
                foreach ($account_id as $single_entity_id)
                {
                    $log_data[] = array(
                        'account_id' => $single_entity_id,
                        'table_name' => 'account',
                        'info' => 'all',
                        'created_on' => date('Y-m-d H:i:s'),
                        'action' => 'delete'
                    );
                }
                $this->log_model->save($log_data, TRUE);
            }
            else
            {
                $log_data = array(
                    'account_id' => $account_id,
                    'table_name' => 'account',
                    'info' => 'row',
                    'action' => 'delete'
                );
                $this->log_model->save($log_data);
            }

            $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_delete'), 'account'));
        }
        else
        {
            $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_delete'));
        }
        echo json_encode($json_msg);
    }

    public function prompt_profile()
    {
        $account_id = $this->input->get('account_id');
        $query_row = $this->account_model->getAccount($account_id);
        $data['account_id'] = $query_row->id;
        $data['username'] = $query_row->username;

        $this->load->view('contents/files/profile', $data);
    }

    public function update_account_profile()
    {
        $account_id = $this->input->post('account-id');
        $password = $this->input->post('password');

        $config = $this->config->item('form_validations');
        $this->form_validation->set_rules($config['update_account_profile_validation']);

        if ($this->form_validation->run())
        {
            // Password hash for secure password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $arr_data = array(
                'password' => $password_hash,
            );

            $affected_row = $this->account_model->update($arr_data, $account_id);
            if ($affected_row > 0)
            {
                $log_data = array(
                    'account_id' => $account_id,
                    'table_name' => 'account',
                    'action' => 'update',
                    'info' => 'account profile'
                );
                $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_update'), 'profile'));
                $this->log_model->save($log_data);
            }
            else
            {
                $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_update'));
            }
        }
        else
        {
            /**
             * Store the errors ex. <p>Username invalid.</p><p>Username invalid.</p>
             * in the variable $str_errors and change the error delimiters with space
             */
            $str_errors = $this->form_validation->error_string(' ', ' ');
            /**
             * Explode the strings using the period "." and store it in a variable 
             * which is $explode_errors 
             */
            $explode_errors = explode('.', $str_errors);

            /**
             * Create a array variable $arr_errors to store the newly formatted array
             * and loop all exploded arrays.
             */
            $arr_errors = array();
            foreach ($explode_errors as $error)
            {
                // Trim first the errors to avoid start and end spaces
                $trim_error = trim($error);
                // Check if the exploded value is not empty string
                if (!empty($trim_error))
                {
                    // Store the new error string in the array ending with period
                    $arr_errors[] = $trim_error . '.';
                }
            }

            $json_msg = array('status' => 'error', 'msg' => $arr_errors);
        }

        echo json_encode($json_msg);
    }

    /**
     * Callback function for user_validation
     * @param string $username
     * @return boolean
     */
    public function username_check($username)
    {
        $account_id = $this->input->post('account-id');
        $query_result = $this->account_model->getAccountUsername($username);
        // Check if their was already an existing username
        if ($query_result)
        {
            // Lets check if the id was still the same
            if ($account_id === $query_result->id)
            {
                /**
                 * Lets just return TRUE if the user id was still the same
                 * this means that the username was still the same as well
                 */
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('username_check', $this->lang->line('error_username_duplicate'));
                return FALSE;
            }
        }
        else
        {
            return TRUE;
        }
    }

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */
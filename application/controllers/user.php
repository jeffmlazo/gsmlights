<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index()
    {
        $this->load->view('contents/users/registration');
    }

    public function save()
    {
        $user_type = $this->input->post('user-type');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $arr_data = array(
            'user_type' => $user_type,
            'username' => $username,
            'password' => $password
        );

        $entity_id = $this->user_model->save($arr_data);
        if ($entity_id)
        {
            $log_data = array(
                'user_entity_id' => $entity_id,
                'table_name' => 'user',
                'user_id' => $this->session->userdata('user_id')
            );

            $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_add'), 'user'));
            $this->log_model->save($log_data);
        }
        else
        {
            $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_insert'));
        }

        echo json_encode($json_msg);
    }

    public function users()
    {
        $action = $this->uri->segment(3);

        $data['user_results'] = '';
        $query_results = $this->user_model->getUsers();
        if ($query_results->num_rows() > 0)
        {
            $user_data = array();
            foreach ($query_results->result() as $user)
            {
                $user_data[] = array(
                    '<input type="checkbox" class="checkbox">',
                    $user->username,
                    $user->password,
                    $user->user_type,
                    $user->created_on,
                    $user->id
                );
            }

            $data['json_data'] = json_encode($user_data);
        }

        switch ($action)
        {
            case 'display':
                $this->load->view('contents/users/user', $data);
                break;

            case 'reload':
                $this->load->view('contents/users/user_table', $data);
                break;
        }
    }

    public function prompt_user()
    {
        $prompt_type = $this->uri->segment(3);
        $user_data = $this->input->get('arr_data');

        $data = array(
            'username' => $user_data[0],
            'password' => $user_data[1],
            'user_type' => $user_data[2],
            'user_id' => $user_data[4]
        );

        if ($prompt_type === 'edit')
        {
            $user_type_options = '';
            if ($user_data[2] === 'admin')
            {
                $user_type_options .= '<option value="admin" selected>Admin</option>' .
                        '<option value="employee">Employee</option>';
            }
            else
            {
                $user_type_options .= '<option value="admin">Admin</option>' .
                        '<option value="employee" selected>Employee</option>';
            }

            $data['user_type_options'] = $user_type_options;

            $this->load->view('contents/users/edit_user', $data);
        }
        else if (strpos($prompt_type, 'delete') !== FALSE)
        {
            if (strpos($prompt_type, 'all') !== FALSE)
            {
                $check_rows = $this->input->get('checked_rows');

                $users = '';
                $user_ids = array();
                foreach ($check_rows as $row_data)
                {
                    $username = $row_data[0];
                    $user_ids[] = $row_data[4];
                    $users .= '<strong>' . $username . '<br/></strong>';
                }

                $data['users'] = $users;
                $data['user_ids'] = $user_ids;
            }

            $data['prompt_type'] = $prompt_type;
            $this->load->view('contents/users/delete_user', $data);
        }
        else
        {
            echo sprintf($this->lang->line('error_redirect_prompt'), 'user');
        }
    }

    public function update_user()
    {
        $user_id = $this->input->post('user-id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user_type = $this->input->post('user-type');

        $arr_data = array(
            'username' => $username,
            'password' => $password,
            'user_type' => $user_type
        );

        $affected_row = $this->user_model->update($arr_data, $user_id);
        if ($affected_row > 0)
        {
            $log_data = array(
                'user_entity_id' => $user_id,
                'table_name' => 'user',
                'user_id' => $this->session->userdata('user_id'),
                'action' => 'update'
            );
            $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_update'), 'user'));
            $this->log_model->save($log_data);
        }
        else
        {
            $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_update'));
        }

        echo json_encode($json_msg);
    }

    public function delete_user()
    {
        $delete_type = $this->uri->segment(3);
        $user_id = $this->input->post('user_id');
        $affected_row = $this->user_model->delete($user_id);
        if ($affected_row > 0)
        {
            if ($delete_type === 'delete-all')
            {
                $log_data = array();
                foreach ($user_id as $single_entity_id)
                {
                    $log_data[] = array(
                        'user_entity_id' => $single_entity_id,
                        'table_name' => 'user',
                        'user_id' => $this->session->userdata('user_id'),
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
                    'user_entity_id' => $user_id,
                    'table_name' => 'user',
                    'user_id' => $this->session->userdata('user_id'),
                    'info' => 'row',
                    'action' => 'delete'
                );
                $this->log_model->save($log_data);
            }

            $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_delete'), 'user'));
        }
        else
        {
            $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_delete'));
        }
        echo json_encode($json_msg);
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
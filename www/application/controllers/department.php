<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Department extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('department_model');
    }

    public function index()
    {
        /**
         * Check if user was not logged in if true redirect
         * to the login page
         */
        if (!$this->auth->loggedin())
        {
            redirect('account');
        }

        $this->load->view('contents/departments/create');
    }

    public function save()
    {
        $department = $this->input->post('department');
        $account_id = $this->session->userdata('account_id');
        $config = $this->config->item('form_validations');
        $this->form_validation->set_rules($config['save_department_validation']);

        if ($this->form_validation->run())
        {
            $arr_data = array(
                'name' => $department,
            );

            $entity_id = $this->department_model->save($arr_data);
            // Check if inserted data was successful
            if ($entity_id)
            {
                $log_data = array(
                    'department_id' => $entity_id,
                    'table_name' => 'department',
                    'account_id' => $account_id
                );

                $this->log_model->save($log_data);

                $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_add'), 'department'));
            }
            else
            {

                $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_insert'));
            }
        }
        else
        {
            /**
             * Store the errors ex. <p>Message is required.</p>
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

    // TODO: reconstruct this function for department list
    public function messages()
    {
//        Lets just comment out this $action for future implementations of delete, edit actions
//        $action = $this->uri->segment(3);

        $data['message_results'] = '';
        $query_results = $this->message_model->getMessages();
        if ($query_results->num_rows() > 0)
        {
            $message_data = array();
            foreach ($query_results->result() as $message)
            {
                $username = $message->account_username;

                // Check if phone number is not empty if true assign the value $phone_number otherwise n/a value will be assigned
                $phone_number = !empty($message->phone_number) ? $message->phone_number : $phone_number = 'n/a';

                $message_data[] = array(
                    $phone_number,
                    $username,
                    $message->message,
                    $message->priority,
                    $message->status,
                    $message->created_on,
                );
            }

            $data['json_data'] = json_encode($message_data);
        }

        $this->load->view('contents/messages/message', $data);
    }

}

/* End of file message.php */
/* Location: ./application/controllers/message.php */
<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Message extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
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

        $this->load->view('contents/messages/create');
    }

    public function save()
    {
        $priority = $this->input->post('priority');
        $message = $this->input->post('message');
        $user_id = $this->session->userdata('user_id');
        $config = $this->config->item('form_validations');
        $this->form_validation->set_rules($config['save_message_validation']);

        if ($this->form_validation->run())
        {
            $arr_data = array(
                'priority' => $priority,
                'message' => $message,
                'user_id' => $user_id
            );

            $entity_id = $this->message_model->save($arr_data);
            // Check if inserted data was successful
            if ($entity_id)
            {
                $log_data = array(
                    'message_entity_id' => $entity_id,
                    'table_name' => 'message',
                    'user_id' => $user_id
                );

                $this->log_model->save($log_data);

                $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_add'), 'message'));
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
                // Check if account username is not empty if true assign the value to $username otherwise user name value will be assigned
                $username = !empty($message->account_username) ? $message->account_username : $message->user_username;

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
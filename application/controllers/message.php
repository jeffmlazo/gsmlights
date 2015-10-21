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

        $account_ids = $this->message_model->getAccountIds();
        if ($account_ids->num_rows() > 0)
        {
            $ctr = 0;
            foreach ($account_ids->result() as $account_id)
            {
                $arr_data = array(
                    'priority' => $priority,
                    'message' => $message,
                    'account_id' => $account_id->id
                );

                $entity_id = $this->message_model->save($arr_data);
                if ($entity_id)
                {
                    $log_data = array(
                        'message_entity_id' => $entity_id,
                        'table_name' => 'message',
                        'user_id' => $this->session->userdata('user_id')
                    );

                    $this->log_model->save($log_data);
                    $ctr++;
                }
                else
                {
                    // Lets just break the loop if something went wrong when inserting
                    break;
                }
            }

            // Check if all inserted data was successful
            if ($account_ids->num_rows() === $ctr)
            {
                $json_msg = array('status' => 'success', 'msg' => sprintf($this->lang->line('success_form_add'), 'message'));
            }
            else
            {
                $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_db_insert'));
            }
        }
        else
        {
            $json_msg = array('status' => 'error', 'msg' => $this->lang->line('error_phone_number_not_exist'));
        }

        echo json_encode($json_msg);
    }

    public function messages()
    {
        $action = $this->uri->segment(3);

        $data['message_results'] = '';
        $query_results = $this->message_model->getMessages();
        if ($query_results->num_rows() > 0)
        {
            $message_data = array();
            foreach ($query_results->result() as $message)
            {
                $message_data[] = array(
                    $message->phone_number,
                    $message->username,
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
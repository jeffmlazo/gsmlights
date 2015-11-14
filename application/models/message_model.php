<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Message_model extends CI_Model {

    /**
     * Insert the values of message
     * @param $data the message data
     * @return the insert id
     */
    public function save($data)
    {
        $this->db->set($data);
        $this->db->insert('message');
        return $this->db->insert_id();
    }

    /**
     * Get the user by id
     * @param $id the message id
     * $return the message
     */
    public function getMessage($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('message')->row();
    }

    /**
     * Get all messages
     * @return all messages
     */
    public function getMessages()
    {
        /**
         * 2nd parameter SELECT was set to FALSE so that we can use the mysql DATE_FORMAT
         * function and we also rename the column because it is required to call in the controller
         */
        $this->db->select("message.*, account.phone_number, account.username AS account_username, user.username AS user_username, LOWER(DATE_FORMAT(log.created_on, '%m/%d/%Y %h:%i %p')) AS created_on", FALSE);
        $this->db->join('log', 'log.message_entity_id = message.id', 'left');
        $this->db->join('account', 'account.id = message.account_id', 'left');
        $this->db->join('user', 'user.id = message.user_id', 'left');
        $this->db->where('action', 'create');
        $this->db->where('table_name', 'message');
        return $this->db->get('message');
    }

    /**
     * Get all account ids
     * @return all account account ids
     */
    public function getAccountIds()
    {
        $this->db->select('id');
        return $this->db->get('account');
    }

}

/* End of file message_model.php */
/* Location: ./application/models/message_model.php */
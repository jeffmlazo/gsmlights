<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account_model extends CI_Model {

    /**
     * Insert the values of account
     * @param $data the account data
     * @return the insert id
     */
    public function save($data) {
        $this->db->set($data);
        $this->db->insert('account');
        return $this->db->insert_id();
    }

    /**
     * Get the specific account
     * @param $id the id of the specific account
     * $return the account
     */
    public function getAccount($id) {
        $this->db->where('id', $id);
        return $this->db->get('account')->row();
    }

    /**
     * 
     * @return all accounts
     */
    public function getAccounts() {
        return $this->db->get('account');
    }

    /**
     * Get the account of the user by username and password.
     * @param $username the user's username
     * @param $password the user's password
     * $return the user
     */
    public function getUser($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get('user')->row();
    }
}

/* End of file account_model.php */
/* Location: ./application/models/account_model.php */
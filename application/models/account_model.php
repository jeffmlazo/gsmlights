<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Account_model extends CI_Model {

    /**
     * Insert the values of account
     * @param $data the account data
     * @return the insert id
     */
    public function save($data)
    {
        $this->db->set($data);
        $this->db->insert('account');
        return $this->db->insert_id();
    }

    public function update($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('account');
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        // Check if the id's were array
        if (is_array($id))
        {
            // Delete multiple rows
            $this->db->where_in('id', $id);
        }
        else
        {
            // Delete single row
            $this->db->where('id', $id);
        }

        $this->db->delete('account');
        return $this->db->affected_rows();
    }

    /**
     * Get the specific account
     * @param $id the id of the specific account
     * $return the account
     */
    public function getAccount($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('account')->row();
    }

    /**
     * Get all accounts
     * @return all accounts
     */
    public function getAccounts()
    {
        return $this->db->get('account');
    }

}

/* End of file account_model.php */
/* Location: ./application/models/account_model.php */
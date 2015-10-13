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
        /**
         * 2nd parameter SELECT was set to FALSE so that we can use the mysql DATE_FORMAT
         * function and we also rename the column because it is required to call in the controller
         */
        $this->db->select("account.*, DATE_FORMAT(log.created_on, '%m-%d-%Y') AS created_on", FALSE);
        $this->db->join('log', 'account.id = log.entity_id', 'left');
        $this->db->where('action', 'create');
        $this->db->where('table_name', 'user');
        return $this->db->get('account');
    }

}

/* End of file account_model.php */
/* Location: ./application/models/account_model.php */
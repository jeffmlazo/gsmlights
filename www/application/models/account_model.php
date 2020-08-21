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
        /**
         * Check if last_login field will be updated only
         * else all fields will be updated
         */
        if (isset($data['last_login']))
        {
            $this->db->set('last_login', 'NOW()', FALSE);
        }
        else
        {
            $this->db->set($data);
        }

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
     * Get the user by username
     * @param $data the user's username or the id
     * $return the user
     */
    public function getAccount($data)
    {
        if (is_numeric($data))
        {
            $this->db->where('id', $data);
        }
        else
        {
            $this->db->where('username', $data);
        }
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
        $this->db->select("account.*, LOWER(DATE_FORMAT(log.created_on, '%m/%d/%Y %h:%i %p')) AS created_on, job_title.name AS job_title_name, department.name AS department_name", FALSE);
        $this->db->join('log', 'log.account_id = account.id', 'left');
        $this->db->join('job_title', 'job_title.id = account.job_title_id', 'left');
        $this->db->join('department', 'department.id = account.department_id', 'left');
        $this->db->where('action', 'create');
        $this->db->where('table_name', 'account');
        return $this->db->get('account');
    }

    public function getAccountUsername($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('account')->row();
    }

}

/* End of file account_model.php */
/* Location: ./application/models/account_model.php */
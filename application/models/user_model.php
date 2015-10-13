<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class User_model extends CI_Model {

    /**
     * Insert the values of user
     * @param $data the user data
     * @return the insert id
     */
    public function save($data)
    {
        $this->db->set($data);
        $this->db->insert('user');
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
        $this->db->update('user');
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

        $this->db->delete('user');
        return $this->db->affected_rows();
    }

    /**
     * Get the user by username
     * @param $username the user's username
     * $return the user
     */
    public function getUser($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('user')->row();
    }

    /**
     * Get all users
     * @return all users
     */
    public function getUsers()
    {
        return $this->db->get('account');
    }

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */
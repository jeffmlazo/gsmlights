<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Log_model extends CI_Model {

    function save($data, $is_batch = FALSE)
    {
        if ($is_batch)
        {
            $this->db->insert_batch('log', $data);
        }
        else
        {
            if (!isset($data['action']))
            {
                $this->db->set('action', 'create');
            }
            $this->db->set('created_on', 'NOW()', FALSE);
            $this->db->set($data);
            $this->db->insert('log');
        }
    }

    function delete($data)
    {
        $this->db->where($data);
        $this->db->delete('log');
    }

    function getDate($entity_id, $table, $action)
    {
        $this->db->select('created_on');
        $this->db->where('entity_id', $entity_id);
        $this->db->where('table_name', $table);
        $this->db->where('action', $action);
        return $this->db->get('log');
    }

    function getLog($entity_id, $table, $lastlogin = '')
    {
        $this->db->select('entity_id, table_name, action, username, firstname, lastname, created_on');
        $this->db->join('user', 'user.id = log.user_id', 'left');
        $this->db->where('entity_id', $entity_id);
        $this->db->where('table_name', $table);
        if ($lastlogin)
        {
            $this->db->where('log.created_on >=', $lastlogin);
        }
        return $this->db->get('log');
    }

    function getLogs($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get('log');
    }

}

/* End of file log_model.php */
/* Location: ./application/models/log_model.php */
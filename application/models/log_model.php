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

}

/* End of file log_model.php */
/* Location: ./application/models/log_model.php */
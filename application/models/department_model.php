<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Department_model extends CI_Model {

    /**
     * Get the specific department
     * @param $id the id of the specific department
     * $return the department
     */
    public function getDepartment($id) {
        $this->db->where('id', $id);
        return $this->db->get('department')->row();
    }

    /**
     * Get all job departments
     * @return all departments
     */
    public function getDepartments() {
        $this->db->order_by('name', 'asc');
        return $this->db->get('department');
    }

}

/* End of file department_model.php */
/* Location: ./application/models/department_model.php */
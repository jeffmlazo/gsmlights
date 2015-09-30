<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Job_title_model extends CI_Model {

    /**
     * Get the specific job title
     * @param $id the id of the specific job title
     * $return the job title
     */
    public function getJobTitle($id) {
        $this->db->where('id', $id);
        return $this->db->get('job_title')->row();
    }

    /**
     * Get all job titles
     * @return all job titles
     */
    public function getJobTitles() {
        $this->db->order_by('name', 'asc');
        return $this->db->get('job_title');
    }

}

/* End of file job_title_model.php */
/* Location: ./application/models/job_title_model.php */
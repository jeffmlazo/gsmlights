<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * These will be the global form validation rules for all controllers
 */
$config['form_validations'] = array(
    // These validation are for add and edit account/file
    'file_validation' => array(
        array(
            'field' => 'department',
            'label' => 'lang:department',
            'rules' => 'callback_department_check'
        ),
        array(
            'field' => 'job-title',
            'label' => 'lang:job_title',
            'rules' => 'callback_job_title_check'
        ),
        array(
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required|min_length[5]|max_length[20]|callback_username_check'
        ),
        array(
            'field' => 'phone-number',
            'label' => 'lang:phone_number',
            'rules' => 'trim|required|min_length[10]|numeric|is_natural'
        ),
        array(
            'field' => 'firstname',
            'label' => 'lang:firstname',
            'rules' => 'trim|required|min_length[2]|alpha'
        ),
        array(
            'field' => 'middlename',
            'label' => 'lang:middlename',
            'rules' => 'trim|required|min_length[2]|alpha'
        ),
        array(
            'field' => 'lastname',
            'label' => 'lang:lastname',
            'rules' => 'trim|required|min_length[2]|alpha'
        )
    ),
    // These validation are for add and edit user
    'user_validation' => array(
        array(
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required|min_length[5]|max_length[20]|callback_username_check'
        ),
        array(
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required|min_length[6]|max_length[20]'
        )
    )
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */
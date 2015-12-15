<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * These will be the global form validation rules for all controllers
 */
$config['form_validations'] = array(
    'login_validation' => array(
        array(
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required'
        )
    ),
    // These validation is for add account/file
    'add_file_validation' => array(
        array(
            'field' => 'department',
            'label' => 'lang:department',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'job-title',
            'label' => 'lang:job_title',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required|min_length[5]|max_length[20]|callback_username_check'
        ),
        array(
            'field' => 'phone-number',
            'label' => 'lang:phone_number',
            'rules' => 'trim|min_length[10]|numeric|is_natural'
        ),
        array(
            'field' => 'firstname',
            'label' => 'lang:firstname',
            'rules' => 'trim|required|min_length[2]|alpha_space'
        ),
        array(
            'field' => 'middlename',
            'label' => 'lang:middlename',
            'rules' => 'trim|required|min_length[2]|alpha_space'
        ),
        array(
            'field' => 'lastname',
            'label' => 'lang:lastname',
            'rules' => 'trim|required|min_length[2]|alpha_space'
        ),
        array(
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required|min_length[6]|max_length[255]'
        ),
        array(
            'field' => 'confirm-password',
            'label' => 'lang:confirm_password',
            'rules' => 'trim|required|matches[password]'
        )
    ),
    // These validation is edit account/file
    'update_file_validation' => array(
        array(
            'field' => 'department',
            'label' => 'lang:department',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'job-title',
            'label' => 'lang:job_title',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required|min_length[5]|max_length[20]|callback_username_check'
        ),
        array(
            'field' => 'phone-number',
            'label' => 'lang:phone_number',
            'rules' => 'trim|min_length[10]|numeric|is_natural'
        ),
        array(
            'field' => 'firstname',
            'label' => 'lang:firstname',
            'rules' => 'trim|required|min_length[2]|alpha_space'
        ),
        array(
            'field' => 'middlename',
            'label' => 'lang:middlename',
            'rules' => 'trim|required|min_length[2]|alpha_space'
        ),
        array(
            'field' => 'lastname',
            'label' => 'lang:lastname',
            'rules' => 'trim|required|min_length[2]|alpha_space'
        )
    ),
    // These validation are for add user
    'add_user_validation' => array(
        array(
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required|min_length[5]|max_length[20]|callback_username_check'
        ),
        array(
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required|min_length[6]|max_length[255]'
        ),
        array(
            'field' => 'confirm-password',
            'label' => 'lang:confirm_password',
            'rules' => 'trim|required|matches[password]'
        )
    ),
    // These validation are for update user
    'update_user_validation' => array(
        array(
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required|min_length[6]|max_length[255]'
        ),
        array(
            'field' => 'confirm-password',
            'label' => 'lang:confirm_password',
            'rules' => 'trim|required|matches[password]'
        )
    ),
    // These validation are for update user
    'update_account_profile_validation' => array(
        array(
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required|min_length[6]|max_length[255]'
        ),
        array(
            'field' => 'confirm-password',
            'label' => 'lang:confirm_password',
            'rules' => 'trim|required|matches[password]'
        )
    ),
    // These validation are for save message
    'save_message_validation' => array(
        array(
            'field' => 'message',
            'label' => 'lang:message',
            'rules' => 'trim|required|min_length[3]'
        )
    ),
    // These validation are for save department
    'save_department_validation' => array(
        array(
            'field' => 'department',
            'label' => 'lang:department',
            'rules' => 'trim|required|min_length[3]'
        )
    ),
    // These validation are for save job title
    'save_job_title_validation' => array(
        array(
            'field' => 'job-title',
            'label' => 'lang:job_title',
            'rules' => 'trim|required|min_length[3]'
        )
    )
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */
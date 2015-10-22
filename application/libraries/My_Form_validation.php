<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class My_Form_validation extends CI_Form_validation {

    /**
     * MY_Form_validation::alpha_extra().
     * Alpha space chracters only
     */
    function alpha_space($str)
    {
        $this->CI->form_validation->set_message('alpha_space', 'The %s may only contain alpha and space characters.');
        return (!preg_match("/^([a-z_ ])+$/i", $str)) ? FALSE : TRUE;
    }

}

/* End of file My_Form_validation.php */
/* Location: ./application/libraries/My_Form_validation.php  */

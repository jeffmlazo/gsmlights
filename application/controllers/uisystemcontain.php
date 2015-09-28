<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Uisystemcontain extends CI_Controller {
    
        public function main() {
            $this->load->view('uisystemcontain');
        }
        
        public function home() {
            $this->load->view('homepage');
        }
    }

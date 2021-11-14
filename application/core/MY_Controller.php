<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Base_Controller extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
        //do whatever you want to do when object instantiate
    }
}
 
class Secure_Controller extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
 
		if(!$this->session->userdata('user'))
		{
			$this->session->set_flashdata('error', 'Please login!');
			redirect($this->config->item('backend').'/login', 'refresh');
		}


		$this->output->set_template('backend');			
		
    }
}
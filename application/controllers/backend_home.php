<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Home extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 		= "";
		$this->title 		= "Dashboard";
		$this->db_id 		= "";
		$this->controller 	= $this->config->item('backend').'/home';
		$this->alias		= "";
				
		//$this->load->model('basic_model');


	}

    public function index()
    {
        $this->load->view('backend/home');
    }

    public function profile()
    {
        echo "Admin";
    }			

}



<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Backend_Auth extends CI_Controller {
	
    function __construct()
    {
        parent::__construct();
    }	
	
    public function index()
    {
        $this->login();
    }
	

	public function login()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');		
		
		if($this->session->userdata('user'))
		{
			$this->session->set_flashdata('error', 'You are already logged in.');
			redirect($this->config->item('backend').'/home');
		}	

		if($this->input->post('submit') != "")
		{
		
			
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
		
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('backend/login');
				}
				else
				{
					$username = $this->input->post('username');
					$password = $this->input->post('password');
							
					$query = $this->db->query("SELECT *
													FROM `admin` 
													WHERE 1
													AND `admin`.`username` = '".$username."'
													AND `admin`.`password` = '".sha1($password)."'
													");
					$userResult = $query->row_array();	

					
					if(empty($userResult))
					{

						
						$query = $this->db->query("SELECT *
														FROM `staff` 
														WHERE 1
														AND `staff`.`username` = '".$username."'
														AND `staff`.`password` = '".sha1($password)."'
														");
														
														
							$userResult = $query->row_array();
						
										//	pr($userResult);	
						
						
							if(!empty($userResult))
							{
								$userResult['type'] = "staff";
															
							}
							
					}
					else
					{
						$userResult['type'] = "admin";
					}
					
					
							
					
				
					if(!empty($userResult))
					{
		
						$userData['user'] = $userResult;
						$this->session->set_userdata($userData);
						
						$this->session->set_flashdata('success', 'Welcome to Control Panel');
						redirect($this->config->item('backend').'/home');
		
					}
					else
					{
						$this->session->set_flashdata('error', 'Incorrect Login/password.');
						redirect($this->config->item('backend').'/login');  
					}
				}	
		}
		else 
		{
			$this->load->view('backend/login');
		}



	}
	
	public function logout()
	{
				$data['user'] = "";
				$this->session->set_userdata($data);
				$this->session->set_flashdata('success', 'You have successfully logged out.');
				redirect($this->config->item('backend').'/login');  
	}

	
    public function forgotpassword()
    {	
        $this->load->view('backend/forgotpassword');
    }	

		
}
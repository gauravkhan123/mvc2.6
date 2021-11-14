<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()

	{

		parent::__construct();

		$this->load->helper('url');

		$this->output->set_template('frontend');

		$this->load->helper('form');

		$this->load->library('form_validation');	

		$this->load->model('basic_model');

		

		require_once(APPPATH.'libraries/class.upload/class.upload.php');					

	}
	
	function _checkUserSession()

	{

		if(!$this->session->userdata('frontuser'))

		{

			$this->session->set_flashdata('error', 'Please login!');

			redirect(site_url('user/login'));

		}			

	}	



	public function index()

	{

        $this->login();

	}

	
	public function login()

	{

		if($this->session->userdata('frontuser'))

		{

			$this->session->set_flashdata('error', 'You are already logged in.');

			redirect('user/welcome');

		}	



		if($this->input->post('submit') != "")

		{
			
		

				$this->form_validation->set_rules('username', 'Username / Email', 'trim|required|valid_email');

				$this->form_validation->set_rules('password', 'Password', 'trim|required');

		

				if ($this->form_validation->run() == FALSE)

				{

					$this->load->view('frontend/user/login');

				}

				else

				{
					

					require_once(APPPATH.'libraries/recaptcha-php-1.11/recaptchalib.php');
  					$privatekey = "6LegEAYTAAAAAIUu77wGFLXhpUPjbSkaX2JpuzzS";

  					$resp = recaptcha_check_answer ($privatekey,
                                $this->input->ip_address(),
								$this->input->post('recaptcha_challenge_field'),
                                $this->input->post('recaptcha_response_field'));
								
								
						if (!$resp->is_valid) {
							 
							$this->session->set_flashdata('error', 'Verification code is not entered correctly.');
							redirect('user/login');									 
						} 			
					
					

					$query = $this->db->query("SELECT *
													FROM `users` 
													WHERE 1
													AND `username` = '".$this->input->post('username')."'
													AND `password` = '".sha1($this->input->post('password'))."'
													AND `publish` = '1'													
													");

					$userResult=$query->row_array();			


					if(!empty($userResult))

					{
		

						$userData['frontuser'] = $userResult;

						$this->session->set_userdata($userData);

						
						$this->session->set_flashdata('success', 'Welcome to Myaccount Section');

						redirect('user/welcome');

		

					}

					else

					{

						$this->session->set_flashdata('error', 'Incorrect Login/password, or Email is not verified yet');

						redirect('user/login');  

					}

				}	

		}

		else 

		{

			$this->load->section('header', 'frontend/includes/header');

			$this->load->section('footer', 'frontend/includes/footer');

			$this->load->view('frontend/user/login');

		}		

		

	}	


	public function subscriberlogin()

	{


		if($this->session->userdata('frontuser'))

		{

			$this->session->set_flashdata('error', 'You are already logged in.');

			redirect('user/myaccount');

		}	



		if($this->input->post('submit') != "")

		{
			
				$this->form_validation->set_rules('username', 'Username / Email', 'trim|required|valid_email');

				$this->form_validation->set_rules('password', 'Password', 'trim|required');

				if ($this->form_validation->run() == FALSE)

				{

					$this->load->view('frontend/user/subscriberlogin');

				}

				else

				{
					

					require_once(APPPATH.'libraries/recaptcha-php-1.11/recaptchalib.php');
  					$privatekey = "6LegEAYTAAAAAIUu77wGFLXhpUPjbSkaX2JpuzzS";

  					$resp = recaptcha_check_answer ($privatekey,
                                $this->input->ip_address(),
								$this->input->post('recaptcha_challenge_field'),
                                $this->input->post('recaptcha_response_field'));
								
								
						if (!$resp->is_valid) {
							 
							$this->session->set_flashdata('error', 'Verification code is not entered correctly.');
							redirect('user/subscriberlogin');									 
						} 			
	
					$query = $this->db->query("SELECT *
													FROM `subscribers` 
													WHERE 1
													AND `username` = '".$this->input->post('username')."'
													AND (`password` = '".md5($this->input->post('password'))."' OR `password` = '".sha1($this->input->post('password'))."')
													AND `publish` = '1'													
													");

					$userResult=$query->row_array();			


					if(!empty($userResult))

					{
		

						$userData['frontuser'] = $userResult;

						$this->session->set_userdata($userData);
						
						
						$insertLoginActivity['user_id'] = $userResult['id'];
						$insertLoginActivity['ip_address'] = $this->input->ip_address();
						
						$insertLoginActivity['session_id'] = $this->session->userdata('session_id');
						$insertLoginActivity['status'] = 'online';						
						
							$ip = $this->input->ip_address();
							$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

						$insertLoginActivity['location'] = $details->country.", ".$details->city;
						$insertLoginActivity['date'] = current_date("Y-m-d h:i:s");
						$insertLoginActivity['update_date'] = current_date("Y-m-d h:i:s");						
						
						$this->basic_model->add_a_record('subscribers_login_activity', $insertLoginActivity);						

						
						$this->session->set_flashdata('success', 'Welcome to Myaccount Section');

						redirect('user/myaccount');

		

					}

					else

					{

						$this->session->set_flashdata('error', 'Incorrect Login/password, or Email is not verified yet');

						redirect('user/subscriberlogin');  

					}

				}	

		}

		else 

		{

			$this->load->section('header', 'frontend/includes/header');

			$this->load->section('footer', 'frontend/includes/footer');

			$this->load->view('frontend/user/subscriberlogin');

		}		

		

	}	
	
	
	public function subscriberloginpurchase()

	{


		if($this->input->post('submit') != "")

		{
			
		

				$this->form_validation->set_rules('email', 'Username / Email', 'trim|required|valid_email');

				$this->form_validation->set_rules('password', 'Password', 'trim|required');

		

				if ($this->form_validation->run() == FALSE)

				{

					$this->load->view('frontend/confirmpurchase');

				}

				else

				{
					


					$query = $this->db->query("SELECT *
													FROM `subscribers` 
													WHERE 1
													AND `username` = '".$this->input->post('email')."'
													AND (`password` = '".md5($this->input->post('password'))."' OR `password` = '".sha1($this->input->post('password'))."')
													AND `publish` = '1'													
													");

					$userResult=$query->row_array();			


					if(!empty($userResult))

					{
		

						$userData['frontuser'] = $userResult;

						$this->session->set_userdata($userData);

						
						$this->session->set_flashdata('success', 'You have successfully logged in.');

						redirect('home/confirmpurchase');

		

					}

					else

					{

						$this->session->set_flashdata('error', 'Incorrect Login/password, or Email is not verified yet');

						redirect('home/confirmpurchase');  

					}

				}	

		}

	}		
		

	public function logout()

	{

		$userData['frontuser'] = "";

		$this->session->set_userdata($userData);

		$this->session->set_flashdata('success', 'You have successfully logged out.');

		redirect('user/login');  

	}	

	public function subscriberlogout()

	{
		
			$updateSession2['status'] = 'offline';
			
			$this->basic_model->update_a_record('subscribers_login_activity', $updateSession2, 'session_id', $this->session->userdata('session_id'));

		$userData['frontuser'] = "";

		$this->session->set_userdata($userData);

		$this->session->set_flashdata('success', 'You have successfully logged out.');

		redirect('user/subscriberlogin');  

	}		

	public function register()

	{


		if($this->session->userdata('frontuser'))

		{

			$this->session->set_flashdata('error', 'You are already logged in.');

			redirect('user/welcome');

		}	

		//$data['countries'] = $this->basic_model->dropdown_list("SELECT Id,name FROM countries WHERE 1 ORDER BY name ASC");		

		if($this->input->post('submit') != "")

		{	

				$this->form_validation->set_rules('role', 'Role', 'trim|required');

				$this->form_validation->set_rules('name', 'Name', 'trim|required');

				$this->form_validation->set_rules('username', 'Username/Email', 'trim|required|valid_email|is_unique[users.username]');				

				$this->form_validation->set_rules('contact_no', 'Contact No.', 'trim|required');				
				
				$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]');

				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');				

				$this->form_validation->set_rules('country', 'Country', 'trim|required');								

				$this->form_validation->set_rules('specilization_area1', 'Primary Specialization Area', 'trim|required');												

				$this->form_validation->set_rules('agree', 'Agreement', 'trim|required');				


				if ($this->form_validation->run() == FALSE)
				{
					$this->load->section('header', 'frontend/includes/header');

					$this->load->section('footer', 'frontend/includes/footer');

					$this->load->view('frontend/user/register',$data);

				}

				else

				{
/*
					require_once(APPPATH.'libraries/recaptcha-php-1.11/recaptchalib.php');
  					$privatekey = "6LcazAwTAAAAAJaE2q0jn8ah8fQjxvJf7KsX9MrH";

  					$resp = recaptcha_check_answer ($privatekey,
                                $this->input->ip_address(),
								$this->input->post('recaptcha_challenge_field'),
                                $this->input->post('recaptcha_response_field'));
								
						
						pr($_POST,false);
						pr($resp);
						
								
						if (!$resp->is_valid) {
							// What happens when the CAPTCHA was entered incorrectly
						//die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
						//	 "(reCAPTCHA said: " . $resp->error . ")");
							 
							$this->session->set_flashdata('error', 'Verification code is not entered correctly.');
							redirect('user/register');									 
						} 	

							unset($_POST['recaptcha_challenge_field']);	
							unset($_POST['recaptcha_response_field']);							
			
							*/	
							unset($_POST['cpassword']);
							unset($_POST['submit']);
							unset($_POST['agree']);	
															
							
								$raw_pass = $this->input->post('password');
							$_POST['password'] = sha1($this->input->post('password'));
							$_POST['date'] = current_date("Y-m-d h:i:s");								
							$_POST['activation_id'] = randomPass(10);	

							if($this->basic_model->add_a_record('users', $_POST))

							{

								

								$EMAILDATA['ROLE'] 				= $this->input->post('role');

								$EMAILDATA['NAME'] 				= $this->input->post('name');

								$EMAILDATA['USERNAME'] 			= $this->input->post('username');

								$EMAILDATA['LOGINLINK'] 		= '<a href="'.base_url().'user/login/'.'" target="_blank">CLICK HERE TO LOGIN</a>';

								$EMAILDATA['PASSWORD'] 			= $raw_pass;

								$EMAILDATA['SITENAME'] 			= $this->config->item('site_name');
								$EMAILDATA['LOGOPATH'] 			= base_url() . 'assets/themes/frontend/images/logo.png';								

								

								$EMAILDATA['VERIFYLINK'] 		= '<a href="'.site_url('user/verify/'.urlencode($this->input->post('username')).'/'.$_POST['activation_id']).'" target="_blank">CLICK HERE TO VERIFY YOUR ACCOUNT</a>';

																						

								$message = $this->load->view('frontend/emails/register',$EMAILDATA,TRUE);

						

								$this->load->library('email');

								$config['charset'] = 'utf-8';

								$config['wordwrap'] = TRUE;

								$config['mailtype'] = 'html';

								$this->email->initialize($config);

								

								$this->email->clear();

								

								$this->email->to($this->input->post('username'));

								$this->email->from(get_settings('17'));

								$this->email->subject("Registration Complete");

								$this->email->message($message);

						
								$this->email->send();

								$this->session->set_flashdata('success', 'You are successfully registered. You are required to verify your email id by clicking a link sent on your email id to activate your account.');

								redirect('user/login');

							}

							else

							{

								$this->session->set_flashdata('error', 'Registration could not complete succesfully. Please try again.');

								redirect('user/register');

							}

				}	

		}

		else 

		{

			$this->load->section('header', 'frontend/includes/header');

			$this->load->section('footer', 'frontend/includes/footer');

			$this->load->view('frontend/user/register',$data);

		}		

	}	
	
	
	
		public function emailsubscription()

	{


		if($this->input->post('submit') != "")

		{	

				$this->form_validation->set_rules('name', 'Name', 'trim|required');

				$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[email_letter.email]');
			


				if ($this->form_validation->run() == FALSE)
				{
					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/user/emailsubscription',$data);
				}

				else
				{
							unset($_POST['submit']);

							$_POST['date'] = current_date("Y-m-d h:i:s");								


							if($this->basic_model->add_a_record('email_letter', $_POST))

							{

						

								$this->session->set_flashdata('success', 'You are subscribed');

								redirect('user/emailsubscription');

							}

							else

							{

								$this->session->set_flashdata('error', 'Subscription could not complete succesfully. Please try again.');

								redirect('user/emailsubscription');

							}

				}	

		}

		else 

		{

			$this->load->section('header', 'frontend/includes/header');

			$this->load->section('footer', 'frontend/includes/footer');

			$this->load->view('frontend/user/emailsubscription',$data);

		}		

		

	

	}	




	public function verify()

	{

		

					$query = $this->db->query("SELECT Id

													FROM `users` 

													WHERE 1

													AND `username` = '".urldecode($this->uri->segment(3))."'

													AND `activation_id` = '".$this->uri->segment(4)."'													

													");

					$userResult=$query->row_array();		

					

					if(!empty($userResult))

					{



							$data['activation_id'] = "";

							$data['publish'] = 1;


							

							if($this->basic_model->update_a_record('users', $data,'Id',$userResult['Id']))

							{

								$this->session->set_flashdata('success', 'Congrats, your account is acticated successfully, you may now login.');

								redirect('user/login');

							}

		

					}

					else

					{

						$this->session->set_flashdata('error', 'Invalid Request');

						redirect(site_url());  

					}			



	}	

	

	





	public function validateforgotpassword()

	{

		

					$query = $this->db->query("SELECT Id,name,username

													FROM `users` 

													WHERE 1

													AND `username` = '".urldecode($this->uri->segment(3))."'

													AND `activation_id` = '".$this->uri->segment(4)."'													

													");

					$userResult=$query->row_array();		

					

					if(!empty($userResult))

					{

							$rawpassword = randomPass(6);

							$data['password'] =  sha1($rawpassword);

							$data['activation_id'] = "";

							

							if($this->basic_model->update_a_record('users', $data,'Id',$userResult['Id']))

							{

								

								$data['NAME'] 				= $userResult['name'];

								$data['USERNAME'] 			= $userResult['username'];

								$data['PASSWORD'] 			= $rawpassword;								

								$data['SITENAME'] 			= $this->config->item('site_name');
								
								$data['LOGOPATH'] 			= base_url() . 'assets/themes/frontend/images/logo.png';
								
								

																						

								$message = $this->load->view('frontend/emails/forgot-validated',$data,TRUE);

						

								$this->load->library('email');

								$config['charset'] = 'utf-8';

								$config['wordwrap'] = TRUE;

								$config['mailtype'] = 'html';

								$this->email->initialize($config);

								

								$this->email->clear();

								

								$this->email->to($userResult['username']);

								$this->email->from(get_settings('17'));

								$this->email->subject("Reset Password");

								$this->email->message($message);

								$this->email->send();													

								

								$this->session->set_flashdata('success', 'Password reset successfully and emailed to your');

								redirect('user/login');

							}

							else

							{

								$this->session->set_flashdata('error', 'Sorry password reset process could not complete. Please try again.');

								redirect('user/forgotpassword');

							}

		

					}

					else

					{

						$this->session->set_flashdata('error', 'Password request is not valid.');

						redirect('user/forgotpassword');  

					}					

					

					

		

	}



	public function forgotpassword()

	{



		if($this->input->post('submit') != "")

		{

		

				$this->form_validation->set_rules('username', 'Username/Email', 'trim|required|valid_email');

		

				if ($this->form_validation->run() == FALSE)

				{

					$this->load->section('header', 'frontend/includes/header');

					$this->load->section('footer', 'frontend/includes/footer');

					$this->load->view('frontend/user/forgot-password');

				}

				else

				{

					

					require_once(APPPATH.'libraries/recaptcha-php-1.11/recaptchalib.php');
  					$privatekey = "6LegEAYTAAAAAIUu77wGFLXhpUPjbSkaX2JpuzzS";

  					$resp = recaptcha_check_answer ($privatekey,
                                $this->input->ip_address(),
								$this->input->post('recaptcha_challenge_field'),
                                $this->input->post('recaptcha_response_field'));
								
						if (!$resp->is_valid) {
							// What happens when the CAPTCHA was entered incorrectly
						//die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
						//	 "(reCAPTCHA said: " . $resp->error . ")");
							 
							$this->session->set_flashdata('error', 'Verification code is not entered correctly.');
							redirect('user/forgotpassword');									 
						} 	
							

					$query = $this->db->query("SELECT id,name,username

													FROM `users` 

													WHERE 1

													AND `username` = '".$this->input->post('username')."'

													AND `publish` = 1													

													");

					$userResult=$query->row_array();

		

					if(!empty($userResult))

					{

							

							$activation_id = randomPass(10);

							

							$data['activation_id'] = $activation_id;

							

							if($this->basic_model->update_a_record('users', $data,'id',$userResult['id']))
							{

								

								$data['NAME'] 				= $userResult['name'];

								$data['EMAIL'] 				= $userResult['username'];

								$data['RESETLINK'] 			= '<a href="'.base_url().'user/validateforgotpassword/'.urlencode($userResult['username']).'/'.$activation_id.'" target="_blank">CLICK HERE TO LOGIN</a>';

								$data['SITENAME'] 			= $this->config->item('site_name');

								$data['IP_ADDRESS'] 		= $this->input->ip_address();
								$data['LOGOPATH'] 			= base_url() . 'assets/themes/frontend/images/logo.png';

																						

								$message = $this->load->view('frontend/emails/resetpassword',$data,TRUE);

						

								$this->load->library('email');

								$config['charset'] = 'utf-8';

								$config['wordwrap'] = TRUE;

								$config['mailtype'] = 'html';

								$this->email->initialize($config);

								

								$this->email->clear();

								

								$this->email->to($this->input->post('username'));

								$this->email->from(get_settings('17'));

								$this->email->subject("Reset Password");

								$this->email->message($message);

								$this->email->send();										

								

								

								$this->session->set_flashdata('success', 'Please check your email and click on the provided link to reset your password.');

								redirect('user/forgotpassword');

							}

							else

							{

								$this->session->set_flashdata('error', 'Sorry password could not reset. Please try again.');

								redirect('user/forgotpassword');

							}

		

					}

					else

					{

						$this->session->set_flashdata('error', 'Sorry email is not yet registered with us.');

						redirect('user/forgotpassword');  

					}

				}	

		}

		else 

		{

			$this->load->section('header', 'frontend/includes/header');

			$this->load->section('footer', 'frontend/includes/footer');

			$this->load->view('frontend/user/forgot-password');

		}				



	}	

	

	public function welcome()

	{



		$this->_checkUserSession();	



		$data['userdata'] = $this->session->userdata('frontuser');		

		

		$this->load->section('header', 'frontend/includes/header');

		$this->load->section('footer', 'frontend/includes/footer');

		$this->load->view('frontend/user/welcome',$data);

	}	

	
	public function myaccount()

	{

		$this->_checkUserSession();



			$data['userdata'] = $this->session->userdata('frontuser');		

			$this->load->section('header', 'frontend/includes/header');
			$this->load->section('footer', 'frontend/includes/footer');
			$this->load->view('frontend/user/myaccount',$data);

		

	}	
	

	public function editprofile()

	{

		

		$this->_checkUserSession();



		$data['userdata'] = $this->session->userdata('frontuser');

		$data['countries'] = $this->basic_model->dropdown_list("SELECT Id,name FROM countries WHERE 1 ORDER BY name ASC");



		if($this->input->post('submit') != "")

		{	
		

				$this->form_validation->set_rules('role', 'Role', 'trim|required');

				$this->form_validation->set_rules('name', 'Name', 'trim|required');

				$this->form_validation->set_rules('contact_no', 'Telephone No.', 'trim|required');				

				$this->form_validation->set_rules('specilization_area1', 'Primary Specialization Area', 'trim|required');												
				
				$this->form_validation->set_rules('country', 'Country', 'trim|required');

				$this->form_validation->set_rules('password', 'Password', 'trim|matches[cpassword]');

				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim');				
				

				if ($this->form_validation->run() == FALSE)
				{

					$this->load->section('header', 'frontend/includes/header');

					$this->load->section('footer', 'frontend/includes/footer');

					$this->load->view('frontend/user/editprofile',$data);

				}
				else
				{

							$postData = $this->input->post();

							if($this->input->post('password') == "")
							{
								unset($postData['password']);
							}
							else
							{
								$postData['password'] = sha1($this->input->post('password'));
							}


							if($postData['newsletter'])
							{
								$postData['newsletter'] = 1;	
							}
							else
							{
								$postData['newsletter'] = 0;	
							}

							unset($postData['username']);
							unset($postData['cpassword']);
							unset($postData['submit']);
							

							$postData['update_date'] = current_date("Y-m-d h:i:s");

//							pr($postData);

							if($this->basic_model->update_a_record('users', $postData,'Id',$data['userdata']['Id']))
							{

								

					$query = $this->db->query("SELECT *

													FROM `users` 

													WHERE 1

													AND `Id` = '".$data['userdata']['Id']."'

													");

					$userResult=$query->row_array();

					

								$userData['frontuser'] = $userResult;

								$this->session->set_userdata($userData);

								

								$this->session->set_flashdata('success', 'Profile is successfully updated.');

								redirect('user/myaccount');

							}

							else

							{

								$this->session->set_flashdata('error', 'Profile could not update. Please try again.');

								redirect('user/myaccount');

							}

				}	

		}

		else 

		{

			$this->load->section('header', 'frontend/includes/header');

			$this->load->section('footer', 'frontend/includes/footer');

			$this->load->view('frontend/user/editprofile',$data);

		}			

		

	}	

	

	public function reviewercoupons()

	{



		$this->_checkUserSession();



		$data['userdata'] = $this->session->userdata('frontuser');		

		

		$this->load->section('header', 'frontend/includes/header');

		$this->load->section('footer', 'frontend/includes/footer');

		$this->load->view('frontend/user/reviewercoupons',$data);

	}		

	

	public function submitmanuscript()

	{



		$this->_checkUserSession();



		$data['userdata'] = $this->session->userdata('frontuser');

		

		

		if($this->input->post('submit') != "")

		{	
		

				$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required');

				$this->form_validation->set_rules('journal_id', 'Journal', 'trim|required');

				$this->form_validation->set_rules('title', 'Title', 'trim|required');	

				$this->form_validation->set_rules('article_type', 'Article Type', 'trim|required');

				$this->form_validation->set_rules('abstract', 'Abstract', 'trim|required');

				$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');

				

				$this->form_validation->set_rules('ca_name', 'Name', 'trim|required');

				$this->form_validation->set_rules('ca_address', 'Address & Affiliation', 'trim|required');

				$this->form_validation->set_rules('ca_email', 'Email', 'trim|required');

				

				$this->form_validation->set_rules('rv_name_e', 'Name', 'trim');

				$this->form_validation->set_rules('rv_address_e', 'Address', 'trim');

				$this->form_validation->set_rules('rv_email_e', 'Email', 'trim');	

				

				$this->form_validation->set_rules('rv_name_f', 'Name', 'trim');

				$this->form_validation->set_rules('rv_address_f', 'Address', 'trim');

				$this->form_validation->set_rules('rv_email_f', 'Email', 'trim');								

				

				$this->form_validation->set_rules('ms_word_file', 'Manuscript File', 'trim');

				$this->form_validation->set_rules('agree', 'agree', 'trim|required');

		

				if ($this->form_validation->run() == FALSE)

				{

					$this->load->section('header', 'frontend/includes/header');

					$this->load->section('footer', 'frontend/includes/footer');

					$this->load->view('frontend/user/submitmanuscript',$data);

				}

				else

				{
					
				///////////////////////
					$handle = new Upload($_FILES['ms_word_file']);
					$handle->allowed = array('application/pdf','application/msword','text/plain','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/zip', 'application/x-compressed-zip');

					if ($handle->uploaded) {
						$handle->Process('media/manuscripts/'.date("/Y/M/",time()));
						$_POST['ms_word_file'] = $handle->file_dst_name;
						$handle->Clean();		
					}

				///////////////////////	
								

							$postData = $this->input->post();

							$postData['author_id'] = $data['userdata']['Id'];

							$postData['status'] = 3;

							

							unset($postData['submit']);							

							unset($postData['agree']);														

							$postData['date'] = current_date("Y-m-d h:i:s");

							if($this->basic_model->add_a_record('manuscript', $postData))

							{

								

								

								$EMAILDATA['ROLE'] 				= str_replace("_"," / ",$data['userdata']['role']);

								$EMAILDATA['NAME'] 				= $data['userdata']['name'];

								$EMAILDATA['USERNAME'] 			= $data['userdata']['username'];

								$EMAILDATA['MANUSCRIPTNUMBER'] 	= manuscriptNo($this->db->insert_id());

																						

								$message = $this->load->view('frontend/emails/register',$EMAILDATA,TRUE);

						

								$this->load->library('email');

								$config['charset'] = 'utf-8';

								$config['wordwrap'] = TRUE;

								$config['mailtype'] = 'html';

								$this->email->initialize($config);

								

								$this->email->clear();

								

								$this->email->to($data['userdata']['username']);

								$this->email->to(get_settings('8'));								

								$this->email->from(get_settings('17'));

								$this->email->subject("Registration Complete");

								$this->email->message($message);

								

								

								$this->email->send();								

								

								$this->session->set_flashdata('success', 'Your manuscript is successfully submitted.');

								redirect('user/inprocessmanuscript');

							}

							else

							{

								$this->session->set_flashdata('error', 'Profile could not update. Please try again.');

								redirect('user/submitmanuscript');

							}

				}	

		}

		else 

		{

			$this->load->section('header', 'frontend/includes/header');

			$this->load->section('footer', 'frontend/includes/footer');

			$this->load->view('frontend/user/submitmanuscript',$data);

		}			

		



	}	

	public function inprocessmanuscript()

	{



		$this->_checkUserSession();	



		$data['userdata'] = $this->session->userdata('frontuser');		

		

		$this->load->section('header', 'frontend/includes/header');

		$this->load->section('footer', 'frontend/includes/footer');

		$this->load->view('frontend/user/inprocessmanuscript',$data);

	}	

	

	public function publishedmanuscript()

	{



		$this->_checkUserSession();	



		$data['userdata'] = $this->session->userdata('frontuser');		

		

		$this->load->section('header', 'frontend/includes/header');

		$this->load->section('footer', 'frontend/includes/footer');

		$this->load->view('frontend/user/publishedmanuscript',$data);

	}	

	

	public function othersmanuscript()

	{



		$this->_checkUserSession();	



		$data['userdata'] = $this->session->userdata('frontuser');		

		

		$this->load->section('header', 'frontend/includes/header');

		$this->load->section('footer', 'frontend/includes/footer');

		$this->load->view('frontend/user/othersmanuscript',$data);

	}	
	
	
	
	
	public function subcentral()

	{

		$this->_checkUserSession();



			$data['userdata'] = $this->session->userdata('frontuser');	
			
			pr($data['userdata']);
	
			$data['profile'] = get_one_record("SELECT * FROM users WHERE Id = '".$data['userdata']['id']."'");
			
			pr($data['profile']);

		

			$this->load->section('header', 'frontend/includes/header');

			$this->load->section('footer', 'frontend/includes/footer');

			$this->load->view('frontend/user/subcentral',$data);

		

	}	
	
	
	

	public function subscriptions()

	{


		if(!$this->session->userdata('frontuser'))

		{

			$this->session->set_flashdata('error', 'Please login!');

			redirect('user/login', 'refresh');

		}


		$userData['data'] = $this->session->userdata('frontuser');
		
		
		$permissions = $this->basic_model->edit_record("subscribers", "id", $userData['data']['id']);
		
		$userData['permissions'] = $permissions['permissions'];

		if($this->input->post('submit') != "")

		{

		

				$this->form_validation->set_rules('name', 'Name', 'trim|required');

				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');				

				$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[cpassword]');

				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required');				

		

				if ($this->form_validation->run() == FALSE)

				{

					$this->load->section('header', 'frontend/includes/header');

					$this->load->section('footer', 'frontend/includes/footer');

					$this->load->view('frontend/user/subscriptions');

				}

				else

				{



							$data['name'] = $this->input->post('name');

							$data['email'] = $this->input->post('email');

							$data['password'] = sha1($this->input->post('password'));

							

							

							if($this->basic_model->update_a_record('users', $data,'id',$userData['data']['id']))

							{					

								$this->session->set_flashdata('success', 'Your profile updated successfully.');

								redirect('user/subscriptions');

							}

							else

							{

								$this->session->set_flashdata('error', 'Sorry profile could not updated. Please try again.');

								redirect('user/subscriptions');

							}

				}	

		}

		else 

		{

			$this->load->section('header', 'frontend/includes/header');

			$this->load->section('footer', 'frontend/includes/footer');

			$this->load->view('frontend/user/subscriptions',$userData);

		}			

		

	}	


	public function getjournal()

	{

        $journals = get_few_record("select * from journals WHERE 1 AND publish = 1 AND main_cat = '".$this->input->post('journal_id')."' order by name");

        

		$data = '<option value="">--Select--</option>';

		

        if(count($journals))

        {

			foreach($journals as $value)

			{

				$data .= '<option value="'.$value['Id'].'">'.$value['name'].'</option>';

			}

        }

		

		echo $data;

		exit;		



	}
	

private function randomPass($numchar) 

{ 

    $word = "a,b,c,d,e,f,g,h,i,j,k,l,m,1,2,3,4,5,6,7,8,9,0"; 

    $array=explode(",",$word); 

    shuffle($array); 

    $newstring = implode($array,""); 

    return substr($newstring, 0, $numchar); 

} 	



}
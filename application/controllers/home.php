<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');

		$this->output->set_template('frontend');
		
		$this->load->helper('form');

		$this->load->library('form_validation');	

		$this->load->model('basic_model');
		
	}

	public function index()
	{
		$meta = getMetaTags('','','default');
		$this->output->set_common_meta($meta['title_tag'], $meta['meta_keyword_tag'], $meta['meta_desc_tag']);		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/home');
	}
	
	public function page_404()
	{
		$meta = getMetaTags('','','default');
		$this->output->set_common_meta($meta['title_tag'], $meta['meta_keyword_tag'], $meta['meta_desc_tag']);		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/page-404');
	}	
	
	public function search()
	{
		$meta = getMetaTags('','','','1');
		$this->output->set_common_meta($meta['title_tag'], $meta['meta_keyword_tag'], $meta['meta_desc_tag']);			
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/googlesearchresults');
	}	
	
	public function advancedsearch()
	{
		
					$this->load->model('articles_model');
					$this->load->model('basic_model');					
					$this->load->library('pagination');
					
					$data['subjects'] = $this->basic_model->dropdown_list("SELECT Id,name FROM categories_spl WHERE 1 ORDER BY name ASC");	

/////////////filter starts
					$condition = "WHERE 1";
					
					
					
					if($this->uri->segment(2))
					{
							$searchVars = $this->uri->segment(2);
							
							
							//$searchVars = "filter-".implode("-",$searchVars);
							//$condition
							//$data['getvars']

													
					}
					else
					{
							$searchVars = "filter-Id:-q1:-q1f:-opr:-q2:-q2f:-sb:-yearOpt:-fromDate:-toDate:-v:-i:-p:";
					}


					$config['base_url'] = site_url($this->config->item('backend').'/articles/listing/'.$searchVars);					
					$config['total_rows'] = $this->articles_model->total_results_advancedsearch($condition);

					$config['per_page'] = 20;
					$config['uri_segment'] = 3;
							
					//		$config['display_pages'] = FALSE;
					//		$config['first_link']  = TRUE;
					//		$config['last_link']  = TRUE;
					//		$config['use_page_numbers'] = TRUE;		
					//		$config['next_link'] = '&larr; Older posts';
					//		$config['next_tag_open'] = '<p class="meta-nav-prev">';
					//		$config['next_tag_close'] = '</p>';	
					//		$config['prev_link'] = 'Newer posts &rarr;';
					//		$config['prev_tag_open'] = '<p class="meta-nav-next">';
					//		$config['prev_tag_close'] = '</p>';
		
					$this->pagination->initialize($config);
					$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;		
					$data['pagination'] = $this->pagination->create_links();
					$data['coloums'] = $this->articles_model->listing_advancedsearch($condition,$offset,$config['per_page']);		
					
					$data['startvalue'] = $offset+1;
					$data['endvalue'] = $offset + 20;					
					$data['totalvalue'] = $config['total_rows'];		
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/advancedsearch',$data);
	}			

	
	public function contact()
	{

			$this->load->helper('form');
			$this->load->library('form_validation');
			
			if($this->input->post('submit')!='')
				{
					
						$this->form_validation->set_rules('name', 'Name', 'trim|required');
						$this->form_validation->set_rules('affiliation', 'Company / Affiliation', 'trim|required');
						$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
						$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
						$this->form_validation->set_rules('comments', 'Comments', 'trim|required');
				
						if ($this->form_validation->run() == FALSE)
						{
							$this->load->section('header', 'frontend/includes/header');
							$this->load->section('footer', 'frontend/includes/footer');
							$this->load->view('frontend/contact');
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
							redirect('contact-us');									 
						} 								
			
                        $data['site_name'] 		= $this->config->item('site_name');
						$data['name'] 			= $this->input->post('name');
						$data['company'] 		= $this->input->post('affiliation');		
						$data['email'] 			= $this->input->post('email');;
						$data['contact_no'] 	= $this->input->post('contact_no');
						$data['comments'] 		= $this->input->post('comments');
						$data['ip_address'] 	= $this->input->ip_address();
						$data['logo_path']		= base_url() . 'assets/themes/frontend/images/logo.png';
						
						
														
						$message = $this->load->view('frontend/emails/contact-form',$data,TRUE);

		
							$this->load->library('email');
							$config['charset'] = 'utf-8';
							$config['wordwrap'] = TRUE;
							$config['mailtype'] = 'html';
							$this->email->initialize($config);
							
							$this->email->clear();
							
							$this->email->to(get_settings('8'));
							$this->email->from(get_settings('17'));
							$this->email->subject("Website Form");
							$this->email->message($message);
							$this->email->send();					
							
							
							$this->session->set_flashdata('msg', 'Thanks for contact with us.');
							redirect('page/thank-you');
							//redirect('home/contact');
						}
	
				} 
				else 
				{
					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/contact');
				}			
							
					

	}		
	
	public function paynow()
	{
		
		$this->load->model('basic_model');							
		
		$data['aid'] = $this->uri->segment(2);
		$data['file'] = $this->uri->segment(3);
		
		$this->load->model('articles_model');
		$data['articledetails'] = $this->articles_model->file_detail_to_download($data['aid']);
		
		$data['price'] = get_one_record("SELECT full_article_price FROM journals WHERE 1 AND Id='".$data['articledetails']['main_cat']."'");
		
		
		
			$this->load->helper('form');
			$this->load->library('form_validation');
			
				if($this->input->post('submit')!='')
				{

							$insertData['file_name'] = $data['file'];
							$insertData['mode'] = 'paypal';
							$insertData['validity_hours'] = '24';	
							$insertData['mc_gross'] = $data['price']['full_article_price'];		
							$insertData['article_id'] = $data['aid'];		
							$insertData['date'] = current_date("Y-m-d h:i:s");		
							$insertData['ip_address'] = $this->input->ip_address();																							

							
							if($this->basic_model->add_a_record('article_orders', $insertData))
							{
								
								$lastinsertid = $this->db->insert_id();
							
								$paypaldata['item_name'] = strip_tags($data['articledetails']['name']);
								$paypaldata['amount'] = $data['price']['full_article_price'];
								$paypaldata['return_url'] = site_url("articlesuccess/".$data['aid']."/".$data['file']);
								$paypaldata['cancel_return'] = site_url('articlecancel');
								$paypaldata['ipn_url'] = site_url("ipn.php");													

									$articledetails = get_one_record("SELECT provisional_pdf_file,pdf_file,html_file FROM articles WHERE 1 AND Id='".$data['aid']."'");
									
							
									if($articledetails['pdf_file'] == $data['file'])
									{
										$field = "pf";			
									}
									else if($articledetails['provisional_pdf_file'] == $data['file'])
									{
										$field = "ppf";			
									}
									else if($articledetails['html_file'] == $data['file'])
									{
										$field = "hf";			
									}		
									else
									{
										$field = "pf";			
									}								
								
											
								$paypaldata['custom'] = $data['aid']."**".$data['file']."**24**".$lastinsertid."**".site_url('download/'.base64url_encode($data['aid'].'@@'.$field));
								
//								pr($paypaldata);
							
								$this->load->section('header', 'frontend/includes/header');
								$this->load->section('footer', 'frontend/includes/footer');
								$this->load->view('frontend/payments/buy_full_article',$paypaldata);
							}
	
				} 
				else 
				{		
					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/payments/paynow',$data);
				}

	}
	
	public function articlecancel()
	{
		
	
					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/payments/articlecancel');


	}
	
	
	
	public function institutes()
	{
		
				if($this->input->post('submit')!='')
				{
					
//					pr($_POST);
					 
					unset($_POST['submit']);
					$userData['subscription'] = $_POST;
					$this->session->set_userdata($userData);
					
					
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
							redirect('institutes');									 
						} 						
						
						if (empty($userData['subscription']['journal']))
						{
							$this->session->set_flashdata('error', 'Please select at least one product to subscribe for.');
							redirect('institutes');									 
						} 						
						
						
					
								$this->session->set_flashdata('success', 'Please confirm your purchase and fill billing details.');
								redirect('home/confirmpurchase');					
					
				}
		
		
		$data['data'] = $this->basic_model->edit_record('pricing', 'id', '1');
		
		$data['pricing'] = unserialize($data['data']['pricing']);

		
					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/institutes',$data);
					

	/*	
		
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

					$this->load->view('frontend/institutes');

				}

				else

				{



							$data['name'] = $this->input->post('name');

							$data['email'] = $this->input->post('email');

							$data['password'] = sha1($this->input->post('password'));

							

							

							if($this->basic_model->update_a_record('users', $data,'id',$userData['data']['id']))

							{					

								$this->session->set_flashdata('success', 'Your profile updated successfully.');

								redirect('frontend/institutes');

							}

							else

							{

								$this->session->set_flashdata('error', 'Sorry profile could not updated. Please try again.');

								redirect('frontend/institutes');

							}

				}	

		}

		else 

		{

					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/institutes');

		}		*/		
	
	}	
	
	public function confirmpurchase()
	{

					
					$data['countries'] = $this->basic_model->dropdown_list("SELECT Id,name FROM countries WHERE 1 ORDER BY name ASC");		
		
					$subscriptionData = $this->session->userdata('subscription');
					
					$data['userdata'] = $this->session->userdata('frontuser');
					

					if(empty($subscriptionData['journal']))
					{
						
							$this->session->set_flashdata('error', 'Invalid Request !!');
							redirect('home/institutes');						
						
					}
					
				if($this->input->post('submit')!='')
				{
					
								
					
							$insertData['user_id'] = $data['userdata']['id'];
							$insertData['subscription_for'] = serialize($subscriptionData);
							$insertData['contact_person'] = $this->input->post('name');				
							$insertData['institute_name'] = $this->input->post('institute_name');														
							$insertData['email'] = $this->input->post('username');														
							$insertData['contact_no'] = $this->input->post('contact_no');														
							$insertData['address1'] = $this->input->post('address1');														
							$insertData['address2'] = $this->input->post('address2');							
							$insertData['country'] = $this->input->post('country');																																										
							$insertData['state'] = $this->input->post('state');
							$insertData['city'] = $this->input->post('city');
							$insertData['zip'] = $this->input->post('zip');
							$insertData['mode'] = 'paypal';
							$insertData['ip_address'] = $this->input->ip_address();																														
							$insertData['validity'] = '1';	
							$insertData['mc_gross'] = $this->input->post('mc_gross');
							$insertData['date'] = current_date("Y-m-d h:i:s");		

							
							if($this->basic_model->add_a_record('subscriptions', $insertData))
							{
								
								$lastinsertid = $this->db->insert_id();
							
								$paypaldata['item_name'] = "Multiple Products";
								$paypaldata['amount'] = $this->input->post('mc_gross');
								$paypaldata['return_url'] = site_url("home/subscriptionsuccess");
								$paypaldata['cancel_return'] = site_url('home/subscriptioncancel');
								$paypaldata['ipn_url'] = site_url("ipn-subscription.php");													
	
								$paypaldata['custom'] = $lastinsertid;
								
//								pr($paypaldata);
							
								$this->load->section('header', 'frontend/includes/header');
								$this->load->section('footer', 'frontend/includes/footer');
								$this->load->view('frontend/payments/buy_subscription',$paypaldata);
							}
	
				}
				
				
				else if($this->input->post('submitRegister')!='')
				{
					
					$this->form_validation->set_rules('name', 'Name', 'trim|required');
					$this->form_validation->set_rules('username', 'Email', 'trim|required|valid_email');					
					$this->form_validation->set_rules('institute_name', 'Institute Name', 'trim|required');				
					$this->form_validation->set_rules('contact_no', 'Telephone No.', 'trim|required');				
					$this->form_validation->set_rules('country', 'Country', 'trim|required');
		
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->section('header', 'frontend/includes/header');
						$this->load->section('footer', 'frontend/includes/footer');
						$this->load->view('frontend/confirmpurchase',$data);
					}
					else
					{						
					

									$insertUser['name'] = $this->input->post('name');				
									$insertUser['username'] = $this->input->post('username');														
									$insertUser['institute_name'] = $this->input->post('institute_name');																							
									$insertUser['contact_no'] = $this->input->post('contact_no');														
									$insertUser['address1'] = $this->input->post('address1');														
									$insertUser['address2'] = $this->input->post('address2');							
									$insertUser['country'] = $this->input->post('country');																																										
									$insertUser['state'] = $this->input->post('state');
									$insertUser['city'] = $this->input->post('city');
									$insertUser['zip'] = $this->input->post('zip');
									$insertUser['date'] = current_date("Y-m-d h:i:s");
									$insertUser['publish'] = '0';
							
									$this->basic_model->add_a_record('subscribers', $insertUser);
									
									$lastinsertid = $this->db->insert_id();									
												

							$insertData['user_id'] = $lastinsertid;
							$insertData['subscription_for'] = serialize($subscriptionData);
							$insertData['contact_person'] = $this->input->post('name');				
							$insertData['institute_name'] = $this->input->post('institute_name');														
							$insertData['email'] = $this->input->post('username');														
							$insertData['contact_no'] = $this->input->post('contact_no');														
							$insertData['address1'] = $this->input->post('address1');														
							$insertData['address2'] = $this->input->post('address2');							
							$insertData['country'] = $this->input->post('country');																																										
							$insertData['state'] = $this->input->post('state');
							$insertData['city'] = $this->input->post('city');
							$insertData['zip'] = $this->input->post('zip');
							$insertData['mode'] = 'paypal';
							$insertData['ip_address'] = $this->input->ip_address();																														
							$insertData['validity'] = '1';	
							$insertData['mc_gross'] = $this->input->post('mc_gross');
							$insertData['date'] = current_date("Y-m-d h:i:s");		


							if($this->basic_model->add_a_record('subscriptions', $insertData))
							{
								
								$lastinsertid = $this->db->insert_id();
							
								$paypaldata['item_name'] = "Multiple Products";
								$paypaldata['amount'] = $this->input->post('mc_gross');;
								$paypaldata['return_url'] = site_url("subscriptionsuccess/");
								$paypaldata['cancel_return'] = site_url('subscriptioncancel');
								$paypaldata['ipn_url'] = site_url("ipn-subscription.php");													
	
								$paypaldata['custom'] = $lastinsertid;
							
								$this->load->section('header', 'frontend/includes/header');
								$this->load->section('footer', 'frontend/includes/footer');
								$this->load->view('frontend/payments/buy_subscription',$paypaldata);
							}
					}
	
				}				
				else
				{
		
					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/confirmpurchase',$data);
				}
	}	



	public function validses()
	{
		$id = $this->uri->segment(2);		
		
		$userData['validses'] = $id;
		$this->session->set_userdata($userData);		


		redirect(site_url());
	}
	
	public function articlesuccess()
	{
		
		$data['aid'] = $this->uri->segment(2);
		$data['file'] = $this->uri->segment(3);
		
		
		$data['articledetails'] = get_one_record("SELECT provisional_pdf_file,pdf_file,html_file FROM articles WHERE 1 AND Id='".$data['aid']."'");
		

		if($data['articledetails']['pdf_file'] == $data['file'])
		{
			$data['field'] = "pf";			
		}
		else if($data['articledetails']['provisional_pdf_file'] == $data['file'])
		{
			$data['field'] = "ppf";			
		}
		else if($data['articledetails']['html_file'] == $data['file'])
		{
			$data['field'] = "hf";			
		}		
		else
		{
			$data['field'] = "pf";			
		}				
		
					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/payments/articlesuccess',$data);


	}	
	
	
	public function subscriptionsuccess()
	{
		
					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/payments/subscriptionsuccess',$data);


	}		
	
	public function subscriptioncancel()
	{
		
					$this->load->section('header', 'frontend/includes/header');
					$this->load->section('footer', 'frontend/includes/footer');
					$this->load->view('frontend/payments/subscriptioncancel',$data);


	}		
	
	public function updateses()
	{
		mysql_query("UPDATE `subscribers_login_activity` set status = 'offline' where status = 'online' and update_date < '".date('Y-m-d h:i:s', strtotime('-15 Minutes'))."'");
		
		die("ok");
	}			
	
	

	
}
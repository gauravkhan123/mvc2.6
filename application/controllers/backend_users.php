<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Users extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 			= "users";
		$this->title 			= "Users";
		$this->title_plural		= $this->title.'';
		$this->db_id 			= "Id";
		$this->controller 		= $this->config->item('backend').'/users';
		$this->alias			= "";
		$this->view_folder		= "backend/users/";

		$this->first_field		= "name";
		$this->status_field		= "publish";
		
		$this->action_add		= TRUE;
		$this->action_view		= TRUE;
		$this->action_status	= TRUE;
		$this->action_edit		= TRUE;
		$this->action_delete	= ($this->session->userdata['user']['type'] == 'admin') ? TRUE : FALSE;
				
		$this->load->model('basic_model');

		require_once(APPPATH.'libraries/class.upload/class.upload.php');
	}


	public function index()
	{
		$this->listing();
	}
	
	
	public function listing()
	{
		
					$this->load->model('users_model');
					$this->load->library('pagination');

					
/////////////filter starts
					$condition = "WHERE 1";
					
					if($this->uri->segment(4))
					{
							$searchVars = $this->uri->segment(4);

							$searchVars = explode("-",$searchVars);

							unset($searchVars['0']);
							
//							pr($searchVars);
							
							foreach($searchVars as $value)
							{
								$value = explode(":",$value);
								
								if($value[1])
								{
									$value[1] = trim($value[1]);
									
									if($value[0] == 'role')
									{
										$condition .= " AND role = '".$value[1]."' ";	
									}																
									else
									{
										$condition .= " AND $value[0] like '%".trim(urldecode($value[1]))."%'";
									}
									
									$data['getvars'][$value[0]] = $value[1];
								}
							}	
							
							$searchVars = "filter-".implode("-",$searchVars);
													
					}
					else
					{
							$searchVars = "filter-name:-username:-specilization_area1:-role:-country:";	
					}
					
/////////////filter ends					
//					pr($condition);
	//				pr($searchVars);					

					$config['base_url'] = site_url($this->config->item('backend').'/users/listing/'.$searchVars);
					
					
					$config['total_rows'] = $this->users_model->total_results_backend($condition);
					$config['per_page'] = 20;
					$config['uri_segment'] = 5;
							
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
					$offset = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;		
					$data['pagination'] = $this->pagination->create_links();
					$data['coloums'] = $this->users_model->listing_backend($condition,$offset,$config['per_page']);		
					
					
					$data['startvalue'] = $offset+1;
					$data['endvalue'] = $offset + 20;					
					$data['totalvalue'] = $config['total_rows'];

		
		$this->load->view($this->view_folder.'list',$data);
	}	
	
	
	public function add()
	{
			$this->load->helper('form');
			$this->load->library('form_validation');
			

			
			$data['id'] = "";				
			$data['title'] = "Add " . $this->title;
			$data['countries'] = $this->basic_model->dropdown_list("SELECT Id,name FROM countries WHERE 1 ORDER BY name ASC");				
			
			if($this->input->post('submit')!='')
			{
				
				///////////////////////
					$handle = new Upload($_FILES['ms_word_file']);
					$handle->allowed = array('application/pdf','application/msword','text/plain','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/zip', 'application/x-compressed-zip');
						
					if ($handle->uploaded) {
				
						$handle->Process('media/user/cv/');				
						
						$_POST['ms_word_file'] = $handle->file_dst_name;
				
						$handle->Clean();		
					}
				///////////////////////					
	
					$this->form_validation->set_rules('role', 'Role', 'trim|required');	
					$this->form_validation->set_rules('name', 'Name', 'trim|required');	
					$this->form_validation->set_rules('affiliation', 'Affiliation', 'trim|required');
					$this->form_validation->set_rules('username', 'Username / Email', 'trim|required');						
					$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
					$this->form_validation->set_rules('country', 'Country', 'trim|required');						
					$this->form_validation->set_rules('specilization_area1', 'Primary Specialization Area', 'trim');
					$this->form_validation->set_rules('specilization_area2', 'Secondary Specialization Area', 'trim');
					$this->form_validation->set_rules('ms_word_file', 'ms_word_file', 'trim');						
					$this->form_validation->set_rules('password', 'Password', 'trim|matches[cpassword]');
					$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim');											
					$this->form_validation->set_rules('newsletter', 'Newsletter', 'trim');		
					$this->form_validation->set_rules('status', 'status', 'trim');		
			
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{			
							unset($_POST['submit']);
							unset($_POST['cpassword']);
							
							$_POST['password'] = sha1($this->input->post('password'));
							$_POST['date'] = current_date("Y-m-d h:i:s");							
							
							if($this->alias)
							{
								$_POST['alias'] = get_alias($this->input->post($this->alias));
							}
							
							$publish = $this->input->post('publish');							
							
							$data = $this->input->post();
							
							if($this->basic_model->add_a_record($this->table, $data))
							{
								$this->session->set_flashdata('success', 'Record added successfully.');
								redirect($this->controller);
							}
							else
							{
								$this->session->set_flashdata('error', 'Record could not be added.');
								redirect($this->controller);					
							}
					}

			} 
			else 
			{
				$this->load->view($this->view_folder.'edit',$data);
			}				
	}	

	
	public function edit($id)
	{

		if(!(int)$id)
		{
			$this->session->set_flashdata('error', 'Invalid Request!');
			redirect($this->controller);
		}
		else
		{	
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$data['id'] = $id;	
			$data['title'] = "Edit " . $this->title;
			$data['data'] = $this->basic_model->edit_record($this->table, $this->db_id, $id);
			$data['countries'] = $this->basic_model->dropdown_list("SELECT Id,name FROM countries WHERE 1 ORDER BY name ASC");							
			
			if($this->input->post('submit')!='')
			{
				
				///////////////////////
					$handle = new Upload($_FILES['ms_word_file']);
					$handle->allowed = array('application/pdf','application/msword','text/plain','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/zip', 'application/x-compressed-zip');

						
					if ($handle->uploaded) {
				
						$handle->Process('media/user/cv/');				
						
						$_POST['ms_word_file'] = $handle->file_dst_name;
						
						unlink_image("users","media/user/cv/",$id,'ms_word_file');						
				
						$handle->Clean();		
					}
				///////////////////////						

					$this->form_validation->set_rules('role', 'Role', 'trim|required');	
					$this->form_validation->set_rules('name', 'Name', 'trim|required');	
					$this->form_validation->set_rules('affiliation', 'Affiliation', 'trim|required');
					$this->form_validation->set_rules('username', 'Username / Email', 'trim|required');						
					$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
					$this->form_validation->set_rules('country', 'Country', 'trim|required');						
					$this->form_validation->set_rules('specilization_area1', 'Primary Specialization Area', 'trim');
					$this->form_validation->set_rules('specilization_area2', 'Secondary Specialization Area', 'trim');
					$this->form_validation->set_rules('ms_word_file', 'ms_word_file', 'trim');						
					$this->form_validation->set_rules('password', 'Password', 'trim|matches[cpassword]');
					$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim');											
					$this->form_validation->set_rules('newsletter', 'Newsletter', 'trim');		
					$this->form_validation->set_rules('status', 'status', 'trim');
			
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{			
							unset($_POST['submit']);
							unset($_POST['cpassword']);
							$_POST['password'] = sha1($this->input->post('password'));							
							$_POST['update_date'] = current_date("Y-m-d h:i:s");
							
							if($this->alias)
							{
								$_POST['alias'] = get_alias($this->input->post($this->alias));
							}							
							
							$data = $this->input->post();
							
							if($this->basic_model->update_a_record($this->table, $data, $this->db_id, $id))
							{
								$this->session->set_flashdata('success', 'Record updated successfully.');
								redirect($this->controller);
							}
							else
							{
								$this->session->set_flashdata('error', 'Record could not be updated. Did you make any change to the fields ?');
								redirect($this->controller);					
							}
					}
					
					
				
				
			} 
			else 
			{
				$this->load->view($this->view_folder.'edit',$data);
			}			
		

		}		
	}	
	
	public function view($id)
	{
		if(!(int)$id)
		{
			$this->session->set_flashdata('error', 'Invalid Request!');
			redirect($this->controller);
		}
		else
		{	
			$data['id'] = $id;	
			$data['title'] = "View " . $this->title;
			$data['data'] = $this->basic_model->view_record(array("*"),$this->table,$this->db_id,$id);
			
//			unset($data['data']['Id']);
			
			$this->load->view($this->view_folder.'view',$data);
		}
		
	}	
	

	
	public function active($id)
	{
		if(!(int)$id)
		{
			$this->session->set_flashdata('error', 'Invalid Request!');
			redirect($this->controller);
		}
		else
		{
			$data['publish'] = 1;
			
			if($this->basic_model->change_status_of_a_record($this->table, $data, $this->db_id, $id))
			{
				$this->session->set_flashdata('success', 'Record activated successfully.');
				redirect($this->controller);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record could not be activated.');
				redirect($this->controller);					
			}
		}
		
	}	
	
	public function inactive($id)
	{
		if(!(int)$id)
		{
			$this->session->set_flashdata('error', 'Invalid Request!');
			redirect($this->controller);
		}
		else
		{
			$data['publish'] = 0;
			
			if($this->basic_model->change_status_of_a_record($this->table, $data, $this->db_id, $id))
			{
				$this->session->set_flashdata('success', 'Record inactivated successfully.');
				redirect($this->controller);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record could not be inactivated.');
				redirect($this->controller);					
			}
		}
		
	}		

	public function delete($id)
	{
		
		if($this->session->userdata['user']['type'] != 'admin')
		{
			$this->session->set_flashdata('error', 'You do not have permission to delete.');
			redirect($this->controller);	
		}		
		
		
		if(!(int)$id)
		{
			$this->session->set_flashdata('error', 'Invalid Request!');
			redirect($this->controller);
		}
		else
		{
			$data['publish'] = 2;
			
			if($this->basic_model->change_status_of_a_record($this->table, $data, $this->db_id, $id))
			{
				$this->session->set_flashdata('success', 'Record deleted successfully.');
				redirect($this->controller);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record could not be deleted.');
				redirect($this->controller);					
			}
		}
		
	}	
		
	
	
	public function bulkaction()
	{

		$action_type = $this->input->post('bulkaction');
		
		if($action_type=='active' || $action_type=='inactive' || $action_type=='delete')
		{
		
			
		$this->basic_model->bulkaction($this->table, $this->db_id);
		
		$this->session->set_flashdata('success', 'Bulk action completed successfully.');		
		redirect($this->controller);
		
		}		
		
	}			

}

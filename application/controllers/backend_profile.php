<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Profile extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 			= "admin";
		$this->title 			= "My Profile";
		$this->title_plural		= $this->title.'';
		$this->db_id 			= "Id";
		$this->controller 		= $this->config->item('backend').'/profile';
		$this->alias			= "";
		$this->view_folder		= "backend/profile/";

		$this->first_field		= "name";
		$this->status_field		= "publish";
		
		$this->action_add		= TRUE;
		$this->action_view		= TRUE;
		$this->action_status	= TRUE;
		$this->action_edit		= TRUE;
		$this->action_delete	= ($this->session->userdata['user']['type'] == 'admin') ? TRUE : FALSE;
				
		$this->load->model('basic_model');
		
		$this->userType = $this->session->userdata['user']['type'];		
		
	}
	


	public function index()
	{
		redirect($this->controller.'/view/'.$this->session->userdata['user']['Id']);
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


			if($this->userType == 'admin')
			{
				$data['data'] = $this->basic_model->edit_record($this->table, $this->db_id, $id);
			}
			else
			{
				$data['data'] = $this->basic_model->edit_record_staff('staff', $this->db_id, $id);
			}

			
			if($this->input->post('submit')!='')
			{

				$this->form_validation->set_rules('username', 'Username', 'trim|required');								
				$this->form_validation->set_rules('password', 'Password', 'trim|matches[cpassword]');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim');	
				$this->form_validation->set_rules('name', 'Name', 'trim|required');

				if($this->userType == 'admin')
				{				
					$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				}
				else
				{
					$this->form_validation->set_rules('contact_no', 'Contact No.', 'trim');	
				}
			
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{	
					
							if($this->input->post('password') == '' && $this->input->post('cpassword') == '')
							{
								unset($_POST['password']);
								unset($_POST['cpassword']);
							}
							else
							{
								$_POST['password'] = sha1($this->input->post('password'));
								unset($_POST['cpassword']);
							}
							
							unset($_POST['submit']);
									
							

							
							if($this->alias)
							{
								$_POST['alias'] = get_alias($this->input->post($this->alias));
							}							
							
							$data = $this->input->post();
							
							
							if($this->userType != 'admin')
							{
								$this->table = "staff";
							}
							
							//pr($data);
							
							if($this->basic_model->update_a_record($this->table, $data, $this->db_id, $id))
							{
								$this->session->set_flashdata('success', 'Record updated successfully.');
								redirect($this->controller.'/view/'.$this->session->userdata['user']['Id']);
							}
							else
							{
								$this->session->set_flashdata('error', 'Record could not be updated. Did you make any change to the fields ?');
								redirect($this->controller.'/view/'.$this->session->userdata['user']['Id']);
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
			
										//	pr($this->session->userdata['user'],true);
			
			
			if($this->userType == 'admin')
			{								
				$data['data'] = $this->basic_model->view_record_query("SELECT 
				name,
				username,
				email
				FROM $this->table
				WHERE 1
				AND $this->db_id = $id
				AND $this->status_field = 1
				");	
			}
			else
			{
				$data['data'] = $this->basic_model->view_record_query("SELECT 
				name,
				username,
				contact_no
				FROM staff
				WHERE 1
				AND $this->db_id = $id
				AND $this->status_field = 1
				");					
			}
			
			
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

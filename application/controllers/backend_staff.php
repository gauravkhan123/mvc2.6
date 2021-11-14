<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Staff extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 			= "staff";
		$this->title 			= "Staff";
		$this->title_plural		= $this->title.'';
		$this->db_id 			= "Id";
		$this->controller 		= $this->config->item('backend').'/staff';
		$this->alias			= "";
		$this->view_folder		= "backend/staff/";

		$this->first_field		= "name";
		$this->status_field		= "publish";
		
		$this->action_add		= TRUE;
		$this->action_view		= TRUE;
		$this->action_status	= TRUE;
		$this->action_edit		= TRUE;
		$this->action_delete	= TRUE;
				
		$this->load->model('basic_model');
		
		
		$this->modules = get_few_record("SELECT * FROM staff_permission WHERE publish = 1");	
		
		//pr($this->modules);

	}


	public function index()
	{
		$data['coloums'] = $this->basic_model->list_result(array('Id','name','username','contact_no','publish'),$this->table);
		
		$this->load->view($this->view_folder.'list',$data);
	}
	
	
	public function add()
	{
			$this->load->helper('form');
			$this->load->library('form_validation');
			

			
			$data['id'] = "";				
			$data['title'] = "Add " . $this->title;
			
			if($this->input->post('submit')!='')
			{
				
					$this->form_validation->set_rules('name', 'Name', 'trim|required');	
					$this->form_validation->set_rules('username', 'Username / Email', 'trim|required');						
					$this->form_validation->set_rules('contact_no', 'Contact No', 'trim');
					$this->form_validation->set_rules('password', 'Password', 'trim|matches[cpassword]');
					$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim');
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
							$_POST['permissions'] = serialize($_POST['permissions']);							
							
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
			
			if($this->input->post('submit')!='')
			{
				
					$this->form_validation->set_rules('name', 'Name', 'trim|required');	
					$this->form_validation->set_rules('username', 'Username / Email', 'trim|required');						
					$this->form_validation->set_rules('contact_no', 'Contact No', 'trim');
					$this->form_validation->set_rules('password', 'Password', 'trim|matches[cpassword]');
					$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim');
					$this->form_validation->set_rules('status', 'status', 'trim');		
								
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
														
							$_POST['update_date'] = current_date("Y-m-d h:i:s");
							$_POST['permissions'] = serialize($_POST['permissions']);
							
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
			
			$data['data']['permissions'] = unserialize($data['data']['permissions']);
			
			$permissions = "";
			if(!empty($data['data']['permissions']))
			{
				foreach($data['data']['permissions'] as $value)
				{
					$value = ucwords(str_replace("_"," ",$value));
					
					$permissions .= $value."<br>";
				}
			}
			
			$data['data']['permissions'] = $permissions;
			
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

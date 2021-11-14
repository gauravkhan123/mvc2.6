<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Common_Meta extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 			= "common_meta_tags";
		$this->title 			= "Common Meta Tags";
		$this->title_plural		= $this->title.'';
		$this->db_id 			= "Id";
		$this->controller 		= $this->config->item('backend').'/common_meta';
		$this->alias			= "";
		$this->view_folder		= "backend/seo/common_meta/";

		$this->first_field		= "fullurl";
		$this->status_field		= "publish";
		
		$this->action_add		= FALSE;
		$this->action_view		= TRUE;
		$this->action_status	= FALSE;
		$this->action_edit		= TRUE;
		$this->action_delete	= FALSE;
				
		$this->load->model('basic_model');


	}


	public function index()
	{
		$data['coloums'] = $this->basic_model->list_result(array('Id','fullurl','publish'),$this->table);
		
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
	
					$this->form_validation->set_rules('fullurl', 'Full Url', 'trim|required');	
					$this->form_validation->set_rules('title_tag', 'Title Tag', 'trim|required');
					$this->form_validation->set_rules('meta_keyword_tag', 'Meta Keywords', 'trim');
					$this->form_validation->set_rules('meta_desc_tag', 'Meta Description', 'trim');				
					$this->form_validation->set_rules('replacers', 'Replacers', 'trim');				
					$this->form_validation->set_rules('availableReplacers', 'Available Replacers', 'trim');														
	
			
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{			
							unset($_POST['submit']);
							
							if($this->alias)
							{
								$_POST['alias'] = get_alias($this->input->post($this->alias));
							}
							
							$publish = $this->input->post('publish');							
							
							$data = $this->input->post();
							
							if($this->basic_model->add_a_record($this->table, $data, $this->db_id, $id))
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

					$this->form_validation->set_rules('fullurl', 'Full Url', 'trim');	
					$this->form_validation->set_rules('title_tag', 'Title Tag', 'trim');
					$this->form_validation->set_rules('meta_keyword_tag', 'Meta Keywords', 'trim');
					$this->form_validation->set_rules('meta_desc_tag', 'Meta Description', 'trim');				
					$this->form_validation->set_rules('replacers', 'Replacers', 'trim');				
					$this->form_validation->set_rules('availableReplacers', 'Available Replacers', 'trim');	
			
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{			
							unset($_POST['submit']);
							
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
			$data['data'] = $this->basic_model->view_record(array('fullurl','title_tag','meta_keyword_tag','meta_desc_tag','replacers','availableReplacers'),$this->table,$this->db_id,$id);	
			
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

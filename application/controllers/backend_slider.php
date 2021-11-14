<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Slider extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 			= "slider";
		$this->title 			= "Slider";
		$this->title_plural		= $this->title.'';
		$this->db_id 			= "id";
		$this->controller 		= $this->config->item('backend').'/slider';
		$this->alias			= "";
		$this->view_folder		= "backend/content/slider/";

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
		$data['coloums'] = $this->basic_model->list_result(array('id','name','url','image','publish'),$this->table);
		
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
				
				
				///////////////////////
					$handle = new Upload($_FILES['image']);
					$handle->allowed = array('image/gif','image/png','image/jpeg','image/pjpeg','image/jpeg','image/pjpeg');
						
					if ($handle->uploaded) {
				
							$handle->Process('media/slider/original');
						
							$handle->image_resize            = true;
							$handle->image_x                 = 40;	
							$handle->image_ratio_y           = true;		
							$handle->Process('media/slider/thumb/');		
					
							$handle->image_resize            = true;
							$handle->image_x                 = 990;	
							$handle->image_y                 = 140;		
							$handle->Process('media/slider/big/');								
						
							$_POST['image'] = $handle->file_dst_name;
				
						$handle->Clean();		
					}
				///////////////////////					
	
					$this->form_validation->set_rules('name', 'Title', 'trim|required');	
					$this->form_validation->set_rules('image', 'Image', 'trim|required');						
					$this->form_validation->set_rules('url', 'Url', 'trim');							
					$this->form_validation->set_rules('status', 'status', 'trim');		
					
					
												

			
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
							
							$_POST['date'] = current_date("Y-m-d h:i:s");
							

							
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
				
				
				///////////////////////
					$handle = new Upload($_FILES['image']);
					$handle->allowed = array('image/gif','image/png','image/jpeg','image/pjpeg','image/jpeg','image/pjpeg');
						
					if ($handle->uploaded)
					{
						@unlink_image($this->table,'media/slider/original/',$id,$field="image");
						@unlink_image($this->table,'media/slider/thumb/',$id,$field="image");
						@unlink_image($this->table,'media/slider/big/',$id,$field="image");												
						
							$handle->Process('media/slider/original');
						
							$handle->image_resize            = true;
							$handle->image_x                 = 40;	
							$handle->image_ratio_y           = true;		
							$handle->Process('media/slider/thumb/');		
					
							$handle->image_resize            = true;
							$handle->image_x                 = 990;	
							$handle->image_y                 = 140;		
							$handle->Process('media/slider/big/');			

						$_POST['image'] = $handle->file_dst_name;
						$handle->Clean();		
					}
				///////////////////////					

					$this->form_validation->set_rules('name', 'Title', 'trim|required');	
					$this->form_validation->set_rules('image', 'Image', 'trim');						
					$this->form_validation->set_rules('url', 'Url', 'trim');							
					$this->form_validation->set_rules('status', 'status', 'trim');					
			
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
							
							$_POST['update_date'] = current_date("Y-m-d h:i:s");
							
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
			$data['data'] = $this->basic_model->view_record(array('title','image','date'),$this->table,$this->db_id,$id);	
			
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

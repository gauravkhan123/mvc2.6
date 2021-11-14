<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Journals_ebm extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 			= "journals";
		$this->title 			= "Editorial Board Members - Journals";
		$this->title_plural		= $this->title.'';
		$this->db_id 			= "Id";
		$this->controller 		= $this->config->item('backend').'/journals_ebm';
		$this->alias			= "";
		$this->view_folder		= "backend/content/journals_ebm/";

		$this->first_field		= "name";
		$this->status_field		= "publish";
		
		$this->action_add		= FALSE;
		$this->action_view		= FALSE;
		$this->action_status	= FALSE;
		$this->action_edit		= TRUE;
		$this->action_delete	= FALSE;	
				
		$this->load->model('basic_model');
	}


	public function index()
	{
		$data['coloums'] = $this->basic_model->list_result(array($this->db_id,'main_cat','name','short_name','upcoming','publish'),$this->table);
		
		$this->load->view($this->view_folder.'list',$data);
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
					
					$this->form_validation->set_rules('editorial_board_members', 'editorial_board_members', 'trim');
			
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{			
							unset($_POST['submit']);
							
							
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
	
}

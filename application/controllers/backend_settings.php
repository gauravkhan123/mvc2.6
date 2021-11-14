<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Settings extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 			= "settings";
		$this->title 			= "Settings";
		$this->title_plural		= $this->title.'';
		$this->db_id 			= "id";
		$this->controller 		= $this->config->item('backend').'/settings';
		$this->alias			= "title";
		$this->view_folder		= "backend/settings/";

		$this->action_delete	= TRUE;
				
		$this->load->model('settings_model');

		$this->action_add		= FALSE;


	}

	
	public function index()
	{

			$this->load->helper('form');
			$this->load->library('form_validation');
			
			$data['title'] = "Settings";
			$data['data'] = $this->settings_model->get_fields($this->table);

			if($this->input->post('submit')!='')
			{

		if(!empty($data['data']))
		{
				foreach($data['data'] as $fields)
				{
					$this->form_validation->set_rules($fields['id'], $fields['title'], 'trim'.(($fields['required']==1)?'|required':''));	
				}
		}
	
			
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{			
							unset($_POST['submit']);
					
							
							$data = $this->input->post();
							
						//	pr($data);
							
							if($this->settings_model->update_a_record($this->table, $data))
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

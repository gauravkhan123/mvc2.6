<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Coupon extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 			= "coupons";
		$this->title 			= "Coupon";
		$this->title_plural		= $this->title.'';
		$this->db_id 			= "Id";
		$this->controller 		= $this->config->item('backend').'/coupon';
		$this->alias			= "";
		$this->view_folder		= "backend/coupon/";

		$this->first_field		= "Id";
		$this->status_field		= "publish";
		
		$this->action_add		= TRUE;
		$this->action_view		= TRUE;
		$this->action_status	= TRUE;
		$this->action_edit		= TRUE;
		$this->action_delete	= TRUE;
				
		$this->load->model('basic_model');
	}


	public function index()
	{
		$this->listing();
	}
	
	public function listing()
	{
		
					$this->load->model('coupon_model');
					$this->load->library('pagination');
					$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 AND publish = 1 ORDER BY name ASC");	


					
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
								
								if(isset($value[1]) && $value[1] != '')
								{
									$value[1] = trim($value[1]);
									
									if($value[0] == 'used_for')
									{
										$condition .= " AND A.used_for = '".$value[1]."'";
									}	
									elseif($value[0] == 'journal_id')
									{
										$condition .= " AND A.journal_id  = '".$value[1]."'";
									}	
									elseif($value[0] == 'reviewer_id')
									{
										$condition .= " AND (B.name  like '%".urlsafe($value[1])."%' OR B.username  like '%".urlsafe($value[1])."%')";
									}												
									elseif($value[0] == 'valid')
									{
										
										if($value[1] == "Yes")
										{
											$condition .= " AND A.valid  = '1'";
										}
										else
										{
											$condition .= " AND A.valid  = '0'";
										}
									}																			
									elseif($value[0] == 'manuscript_no')
									{
										$queries = explode("~",$value[1]);
										
										$condition .= " and A.manuscript_id = '".$queries[2]."' ";
									}	
									elseif($value[0] == 'date')
									{
										$condition .= " AND LEFT(A.date,10) = '".str_replace("~","-",$value[1])."'";
									}									
									else
									{
										$condition .= " AND A.$value[0] like '%".urlsafe($value[1])."%'";
									}
									
									$data['getvars'][$value[0]] = urlsafe($value[1]);
								}
							}	
							
							$searchVars = "filter-".implode("-",$searchVars);
													
					}
					else
					{
							$searchVars = "filter-manuscript_no:-used_for:-journal_id:-reviewer_id:-valid:-date:";	
					}
					
/////////////filter ends					
//					pr($condition);
	//				pr($searchVars);					

					$config['base_url'] = site_url($this->config->item('backend').'/coupon/listing/'.$searchVars);
					
					
					$config['total_rows'] = $this->coupon_model->total_results_backend($condition);
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
					$data['coloums'] = $this->coupon_model->listing_backend($condition,$offset,$config['per_page']);		
					
					
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
		$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 AND publish = 1 ORDER BY name ASC");
		$data['manuscripts'] = $this->basic_model->dropdown_list("SELECT Id,title FROM manuscript WHERE 1 AND publish = 1  ORDER BY title ASC");	
		$data['reviewers'] = $this->basic_model->dropdown_list("SELECT Id,username,name FROM users WHERE 1 AND  role='Author_Reviewer_Editor' AND publish = 1 ORDER BY name ASC");						
			
			if($this->input->post('submit')!='')
			{
	
					$this->form_validation->set_rules('journal_id', 'Journal', 'trim|required');	
					$this->form_validation->set_rules('manuscript_id', 'Manuscript', 'trim|required');	
					$this->form_validation->set_rules('coupon', 'Coupon', 'trim|required');
					$this->form_validation->set_rules('reviewer_id', 'Reviewer', 'trim|required');
					$this->form_validation->set_rules('value', 'Value', 'trim|required');											
					$this->form_validation->set_rules('valid', 'Valid', 'trim');		
					$this->form_validation->set_rules('status', 'status', 'trim');		
			
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{			
							unset($_POST['submit']);
							
							$_POST['date'] = current_date("Y-m-d h:i:s");							
							
							if($this->alias)
							{
								$_POST['alias'] = get_alias($this->input->post($this->alias));
							}
							
							
							$_POST['manuscript_id'] 	= get_mid_from_name_autocomplete($this->input->post('manuscript_id'));
							
							
							$_POST['reviewer_id'] 		= get_id_from_email_autocomplete($this->input->post('reviewer_id'));							

							
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
		
		$data['data']['reviewer_id'] 		= get_id_from_email_autocomplete_reverse($data['data']['reviewer_id']);
		$data['data']['manuscript_id'] 		= get_mid_from_name_autocomplete_reverse($data['data']['manuscript_id']);
		
		
		$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 AND publish = 1 ORDER BY name ASC");
		$data['manuscripts'] = $this->basic_model->dropdown_list("SELECT Id,title FROM manuscript WHERE 1 AND publish = 1  ORDER BY title ASC");	
		$data['reviewers'] = $this->basic_model->dropdown_list("SELECT Id,username,name FROM users WHERE 1 AND  role='Author_Reviewer_Editor' AND publish = 1 ORDER BY name ASC");						
			
			
			if($this->input->post('submit')!='')
			{
				
					$this->form_validation->set_rules('journal_id', 'Journal', 'trim|required');	
					$this->form_validation->set_rules('manuscript_id', 'Manuscript', 'trim|required');	
					$this->form_validation->set_rules('coupon', 'Coupon', 'trim|required');
					$this->form_validation->set_rules('reviewer_id', 'Reviewer', 'trim|required');
					$this->form_validation->set_rules('value', 'Value', 'trim|required');											
					$this->form_validation->set_rules('valid', 'Valid', 'trim');		
					$this->form_validation->set_rules('status', 'status', 'trim');	
								
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{			
							unset($_POST['submit']);
							$_POST['update_date'] = current_date("Y-m-d h:i:s");
							
							if($this->alias)
							{
								$_POST['alias'] = get_alias($this->input->post($this->alias));
							}							
							
							$_POST['manuscript_id'] 	= get_mid_from_name_autocomplete($this->input->post('manuscript_id'));
							
							$_POST['reviewer_id'] 		= get_id_from_email_autocomplete($this->input->post('manuscript_id'));							
														
							
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
	
	public function getreviewer()
	{
		
        $data = get_few_record("SELECT name,username FROM users WHERE 1 AND publish = 1 AND name like '".$this->input->get('term')."%' ORDER BY name ASC");
		
        if(count($data))
        {
			foreach($data as $value)
			{
				$specialeditors[] = $value['name']." (Email:".$value['username'].")";
			}
        }	
			
//			pr($specialeditors);
					
		echo json_encode($specialeditors);
		exit;

	}		
	
	public function getmanuscripts()
	{
		
        $data = get_few_record("SELECT Id,title FROM manuscript WHERE 1 AND publish = 1 AND title like '".$this->input->get('term')."%' ORDER BY title ASC");
		
        if(count($data))
        {
			foreach($data as $value)
			{
				$specialeditors[] = $value['title']." (Id:".$value['Id'].")";
			}
        }	
			
//			pr($specialeditors);
					
		echo json_encode($specialeditors);
		exit;

	}					

}

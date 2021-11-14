<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend_Deptcomments extends Secure_Controller {

	function __construct()
	{
		parent::__construct();

		$this->table 			= "manuscript";
		$this->title 			= "Department Comments";
		$this->title_plural		= $this->title.'s';
		$this->db_id 			= "Id";
		$this->controller 		= $this->config->item('backend').'/deptcomments';
		$this->alias			= "";
		$this->view_folder		= "backend/content/deptcomments/";

		$this->first_field		= "name";
		$this->status_field		= "publish";
		
		$this->action_add		= FALSE;
		$this->action_view		= FALSE;
		$this->action_status	= FALSE;
		$this->action_edit		= FALSE;
		$this->action_delete	= ($this->session->userdata['user']['type'] == 'admin') ? FALSE : FALSE;
				
		$this->load->model('basic_model');
		
		require_once(APPPATH.'libraries/class.upload/class.upload.php');
	}


	public function index()
	{
		$this->listing();
	}
	
	public function listing()
	{
		
					$this->load->model('manuscripts_model');
					$this->load->library('pagination');
					$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 AND publish = 1 ORDER BY name ASC");	
					$data['departments'] = $this->basic_model->dropdown_list("SELECT Id,name FROM depts WHERE 1 AND publish = 1 ORDER BY serial ASC");											
					
					
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
									
									if($value[0] == 'dbid')
									{
										$condition .= " AND m.Id = '".$value[1]."' ";	
									}	
									
										
									
									elseif($value[0] == 'color')
									{
										$condition .= " AND m.Id in (SELECT distinct(manuscript_id) from dept_color where field_color = '".$value[1]."')";
									}
									elseif($value[0] == 'year')
									{
										$condition .= " AND LEFT(m.date,4) = '".$value[1]."' ";	
									}								
									elseif($value[0] == 'wna' && $value[1] == 'Yes')
									{
										$condition .= " AND m.author_id = ''";	
									}
									elseif($value[0] == 'wna' && $value[1] == 'No')
									{
										$condition .= "";
									}
									elseif($value[0] == 'author_name')
									{
										$condition .= " AND a.name  like '%".urlsafe($value[1])."%'";
									}	
									elseif($value[0] == 'author_email')
									{
										$condition .= " AND a.username  like '%".urlsafe($value[1])."%'";
									}	
									elseif($value[0] == 'author_country')
									{
										$condition .= " AND a.country  = '".$value[1]."'";
									}	
									elseif($value[0] == 'todate')
									{
										$condition .= " AND LEFT(m.date,10)  <= '".str_replace("~","-",$value[1])."'";
									}	
									elseif($value[0] == 'fromdate')
									{
										$condition .= " AND LEFT(m.date,10)  >= '".str_replace("~","-",$value[1])."'";
									}																																													
									elseif($value[0] == 'manuscript_no')
									{
										$queries = explode("~",$value[1]);
										
										$condition .= " and LEFT(m.date,4) = '$queries[0]' ";
										$condition .= " and j.short_name = '$queries[1]' ";
										$condition .= " and m.Id = '$queries[2]' ";
									}									
									else
									{
										$condition .= " AND $value[0] like '%".urlsafe($value[1])."%'";
									}
									
									$data['getvars'][$value[0]] = urlsafe($value[1]);
								}
							}	
							
							$searchVars = "filter-".implode("-",$searchVars);
													
					}
					else
					{
							$searchVars = "filter-dbid:-year:-manuscript_no:-title:-journal_id:-author_name:-author_email:-author_country:-wna:-status:-color:-todate:-fromdate:";	
					}
					
/////////////filter ends					
//					pr($condition);
	//				pr($searchVars);					

					$config['base_url'] = site_url($this->config->item('backend').'/deptcomments/listing/'.$searchVars);
					
					
					$config['total_rows'] = $this->manuscripts_model->total_results_backend($condition);
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
					$data['coloums'] = $this->manuscripts_model->listing_backend($condition,$offset,$config['per_page']);		
					
					
					$data['startvalue'] = $offset+1;
					$data['endvalue'] = $offset + 20;					
					$data['totalvalue'] = $config['total_rows'];
		
		$this->load->view($this->view_folder.'list',$data);
	}
	
	
	

	public function allcomments()
	{
		
		$this->output->set_template('blank');		
		
		$mid = $this->uri->segment(4);
		$dept_id = $this->uri->segment(4);		
		
		$data['allcomments'] = $this->basic_model->dropdown_list("select * from dept_comments where manuscript_id='".$mid."' AND dept_id='".$dept_id."' ORDER BY Id DESC");		

		$this->load->view($this->view_folder.'allcomments',$data);	
	}
	
	public function addcomment()
	{
		
		$this->output->set_template('blank');		
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['data']['mid'] = $this->uri->segment(4);
		$data['data']['dept_id'] = $this->uri->segment(5);		
		
			if($this->input->post('submit')!='')
			{
			
					$this->form_validation->set_rules('comment', 'Comment', 'trim|required');
					
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'addcomment',$data);				
					}
					else
					{
						
							$_POST = $this->input->post();
											
							unset($_POST['submit']);						
							
							$_POST['staff_id'] = ($this->session->userdata['user']['type'] == 'admin') ? '0' : $this->session->userdata['user']['Id'];
							$_POST['date'] = current_date("Y-m-d h:i:s");
							
							
							if($this->basic_model->add_a_record("dept_comments", $_POST))
							{
								$this->session->set_flashdata('success', 'Record added successfully.');
								redirect($this->controller."/addcomment");
							}
							else
							{
								$this->session->set_flashdata('error', 'Record could not be added.');
								redirect($this->controller."/addcomment");					
							}
					}

			
			} 
			else
			{		
			$this->load->view($this->view_folder.'addcomment',$data);	
			}
	}	
	
	public function commentcolor()
	{
		
		$this->output->set_template('blank');		
		
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['data']['mid'] = $this->uri->segment(4);
		$data['data']['dept_id'] = $this->uri->segment(5);

	
$data['existing'] = $this->basic_model->view_record_query("SELECT Id,field_color FROM dept_color WHERE manuscript_id = '".$data['data']['mid']."' AND dept_id = '".$data['data']['dept_id']."'");			
		
			if($this->input->post('submit')!='')
			{
			
					$this->form_validation->set_rules('field_color', 'Color', 'trim|required');
					
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'commentcolor',$data);				
					}
					else
					{
						
						$query = $this->db->query("SELECT Id FROM dept_color WHERE manuscript_id = '".$_POST['manuscript_id']."' AND dept_id = '".$_POST['dept_id']."'");
						$colordetail=$query->row_array();			
						
					
						if(!empty($colordetail))
						{						
								$_POST = $this->input->post();
												
								unset($_POST['submit']);						
								
								$_POST['staff_id'] = ($this->session->userdata['user']['type'] == 'admin') ? '0' : $this->session->userdata['user']['Id'];
								$_POST['update_date'] = current_date("Y-m-d h:i:s");
								
								$this->basic_model->update_a_record('dept_color', $_POST,'Id',$colordetail['Id']);
							
							$this->session->set_flashdata('success', 'Record updated successfully.');
							redirect($this->controller."/commentcolor");
			
						}
						else
						{					
							
								$_POST = $this->input->post();
												
								unset($_POST['submit']);						
								
								$_POST['staff_id'] = ($this->session->userdata['user']['type'] == 'admin') ? '0' : $this->session->userdata['user']['Id'];
								$_POST['date'] = current_date("Y-m-d h:i:s");
								
								
								if($this->basic_model->add_a_record("dept_color", $_POST))
								{
									$this->session->set_flashdata('success', 'Record added successfully.');
									redirect($this->controller."/commentcolor");
								}
								else
								{
									$this->session->set_flashdata('error', 'Record could not be added.');
									redirect($this->controller."/commentcolor");					
								}
						}
					}

			
			} 
			else
			{		
			$this->load->view($this->view_folder.'commentcolor',$data);	
			}
	}		
	
	
	public function add()
	{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$data['id'] = "";				
			$data['title'] = "Add " . $this->title;
			$data['specialeditors'] = $this->basic_model->dropdown_list("SELECT Id,name FROM users WHERE 1 AND publish <> 2 ORDER BY name ASC");							
			$data['subjects'] = $this->basic_model->dropdown_list("SELECT Id,name FROM categories_spl WHERE 1 AND PUBLISH <> 2 ORDER BY name ASC");	
			$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 ORDER BY name ASC");	
			
			if($this->input->post('submit')!='')
			{
				
					$this->form_validation->set_rules('special_editor_id', 'Special Editor', 'trim');
					$this->form_validation->set_rules('author_id', 'Author Name', 'trim|required');
					$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required');
					$this->form_validation->set_rules('journal_id', 'Journals', 'trim|required');
					$this->form_validation->set_rules('title', 'Title', 'trim|required');
					$this->form_validation->set_rules('article_type', 'Aricle Type', 'trim|required');
					$this->form_validation->set_rules('abstract', 'Abstract', 'trim|required');
					$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
					$this->form_validation->set_rules('ca_name', 'Name', 'trim|required');
					$this->form_validation->set_rules('ca_address', 'Address', 'trim|required');	
					$this->form_validation->set_rules('ca_email', 'Email', 'trim|required');		
					
					$this->form_validation->set_rules('rv_name_a', 'Name', 'trim|required');
					$this->form_validation->set_rules('rv_address_a', 'Address', 'trim|required');	
					$this->form_validation->set_rules('rv_email_a', 'Email', 'trim|required');	
					
					$this->form_validation->set_rules('rv_name_b', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_b', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_b', 'Email', 'trim|valid_email');						
					
					$this->form_validation->set_rules('rv_name_c', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_c', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_c', 'Email', 'trim|valid_email');	
					
					$this->form_validation->set_rules('rv_name_d', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_d', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_d', 'Email', 'trim|valid_email');	
					
					
					$this->form_validation->set_rules('rv_name_e', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_e', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_e', 'Email', 'trim|valid_email');	
					
					$this->form_validation->set_rules('rv_name_f', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_f', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_f', 'Email', 'trim|valid_email');	
					
					$this->form_validation->set_rules('assign_reviewer1', 'Assign Reviewer 1', 'trim');
					$this->form_validation->set_rules('assign_reviewer2', 'Assign Reviewer 2', 'trim');	
					$this->form_validation->set_rules('assign_reviewer3', 'Assign Reviewer 3', 'trim');	
					
					$this->form_validation->set_rules('assign_reviewer4', 'Assign Reviewer 4', 'trim');
					$this->form_validation->set_rules('requested_discount', 'Discount Request Decision', 'trim');	
					$this->form_validation->set_rules('discount', 'Discount', 'trim');																										


					$this->form_validation->set_rules('status', 'status', 'trim');				

					
					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{
						
						$_POST = $this->input->post();
											
						unset($_POST['submit']);						
	
						///////////////////////
							$handle = new Upload($_FILES['ms_word_file']);
						
							if ($handle->uploaded) {
								$handle->Process('media/manuscripts'.date("/Y/M/",time()));
								$_POST['ms_word_file'] = $handle->file_dst_name;
								$handle-> Clean();		
							}
						///////////////////////
	

							if($this->alias)
							{
								$_POST['alias'] = get_alias($this->input->post($this->alias));
							}
							
							$_POST['date'] = current_date("Y-m-d h:i:s");
							

							if($this->basic_model->add_a_record($this->table, $_POST))
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
			
			
			$data['specialeditors'] = $this->basic_model->dropdown_list("SELECT Id,name FROM users WHERE 1 AND publish <> 2 ORDER BY name ASC");							
			$data['subjects'] = $this->basic_model->dropdown_list("SELECT Id,name FROM categories_spl WHERE 1 AND PUBLISH <> 2 ORDER BY name ASC");	
			$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 AND main_cat = '".$data['data']['subject_id']."' ORDER BY name ASC");	
			
			
			if($this->input->post('submit')!='')
			{
				
					$this->form_validation->set_rules('special_editor_id', 'Special Editor', 'trim');
					$this->form_validation->set_rules('author_id', 'Author Name', 'trim|required');
					$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required');
					$this->form_validation->set_rules('journal_id', 'Journals', 'trim|required');
					$this->form_validation->set_rules('title', 'Title', 'trim|required');
					$this->form_validation->set_rules('article_type', 'Aricle Type', 'trim|required');
					$this->form_validation->set_rules('abstract', 'Abstract', 'trim|required');
					$this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
					$this->form_validation->set_rules('ca_name', 'Name', 'trim|required');
					$this->form_validation->set_rules('ca_address', 'Address', 'trim|required');	
					$this->form_validation->set_rules('ca_email', 'Email', 'trim|required');		
					
					$this->form_validation->set_rules('rv_name_a', 'Name', 'trim|required');
					$this->form_validation->set_rules('rv_address_a', 'Address', 'trim|required');	
					$this->form_validation->set_rules('rv_email_a', 'Email', 'trim|required');	
					
					$this->form_validation->set_rules('rv_name_b', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_b', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_b', 'Email', 'trim|valid_email');						
					
					$this->form_validation->set_rules('rv_name_c', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_c', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_c', 'Email', 'trim|valid_email');	
					
					$this->form_validation->set_rules('rv_name_d', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_d', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_d', 'Email', 'trim|valid_email');	
					
					
					$this->form_validation->set_rules('rv_name_e', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_e', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_e', 'Email', 'trim|valid_email');	
					
					$this->form_validation->set_rules('rv_name_f', 'Name', 'trim');
					$this->form_validation->set_rules('rv_address_f', 'Address', 'trim');	
					$this->form_validation->set_rules('rv_email_f', 'Email', 'trim|valid_email');	
					
					$this->form_validation->set_rules('assign_reviewer1', 'Assign Reviewer 1', 'trim');
					$this->form_validation->set_rules('assign_reviewer2', 'Assign Reviewer 2', 'trim');	
					$this->form_validation->set_rules('assign_reviewer3', 'Assign Reviewer 3', 'trim');	
					
					$this->form_validation->set_rules('assign_reviewer4', 'Assign Reviewer 4', 'trim');
					$this->form_validation->set_rules('requested_discount', 'Discount Request Decision', 'trim');	
					$this->form_validation->set_rules('discount', 'Discount', 'trim');	
					$this->form_validation->set_rules('status', 'status', 'trim');

					if ($this->form_validation->run() == FALSE)
					{
						$this->load->view($this->view_folder.'edit',$data);				
					}
					else
					{	
						$_POST = $this->input->post();
														
						unset($_POST['submit']);
				
				if(!empty($_POST['delete_ms_word_file'])) 
				{
					unlinkManuscript('ms_word_file',$this->table,$this->db_id,$id);
					$_POST['ms_word_file']='';
					unset($_POST['delete_ms_word_file']);
				}		
				

				///////////////////////
					$handle = new Upload($_FILES['ms_word_file']);
				
					if ($handle->uploaded) {
						unlinkManuscript('ms_word_file',$this->table,$this->db_id,$id);
						$handle->Process('media/manuscripts'.date("/Y/M/",strtotime($data['data']['date'])));
						$_POST['ms_word_file'] = $handle->file_dst_name;
						$handle-> Clean();		
					}
				///////////////////////


							$_POST['update_date'] = current_date("Y-m-d h:i:s");
							
							if($this->basic_model->update_a_record($this->table, $_POST, $this->db_id, $id))
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
			$data['data'] = $this->basic_model->view_record_query("SELECT 
			A.manuscript_no,
			A.main_cat as journal,
			A.year,			
			A.volume,
			A.sub_cat as issue,
			A.article_type,
			A.name,			
			A.authors,
			A.abstract,
			A.page_no,
			A.doi,
			A.keywords,
			A.specific_comment,			
			CASE WHEN A.publish=1 THEN 'Active' ELSE 'In-Active' END as publish
			FROM $this->table A
			WHERE 1
			AND A.$this->db_id = $id
			");	
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
	
	
	public function getjournal()
	{
        $journals = get_few_record("SELECT Id,name FROM `journals` WHERE 1 AND main_cat = '".$this->input->post('subject_id')."' ORDER BY `name` ASC");
        
		$data = '<option value="">Select</option>';
		
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
	

}
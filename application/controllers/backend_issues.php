<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Backend_Issues extends Secure_Controller {



	function __construct()

	{

		parent::__construct();



		$this->table 			= "issues";

		$this->title 			= "Issue";

		$this->title_plural		= $this->title.'';

		$this->db_id 			= "Id";

		$this->controller 		= $this->config->item('backend').'/issues';

		$this->alias			= "";

		$this->view_folder		= "backend/issues/";



		$this->first_field		= "Id";

		$this->status_field		= "publish";

		

		$this->action_add		= TRUE;

		$this->action_view		= TRUE;

		$this->action_status	= TRUE;

		$this->action_edit		= TRUE;

		$this->action_delete	= ($this->session->userdata['user']['type'] == 'admin') ? TRUE : FALSE;

				

		$this->load->model('basic_model');

	}





	public function index()

	{

		$this->listing();

	}

	

	public function listing()

	{

					$this->load->model('issue_model');

					$this->load->library('pagination');

					$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 AND publish = 1 ORDER BY name ASC");					

					





/////////////filter starts

					$condition = "WHERE 1";

					

					if($this->uri->segment(4))

					{

							$searchVars = $this->uri->segment(4);



							$searchVars = explode("-",$searchVars);



							unset($searchVars['0']);

							

							

							

							foreach($searchVars as $value)

							{

								$value = explode(":",$value);

								

								if($value[1])

								{

									if($value[0] == 'publish' && $value[1] == 'yes')

									{

										$condition .= " AND $value[0] = 1";	

									}

									elseif($value[0] == 'publish' && $value[1] == 'no')

									{

										$condition .= " AND $value[0] <> 1";

									}

									else

									{

										$condition .= " AND $value[0] = '$value[1]'";										

									}

									

									$data['getvars'][$value[0]] = $value[1];

								}

							}	

							

							$searchVars = "filter-".implode("-",$searchVars);

													

					}

					else

					{

							$searchVars = "filter-Id:-main_cat:-year:-volume:-name:-publish:";	

					}

					

/////////////filter ends					

					//pr($condition);





					$config['base_url'] = site_url($this->config->item('backend').'/issues/listing/'.$searchVars);

					$config['total_rows'] = $this->issue_model->total_results_backend($condition);

					$config['per_page'] = 20;

					$config['uri_segment'] = 5;

							

					//		$config['display_pages'] = FALSE;

					//		$config['first_link']  = TRUE;

					//		$config['last_link']  = TRUE;listing

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

					$data['coloums'] = $this->issue_model->listing_backend($condition,$offset,$config['per_page']);		

					

					

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

			

			if($this->input->post('submit')!='')

			{

	

					$this->form_validation->set_rules('main_cat', 'Journal', 'trim|required');	

					$this->form_validation->set_rules('name', 'Issue Name', 'trim|required');	

					$this->form_validation->set_rules('volume', 'Volume', 'trim|required');

					$this->form_validation->set_rules('year', 'Year', 'trim|required');

					$this->form_validation->set_rules('title_tag', 'Title Tag', 'trim');				

					$this->form_validation->set_rules('meta_keyword_tag', 'Meta Keyword Tag', 'trim');

					$this->form_validation->set_rules('meta_desc_tag', 'Meta Description Tag', 'trim');

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

			$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 AND publish = 1 ORDER BY name ASC");

			

			if($this->input->post('submit')!='')

			{

				

					$this->form_validation->set_rules('main_cat', 'Journal', 'trim|required');	

					$this->form_validation->set_rules('name', 'Issue Name', 'trim|required');	

					$this->form_validation->set_rules('volume', 'Volume', 'trim|required');

					$this->form_validation->set_rules('year', 'Year', 'trim|required');

					$this->form_validation->set_rules('title_tag', 'Title Tag', 'trim');				

					$this->form_validation->set_rules('meta_keyword_tag', 'Meta Keyword Tag', 'trim');

					$this->form_validation->set_rules('meta_desc_tag', 'Meta Description Tag', 'trim');

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

							

							$data = $this->input->post();
							$data['update_date'] = current_date("Y-m-d h:i:s");
							

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


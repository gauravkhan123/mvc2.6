<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Backend_Journals extends Secure_Controller {



	function __construct()

	{

		parent::__construct();



		$this->table 			= "journals";

		$this->title 			= "Journals";

		$this->title_plural		= $this->title.'';

		$this->db_id 			= "Id";

		$this->controller 		= $this->config->item('backend').'/journals';

		$this->alias			= "";

		$this->view_folder		= "backend/content/journals/";



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

		$data['coloums'] = $this->basic_model->list_result(array($this->db_id,'main_cat','name','short_name','upcoming','featured','publish'),$this->table);

		

		$this->load->view($this->view_folder.'list',$data);

	}

	

	

	public function add()

	{

			$this->load->helper('form');

			$this->load->library('form_validation');

			

			

			$data['id'] = "";				

			$data['title'] = "Add " . $this->title;

			$data['subjects'] = $this->basic_model->dropdown_list("SELECT Id,name FROM categories_spl WHERE 1 ORDER BY name ASC");	

			

			if($this->input->post('submit')!='')

			{

				

				///////////////////////

					$handle = new Upload($_FILES['image']);

						

					if ($handle->uploaded) {

				

						$handle->Process('media/jours/orignal/');				

						

						$handle->image_resize            = true;

						$handle->image_x                 = 105;	

						$handle->image_ratio_y           = true;

						$handle->Process('media/jours/105/');

						

						$handle->image_resize            = true;

						$handle->image_x                 = 200;	

						$handle->image_ratio_y           = true;		

						$handle->Process('media/jours/200/');

						

						$_POST['image'] = $handle->file_dst_name;

				

						$handle->Clean();		

					}

				///////////////////////				

	

					$this->form_validation->set_rules('main_cat', 'Subject', 'trim|required');	

					$this->form_validation->set_rules('name', 'name', 'trim|required');	

					$this->form_validation->set_rules('short_name', 'Short Name', 'trim|required');		

					$this->form_validation->set_rules('issn', 'ISSN', 'trim|required');							

					

					$this->form_validation->set_rules('announcement', 'Journal Announcement', 'trim');

					$this->form_validation->set_rules('about_journal', 'About journal', 'trim');	

					

					$this->form_validation->set_rules('authors_instruction', 'authors_instruction', 'trim');

					

					$this->form_validation->set_rules('editorial_policy', 'editorial_policy', 'trim');

					$this->form_validation->set_rules('manuscript_submission', 'manuscript_submission', 'trim');	

					

					$this->form_validation->set_rules('abstracting_indexing', 'abstracting_indexing', 'trim');



					$this->form_validation->set_rules('title_tag', 'Title Tag', 'trim');				

					$this->form_validation->set_rules('meta_keyword_tag', 'Meta Keyword Tag', 'trim');

					$this->form_validation->set_rules('meta_desc_tag', 'Meta Description Tag', 'trim');																			

					

					$this->form_validation->set_rules('featured', 'Featured', 'trim');

					$this->form_validation->set_rules('upcoming', 'Upcoming', 'trim');

					$this->form_validation->set_rules('upcoming_date', 'Upcoming Date', 'trim');

															

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

			$data['subjects'] = $this->basic_model->dropdown_list("SELECT Id,name FROM categories_spl WHERE 1 ORDER BY name ASC");		

			

			if($this->input->post('submit')!='')

			{

					

					

		$handle = new Upload($_FILES['image']);

		

		



		if($handle->uploaded and $handle->file_is_image)

		{

		unlink_image($this->table,'media/jours/orignal/',(int)$id,'image');
		$handle->Process('media/jours/orignal/');
		

		unlink_image($this->table,'media/jours/105/',(int)$id,'image');		
        $handle->image_resize            = true;
        $handle->image_x                 = 105;	
        $handle->image_ratio_y           = true;
		$handle->Process('media/jours/105/');
       

		unlink_image($this->table,'media/jours/200/',(int)$id,'image');
		$handle->image_resize            = true;
        $handle->image_x                 = 200;	
        $handle->image_ratio_y           = true;		
		$handle->Process('media/jours/200/');
	

		$_POST['image'] = $handle->file_dst_name;

		

        $handle->Clean();		

	}

	else

	{

		unset($_POST['image']);

	}

				///////////////////////

				

				

		//	pr($_POST);

	

	

					$this->form_validation->set_rules('main_cat', 'Subject', 'trim|required');	

					$this->form_validation->set_rules('name', 'name', 'trim|required');	

					$this->form_validation->set_rules('short_name', 'Short Name', 'trim|required');		

					$this->form_validation->set_rules('issn', 'ISSN', 'trim|required');							

					

					$this->form_validation->set_rules('announcement', 'Journal Announcement', 'trim');

					$this->form_validation->set_rules('about_journal', 'About journal', 'trim');	

					

					$this->form_validation->set_rules('authors_instruction', 'authors_instruction', 'trim');

					$this->form_validation->set_rules('editorial_policy', 'editorial_policy', 'trim');

					$this->form_validation->set_rules('manuscript_submission', 'manuscript_submission', 'trim');	

					

					$this->form_validation->set_rules('abstracting_indexing', 'abstracting_indexing', 'trim');					



					$this->form_validation->set_rules('title_tag', 'Title Tag', 'trim');				

					$this->form_validation->set_rules('meta_keyword_tag', 'Meta Keyword Tag', 'trim');

					$this->form_validation->set_rules('meta_desc_tag', 'Meta Description Tag', 'trim');																			

					

					$this->form_validation->set_rules('featured', 'Featured', 'trim');

					$this->form_validation->set_rules('upcoming', 'Upcoming', 'trim');

					$this->form_validation->set_rules('upcoming_date', 'Upcoming Date', 'trim');

															

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

			

			

			$data['data'] = $this->basic_model->view_record_query("SELECT 

			A.name as subject,

			B.name,

			B.short_name,

			B.issn,

			B.image,

			B.alias,

			B.about_journal,

			B.authors_instruction,

			B.editorial_board_members,

			B.editorial_policy,

			B.manuscript_submission,

			B.article_press,

			B.title_tag,

			B.meta_keyword_tag,

			B.meta_desc_tag,

			B.featured,

			B.upcoming,

			B.upcoming_date,

			B.date,

			CASE WHEN B.publish=1 THEN 'Active' ELSE 'In-Active' END as publish

			FROM $this->table B

			LEFT JOIN categories_spl A ON A.Id = B.main_cat

			WHERE 1

			AND B.$this->db_id = $id

			AND B.$this->status_field !=2

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



}
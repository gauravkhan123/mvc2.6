<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Backend_Product extends Secure_Controller {



	function __construct()

	{

		parent::__construct();



		$this->table 			= "products";

		$this->title 			= "Product";

		$this->title_plural		= $this->title.'s';

		$this->db_id 			= "id";

		$this->controller 		= $this->config->item('backend').'/product';

		$this->alias			= "";

		$this->view_folder		= "backend/products/";		

		

		$this->first_field		= "name";

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

		$data['current_controller'] = $this->controller;

		$data['coloums'] = $this->basic_model->list_result(array('id','name','sku','publish'),$this->table);		



		$this->load->view($this->view_folder.'list',$data);

	}

	

	

	public function add()

	{

			$this->load->helper('form');

			$this->load->library('form_validation');

			



			

			$data['id'] = "";				

			$data['title'] = "Add " . $this->title;

				$data['categories'] = $this->basic_model->dropdown_list("SELECT id,name FROM product_categories WHERE 1 AND publish = '1' ORDER BY name ASC");	
				
				//pr($data['categories']);		

			if($this->input->post('submit')!='')

			{

	

					$this->form_validation->set_rules('name', 'Page Title', 'trim|required');

					$this->form_validation->set_rules('description', 'Page Content', 'trim|required');

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

							

							if($this->alias)

							{

								$_POST['alias'] = get_alias($this->input->post($this->alias));

							}
							$_POST['checkbox_categories'] = serialize($_POST['checkbox_categories']);
							$_POST['checkbox_categories2'] = serialize($_POST['checkbox_categories2']);
							
							$_POST['checkbox_categories3'] = serialize($_POST['checkbox_categories3']);
							//$_POST['books_category_id'] = serialize($_POST['books_category_id']);

							$publish = $this->input->post('publish');

														
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

			
			$data['categories'] = $this->basic_model->dropdown_list("SELECT id,name FROM product_categories  WHERE 1 AND publish = '1' ORDER BY name ASC");	
			
			
			if($this->input->post('submit')!='')

			{
					$this->form_validation->set_rules('main_cat', 'main_cat', 'trim');

					$this->form_validation->set_rules('name', 'Page Title', 'trim|required');

					$this->form_validation->set_rules('description', 'Page Content', 'trim|required');

					$this->form_validation->set_rules('title_tag', 'Title Tag', 'trim');				

					$this->form_validation->set_rules('meta_keyword_tag', 'Meta Keyword Tag', 'trim');

					$this->form_validation->set_rules('meta_desc_tag', 'Meta Description Tag', 'trim');

					$this->form_validation->set_rules('publish', 'publish', 'trim');
					
											

	

			

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
							$_POST['checkbox_categories'] = serialize($_POST['checkbox_categories']);
							
							$_POST['checkbox_categories2'] = serialize($_POST['checkbox_categories2']);
							$_POST['checkbox_categories3'] = serialize($_POST['checkbox_categories3']);
							//$_POST['books_category_id'] = serialize($_POST['books_category_id']);

							
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
				
			$data['data'] = $this->basic_model->view_record(array('*'),$this->table,'Id',$id);	
          //  pr($data['data']['checkbox_categories']);
			//$_POST['checkbox_categories'] = unserialize($_POST['checkbox_categories']);
			$data['data']['checkbox_categories'] = unserialize($data['data']['checkbox_categories']);
			
				//	pr($data['data']['checkbox_categories']);
			
		
			if(!empty($data['data']['checkbox_categories']))
			{
				foreach($data['data']['checkbox_categories'] as $value)
				{
					$newarray[] = get_corresponing_value('product_categories','name',$value,'id');
				}
			}
			
			
			$data['data']['checkbox_categories'] = implode(", ",$newarray);
			//$data['data']['checkbox_categories'] = unserialize($data['data']['checkbox_categories']);
			
				
			
			
			//checkbox2
			$data['data']['checkbox_categories2'] = unserialize($data['data']['checkbox_categories2']);
			
					//	pr($data['data']['checkbox_categories']);
			

			if(!empty($data['data']['checkbox_categories2']))
			{
				foreach($data['data']['checkbox_categories2'] as $value)
				{
					$newarray2[] = get_corresponing_value('product_categories','name',$value,'id');
				}
			}
			
			//pr($newarray);
			
			$data['data']['checkbox_categories2'] = implode(", ",$newarray2);
			//$data['data']['checkbox_categories2'] = unserialize($data['data']['checkbox_categories2']);
			
					//	pr($data['data']['checkbox_categories']);
			
			
			
			//$data['data']['checkbox_categories'] = implode(', ',$data['data']['checkbox_categories']);
			
			//$data['data']['checkbox_categories']= $categories;
			$data['data']['checkbox_categories3'] = unserialize($data['data']['checkbox_categories3']);
			
					//	pr($data['data']['checkbox_categories']);
			

			if(!empty($data['data']['checkbox_categories3']))
			{
				foreach($data['data']['checkbox_categories3'] as $value)
				{
					$newarray3[] = get_corresponing_value('product_categories','name',$value,'id');
				}
			}
			
			//pr($newarray);
			
			//$data['data']['books_category_id'] = implode(", ",$newarray4);
//			$data['data']['books_category_id'] = unserialize($data['data']['books_category_id']);
//			
//				//	pr($data['data']['checkbox_categories']);
//			
//		
//			if(!empty($data['data']['books_category_id']))
//			{
//				foreach($data['data']['books_category_id'] as $value)
//				{
//					$newarray4[] = get_corresponing_value('product_categories','name',$value,'id');
//				}
//			}
//			
//			
//			$data['data']['books_category_id'] = implode(", ",$newarray4);
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



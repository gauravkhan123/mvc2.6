<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Backend_Articles extends Secure_Controller {



	function __construct()

	{

		parent::__construct();



		$this->table 			= "articles";

		$this->title 			= "Articles";

		$this->title_plural		= $this->title.'';

		$this->db_id 			= "Id";

		$this->controller 		= $this->config->item('backend').'/articles';

		$this->alias			= "";

		$this->view_folder		= "backend/content/articles/";



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

		$this->listing();

	}

	

	public function listing()

	{

		

					$this->load->model('articles_model');

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





					$config['base_url'] = site_url($this->config->item('backend').'/articles/listing/'.$searchVars);

					

					

					$config['total_rows'] = $this->articles_model->total_results_backend($condition);

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

					$data['coloums'] = $this->articles_model->listing_backend($condition,$offset,$config['per_page']);		

					

					

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

			$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 ORDER BY name ASC");	

			

			if($this->input->post('submit')!='')

			{

				

					$this->form_validation->set_rules('manuscript_no', 'Manuscript No.', 'trim|required');

					$this->form_validation->set_rules('main_cat', 'Journals', 'trim|required');

					$this->form_validation->set_rules('year', 'Year', 'trim|required');

					$this->form_validation->set_rules('volume', 'Volume', 'trim|required');

					$this->form_validation->set_rules('sub_cat', 'Issues', 'trim|required');

					$this->form_validation->set_rules('article_type', 'Aricle Type', 'trim|required');

					$this->form_validation->set_rules('name', 'Name', 'trim|required');

					$this->form_validation->set_rules('authors', 'Authors', 'trim');

					$this->form_validation->set_rules('abstract', 'Abstract', 'trim');

					$this->form_validation->set_rules('full_text', 'Full Text', 'trim');

					

					$this->form_validation->set_rules('provisional_pdf_file', 'Provisional PDF', 'trim');					

					$this->form_validation->set_rules('pdf_file', 'PDF File', 'trim');

					$this->form_validation->set_rules('html_file', 'Supplementary File', 'trim');

					

					$this->form_validation->set_rules('page_no', 'Page Numbers', 'trim');

					$this->form_validation->set_rules('doi', 'DOI', 'trim');

					$this->form_validation->set_rules('keywords', 'Keywords', 'trim');

					$this->form_validation->set_rules('specific_comment', 'Specific Comment', 'trim');

					

					$this->form_validation->set_rules('citation_publication_date', 'Citation Publication Date', 'trim');

					$this->form_validation->set_rules('citation_journal_title', 'Citation Journal Title', 'trim');	

					$this->form_validation->set_rules('citation_volume', 'Citation Volume', 'trim');					

					$this->form_validation->set_rules('citation_issue', 'Citation Issue', 'trim');	

					$this->form_validation->set_rules('citation_firstpage', 'Citation First Page', 'trim');

					$this->form_validation->set_rules('citation_lastpage', 'Citation Last Page', 'trim');	

					$this->form_validation->set_rules('citation_pdf_url', 'Citation PDF Url', 'trim');

					$this->form_validation->set_rules('title_tag', 'Title Tag', 'trim');				

					$this->form_validation->set_rules('meta_keyword_tag', 'Meta Keyword Tag', 'trim');

					$this->form_validation->set_rules('meta_desc_tag', 'Meta Description Tag', 'trim');																			

					$this->form_validation->set_rules('featured', 'Featured', 'trim');

					$this->form_validation->set_rules('status', 'status', 'trim');				



					

					if ($this->form_validation->run() == FALSE)

					{

						$this->load->view($this->view_folder.'edit',$data);				

					}

					else

					{

											

						unset($_POST['submit']);						

						

						$file_path = getJournalFilesFolder($this->input->post('main_cat'),'journalid');

						

						$insertdata['show_provisional_pdf_file'] = $this->input->post('show_provisional_pdf_file');

						$insertdata['show_pdf_file'] = $this->input->post('show_pdf_file');

						$insertdata['show_html_file'] = $this->input->post('show_html_file');																			

						$insertdata['show_table'] = $this->input->post('show_table');

		

						//inserting 3 articles journal files

						///////////////////////

							$handle = new Upload($_FILES['provisional_pdf_file']);

						

							if ($handle->uploaded) {

								$handle->Process($file_path);

								$insertdata['provisional_pdf_file'] = $handle->file_dst_name;

								$handle-> Clean();		

							}

						///////////////////////

						///////////////////////

							$handle = new Upload($_FILES['pdf_file']);

						

							if ($handle->uploaded)

							{

								$handle->Process($file_path);

								$insertdata['pdf_file'] = $handle->file_dst_name;

								$handle-> Clean();		

							}

						///////////////////////

						///////////////////////

							$handle = new Upload($_FILES['html_file']);

						

							if ($handle->uploaded)

							{

								$handle->Process($file_path);

								$insertdata['html_file'] = $handle->file_dst_name;

								$handle-> Clean();		

							}

						///////////////////////					



							if($this->alias)

							{

								$_POST['alias'] = get_alias($this->input->post($this->alias));

							}

							

							//$data = $this->input->post();

							

							$insertdata['manuscript_no'] = $this->input->post('manuscript_no');

							$insertdata['main_cat'] = $this->input->post('main_cat');							

							$insertdata['year'] = $this->input->post('year');

							$insertdata['volume'] = $this->input->post('volume');							

							$insertdata['sub_cat'] = $this->input->post('sub_cat');

							$insertdata['article_type'] = $this->input->post('article_type');	

							$insertdata['name'] = $this->input->post('name');								

							$insertdata['authors'] = $this->input->post('authors');

							$insertdata['abstract'] = $this->input->post('abstract');								

							$insertdata['full_text'] = $this->input->post('full_text');	

							

							$insertdata['page_no'] = $this->input->post('page_no');

							$insertdata['doi'] = $this->input->post('doi');								

							$insertdata['keywords'] = $this->input->post('keywords');

							$insertdata['specific_comment'] = $this->input->post('specific_comment');

							

							$insertdata['citation_title'] = $this->input->post('citation_title');

							$insertdata['citation_publication_date'] = $this->input->post('citation_publication_date');								

							$insertdata['citation_journal_title'] = $this->input->post('citation_journal_title');

							$insertdata['citation_volume'] = $this->input->post('citation_volume');

							$insertdata['citation_issue'] = $this->input->post('citation_issue');

							$insertdata['citation_firstpage'] = $this->input->post('citation_firstpage');								

							$insertdata['citation_lastpage'] = $this->input->post('citation_lastpage');

							$insertdata['citation_pdf_url'] = $this->input->post('citation_pdf_url');

							$insertdata['title_tag'] = $this->input->post('title_tag');

							$insertdata['meta_keyword_tag'] = $this->input->post('meta_keyword_tag');								

							$insertdata['meta_desc_tag'] = $this->input->post('meta_desc_tag');

							$insertdata['featured'] = $this->input->post('featured');

							$insertdata['publish'] = $this->input->post('publish');		

							$insertdata['date'] = current_date("Y-m-d h:i:s");

							

							// pr($insertdata);



							if($this->basic_model->add_a_record($this->table, $insertdata))

							{

								

								

								$article_id = $this->db->insert_id();

								

								

						//inserting new stages

						unset($_POST['fullText'][0]);

						

						if(!empty($_POST['fullText']) and count($_POST['fullText']) > 0) 

						{

							foreach($_POST['fullText'] as $key => $value) 

							{

								mysql_query("insert into stages (article_id,title,description,file_1,file_2,date) 

								values('".$article_id."','".$_POST['title'][$key]."','".$value."','".$_POST['fileOne'][$key]."',

								'".$_POST['fileTwo'][$key]."','".$_POST['addDate'][$key]."')");

							}

						}				

	

						//inserting new citation authors

						unset($_POST['citation_author'][0]);

						

						if(!empty($_POST['citation_author']) and count($_POST['citation_author']) > 0) 

						{

							foreach($_POST['citation_author'] as $key => $value) 

							{

								mysql_query("insert into citation_authors (article_id,title) values('".$article_id."','".$_POST['citation_author'][$key]."')");

							}

						}										

								

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

			

			$data['journals'] = $this->basic_model->dropdown_list("SELECT Id,name FROM journals WHERE 1 AND Id = '".$data['data']['main_cat']."' ORDER BY name ASC");	

			

			if($this->input->post('submit')!='')

			{

				

					$this->form_validation->set_rules('manuscript_no', 'Manuscript No.', 'trim|required');

					$this->form_validation->set_rules('main_cat', 'Journals', 'trim|required');

					$this->form_validation->set_rules('year', 'Year', 'trim|required');

					$this->form_validation->set_rules('volume', 'Volume', 'trim|required');

					$this->form_validation->set_rules('sub_cat', 'Issues', 'trim|required');

					$this->form_validation->set_rules('article_type', 'Aricle Type', 'trim|required');

					$this->form_validation->set_rules('name', 'Name', 'trim|required');

					$this->form_validation->set_rules('authors', 'Authors', 'trim');

					$this->form_validation->set_rules('abstract', 'Abstract', 'trim');

					$this->form_validation->set_rules('full_text', 'Full Text', 'trim');

					

					$this->form_validation->set_rules('provisional_pdf_file', 'Provisional PDF', 'trim');					

					$this->form_validation->set_rules('pdf_file', 'PDF File', 'trim');

					$this->form_validation->set_rules('html_file', 'Supplementary File', 'trim');

					

					$this->form_validation->set_rules('page_no', 'Page Numbers', 'trim');

					$this->form_validation->set_rules('doi', 'DOI', 'trim');

					$this->form_validation->set_rules('keywords', 'Keywords', 'trim');

					$this->form_validation->set_rules('specific_comment', 'Specific Comment', 'trim');

					

					$this->form_validation->set_rules('citation_publication_date', 'Citation Publication Date', 'trim');

					$this->form_validation->set_rules('citation_journal_title', 'Citation Journal Title', 'trim');	

					$this->form_validation->set_rules('citation_volume', 'Citation Volume', 'trim');					

					$this->form_validation->set_rules('citation_issue', 'Citation Issue', 'trim');	

					$this->form_validation->set_rules('citation_firstpage', 'Citation First Page', 'trim');

					$this->form_validation->set_rules('citation_lastpage', 'Citation Last Page', 'trim');	

					$this->form_validation->set_rules('citation_pdf_url', 'Citation PDF Url', 'trim');

					$this->form_validation->set_rules('title_tag', 'Title Tag', 'trim');				

					$this->form_validation->set_rules('meta_keyword_tag', 'Meta Keyword Tag', 'trim');

					$this->form_validation->set_rules('meta_desc_tag', 'Meta Description Tag', 'trim');																			

					$this->form_validation->set_rules('featured', 'Featured', 'trim');

					$this->form_validation->set_rules('status', 'status', 'trim');



					if ($this->form_validation->run() == FALSE)

					{

						$this->load->view($this->view_folder.'edit',$data);				

					}

					else

					{			

							unset($_POST['submit']);

							

				$file_path = getJournalFilesFolder($id,'articleid');

				

				$insertdata['show_provisional_pdf_file'] = $this->input->post('show_provisional_pdf_file');

				$insertdata['show_pdf_file'] = $this->input->post('show_pdf_file');

				$insertdata['show_html_file'] = $this->input->post('show_html_file');																			

				$insertdata['show_table'] = $this->input->post('show_table');				

				

				if(!empty($_POST['delete_provisional_pdf_file'])) 

				{

					unlinkImageJournal('provisional_pdf_file',$this->table,$this->db_id,$id);

					$insertdata['provisional_pdf_file']='';

					$insertdata['show_provisional_pdf_file']=0;

				}

				

				if(!empty($_POST['delete_pdf_file'])) 

				{

					unlinkImageJournal('pdf_file',$this->table,$this->db_id,$id);

					$insertdata['pdf_file']='';					

					$insertdata['show_pdf_file']=0;

				} 

				

				if(!empty($_POST['delete_html_file'])) 

				{

					unlinkImageJournal('html_file',$this->table,$this->db_id,$id);

					$insertdata['html_file']='';								

					$insertdata['show_html_file']=0;					

				}		

				

				if(!empty($_POST['delete_existing']) and count($_POST['delete_existing']) > 0) 

				{

					foreach($_POST['delete_existing'] as $value) 

					{				

						mysql_query("delete from stages where Id='".$value."'");

					}

				}

				

				if(!empty($_POST['delete_existing_citation']) and count($_POST['delete_existing_citation']) > 0) 

				{

					foreach($_POST['delete_existing_citation'] as $value) 

					{			

						mysql_query("delete from citation_authors where Id='".$value."'");

					}

				}	

				

				

				//updating existing stages

				

				if(!empty($_POST['existingFullText']) and count($_POST['existingFullText']) > 0) 

				{

					foreach($_POST['existingFullText'] as $key => $value) 

					{

						mysql_query("update stages SET title='".$_POST['exTitle'][$key]."', description='".$_POST['existingFullText'][$key]."', file_1='".$_POST['exFileOne'][$key]."', file_2='".$_POST['exFileTwo'][$key]."', date='".$_POST['exAddDate'][$key]."' WHERE Id = '".$key."'");

					}

				}				



				//inserting new stages

				unset($_POST['fullText'][0]);

				

				if(!empty($_POST['fullText']) and count($_POST['fullText']) > 0) 

				{

					foreach($_POST['fullText'] as $key => $value) 

					{

						mysql_query("insert into stages (article_id,title,description,file_1,file_2,date) 

						values('".$id."','".$_POST['title'][$key]."','".$value."','".$_POST['fileOne'][$key]."',

						'".$_POST['fileTwo'][$key]."','".$_POST['addDate'][$key]."')");

					}

				}				

				

				

				//updating existing citation authors

				

				if(!empty($_POST['excitation_author']) and count($_POST['excitation_author']) > 0) 

				{

					foreach($_POST['excitation_author'] as $key => $value) 

					{

						mysql_query("update citation_authors SET title='".$_POST['excitation_author'][$key]."' WHERE Id = '".$key."'");

					}

				}



				//inserting new citation authors

				unset($_POST['citation_author'][0]);

				

				if(!empty($_POST['citation_author']) and count($_POST['citation_author']) > 0) 

				{

					foreach($_POST['citation_author'] as $key => $value) 

					{

						mysql_query("insert into citation_authors (article_id,title) values('".$id."','".$_POST['citation_author'][$key]."')");

					}

				}



				//inserting 3 articles journal files

				///////////////////////

					$handle = new Upload($_FILES['provisional_pdf_file']);

				

					if ($handle->uploaded) {

						unlinkImageJournal('provisional_pdf_file',$this->table,$this->db_id,$id);

						$handle->Process($file_path);

						$insertdata['provisional_pdf_file'] = $handle->file_dst_name;

						$handle-> Clean();		

					}

				///////////////////////

				///////////////////////

					$handle = new Upload($_FILES['pdf_file']);

				

					if ($handle->uploaded)

					{

						unlinkImageJournal('pdf_file',$this->table,$this->db_id,$id);

						$handle->Process($file_path);

						$insertdata['pdf_file'] = $handle->file_dst_name;

						$handle-> Clean();		

					}					

				///////////////////////

				///////////////////////

					$handle = new Upload($_FILES['html_file']);

				

					if ($handle->uploaded)

					{

						unlinkImageJournal('html_file',$this->table,$this->db_id,$id);						

						$handle->Process($file_path);

						$insertdata['html_file'] = $handle->file_dst_name;

						$handle-> Clean();		

					}				

				///////////////////////							

							

							if($this->alias)

							{

								$_POST['alias'] = get_alias($this->input->post($this->alias));

							}

							

							//$data = $this->input->post();

							

							$insertdata['manuscript_no'] = $this->input->post('manuscript_no');

							$insertdata['main_cat'] = $this->input->post('main_cat');							

							$insertdata['year'] = $this->input->post('year');

							$insertdata['volume'] = $this->input->post('volume');							

							$insertdata['sub_cat'] = $this->input->post('sub_cat');

							$insertdata['article_type'] = $this->input->post('article_type');	

							$insertdata['name'] = $this->input->post('name');								

							$insertdata['authors'] = $this->input->post('authors');

							$insertdata['abstract'] = $this->input->post('abstract');								

							$insertdata['full_text'] = $this->input->post('full_text');	

							

							$insertdata['page_no'] = $this->input->post('page_no');

							$insertdata['doi'] = $this->input->post('doi');								

							$insertdata['keywords'] = $this->input->post('keywords');

							$insertdata['specific_comment'] = $this->input->post('specific_comment');

							

							$insertdata['citation_title'] = $this->input->post('citation_title');

							$insertdata['citation_publication_date'] = $this->input->post('citation_publication_date');								

							$insertdata['citation_journal_title'] = $this->input->post('citation_journal_title');

							$insertdata['citation_volume'] = $this->input->post('citation_volume');

							$insertdata['citation_issue'] = $this->input->post('citation_issue');

							$insertdata['citation_firstpage'] = $this->input->post('citation_firstpage');								

							$insertdata['citation_lastpage'] = $this->input->post('citation_lastpage');

							$insertdata['citation_pdf_url'] = $this->input->post('citation_pdf_url');

							$insertdata['title_tag'] = $this->input->post('title_tag');

							$insertdata['meta_keyword_tag'] = $this->input->post('meta_keyword_tag');								

							$insertdata['meta_desc_tag'] = $this->input->post('meta_desc_tag');

							$insertdata['featured'] = $this->input->post('featured');

							$insertdata['publish'] = $this->input->post('publish');		

							$insertdata['update_date'] = current_date("Y-m-d h:i:s");

							

							// pr($insertdata);

							

							if($this->basic_model->update_a_record($this->table, $insertdata, $this->db_id, $id))

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

	

	

	public function getyear()

	{

        $years = get_few_record("SELECT year FROM `issues` WHERE 1 AND `publish` = '1' AND main_cat = '".$this->input->post('journal_id')."' GROUP BY year ORDER BY `year`");

        

		$data = '<option value="">Select</option>';

		

        if(count($years))

        {

			foreach($years as $value)

			{

				$data .= '<option value="'.$value['year'].'">'.$value['year'].'</option>';

			}

        }

		

		echo $data;

		exit;		



	}	

	

	public function getvolume()

	{

        $volumes = get_few_record("SELECT volume FROM `issues` WHERE 1 AND `publish` = '1' AND main_cat = '".$this->input->post('journal_id')."' AND year = '".$this->input->post('year')."' GROUP BY volume ORDER BY `volume`");

        

		$data = '<option value="">Select</option>';

		

        if(count($volumes))

        {

			foreach($volumes as $value)

			{

				$data .= '<option value="'.$value['volume'].'">'.$value['volume'].'</option>';

			}

        }

		

		echo $data;

		exit;		



	}	

	

	public function getissues()

	{

        $issues = get_few_record("SELECT id,name FROM `issues` WHERE 1 AND main_cat = '".$this->input->post('journal_id')."' AND year = '".$this->input->post('year')."' AND volume = '".$this->input->post('volume')."' GROUP BY name ORDER BY `name`");

        

		$data = '<option value="">Select</option>';

		

        if(count($issues))

        {

			foreach($issues as $value)

			{

				$data .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';

			}

        }

		

		echo $data;

		exit;



	}				



}
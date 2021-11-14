<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Journal extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->output->set_template('frontend');
		$this->load->model('journal_model');
		$this->load->model('articles_model');		
		
	}

	public function index()
	{

		$data['data']['subjects'] = $this->journal_model->show_subjects();
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/journal',$data);
	}
	
	public function upcoming()
	{
		$data['data']['subjects'] = $this->journal_model->show_subjects_upcomingjournals();
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/upcoming_journal',$data);
	}	
	
	
	public function az()
	{		
		$data['data']['subjects'] = $this->journal_model->show_subjects();
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/journal_az',$data);
	}	
	
	
	public function subjects()
	{
		$data['data']['subjects'] = $this->journal_model->show_subjects();
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/subjects',$data);
	}		


	public function home()
	{

		$id = $this->uri->segment(2);
	        $data['idGET'] = $id;	
				
		  if(!$id)
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect('journals');
		}
		
		
		$meta = getMetaTags('journals',$id,'Id');
		$this->output->set_common_meta($meta['title_tag'], $meta['meta_keyword_tag'], $meta['meta_desc_tag']);	
		
		
		
				
		$data['journal'] = $this->journal_model->journal_detail($id);
		$data['issue'] = $this->journal_model->issue_detail($id);
		$data['article'] = $this->journal_model->article($id);


		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/journal_home',$data);
	}		


	public function journal_particular_field()
	{
		$id = $this->uri->segment(2);
		$field = $this->uri->segment(3);
		
		if(!$id)
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect('journals');			
		}
		
		if(!$field)
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect('journals/home/'.$id);			
		}		
		
		$data['data']['journal'] = $this->journal_model->journal_detail($id);
		$data['data']['issue'] = $this->journal_model->issue_detail($id);		
		$data['field'] = $field;		
				
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/journal_particular_field',$data);
	}	
	
	public function articles()
	{
		
		$id = $this->uri->segment(2);		

		$this->load->library('pagination');

		$config['base_url'] = site_url('journal/'.$id.'/articles');
		
		$config['total_rows'] = $this->articles_model->total_results();
		$config['per_page'] = 10;
//		$config['display_pages'] = FALSE;
//		$config['first_link']  = TRUE;
//		$config['last_link']  = TRUE;
		$config['uri_segment'] = 4;
//		$config['use_page_numbers'] = TRUE;		
		
//		$config['next_link'] = '&larr; Older posts';
//		$config['next_tag_open'] = '<p class="meta-nav-prev">';
//		$config['next_tag_close'] = '</p>';	
		
//		$config['prev_link'] = 'Newer posts &rarr;';
//		$config['prev_tag_open'] = '<p class="meta-nav-next">';
//		$config['prev_tag_close'] = '</p>';				
		
		$this->pagination->initialize($config);
		
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
		
		$data['pagination'] = $this->pagination->create_links();
				
		$data['data'] = $this->articles_model->listing($offset,$config['per_page']);
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/articles/articles',$data);
		
	}	



	function about_journal($para1 ,$para2 = FALSE)
		{

		$data['journal'] = $this->journal_model->getResult('journals','Id',$para1);
		$data['issue'] = $this->journal_model->issue_detail($para1);
		$data['article'] = $this->journal_model->article($para1);
		$data['idGET'] = $para1;
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/about-journal',$data);
	
		
		}
		
	function journal_home($para1 ,$para2 = FALSE)
		{
		 
             if(!$para1)
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect('journals');
		}


		$data['journal'] = $this->journal_model->getResult('journals','Id',$para1);
		$data['issue'] = $this->journal_model->issue_detail($para1);
		$data['article'] = $this->journal_model->article($para1);
		$data['idGET'] = $para1;
			
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/journal_home',$data);
		
			
			}

	function editorial_policy($para1){
		$data['journal'] = $this->journal_model->getResult('journals','Id',$para1);
		$data['idGET'] = $para1;
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/editorial_policy',$data);
		
		
		}
function authors_instruction($para1)
	{
			
		$data['journal'] = $this->journal_model->getResult('journals','Id',$para1);
		$data['idGET'] = $para1;
	
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/authors-instruction',$data);
			
			}			
	
function board_member($para1)
	{
			
		$data['journal'] = $this->journal_model->getResult('journals','Id',$para1);
		$data['idGET'] = $para1;
	
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/editorial-board-members',$data);
			
			}			

function script_submission($para1)
	{
			
		$data['journal'] = $this->journal_model->getResult('journals','Id',$para1);
		$data['idGET'] = $para1;
	
	//pr($data['journal']);
	
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/manuscript-submission',$data);
			
			}	

       function upcoming_journals()
	{
		
			
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('/upcoming_journals/');
						
		$config['total_rows'] = $this->journal_model->category_count();
		
		$config['per_page'] = 10;
		$config['display_pages'] = TRUE;
		$config['first_link']  = FALSE;
		$config['last_link']  = FALSE;
		$config['uri_segment'] = 2;
		$config['use_page_numbers'] = TRUE;		
		
		$config['full_tag_open'] = '<div class="pagination" style="text-align:left; padding-left:10px;">';
		
		$config['prev_link'] = '&lt; Previous';
		
		$config['next_link'] = 'Next &gt;';
			
		$config['full_tag_close'] = '</div>';
				
		$this->pagination->initialize($config);
		
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;		
		
		$data['results'] = $this->journal_model->category_lists($config["per_page"], $offset * $config["per_page"]);
			
		$data["links"] = $this->pagination->create_links();
       		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/upcoming_journal',$data);
		
		}			
}

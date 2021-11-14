<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issue extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->output->set_template('frontend');
		$this->load->model('issue_model');
		$this->load->model('journal_model');	
				
	}

	public function index()
	{	
		
	
		if(!$this->uri->segment(2))
		{
				$this->session->set_flashdata('error', 'Invalid Page Request.');
				redirect(site_url());
		}			
		
		$data['data'] = $this->issue_model->detail($this->uri->segment(2));
		
		$data['data']['issue'] = $data['data'];

		if(empty($data['data']))
		{
				$this->session->set_flashdata('error', 'Page does not exist.');
				redirect(site_url());
		}
		
		$data['data']['journal'] = $this->journal_model->journal_detail($data['data']['main_cat']);		
				
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/issue',$data);
		
	}

	public function archives()
	{	
	
		$id = $this->uri->segment(2);
		
		
		if(!$id)
		{
				$this->session->set_flashdata('error', 'Invalid Page Request.');
				redirect(site_url());
		}			
		
		$meta = getMetaTags('issues',$id,'Id');
		$this->output->set_common_meta($meta['title_tag'], $meta['meta_keyword_tag'], $meta['meta_desc_tag']);	

		$data['records2'] = $this->issue_model->issue_group_by_year($id);
		
		$data['data']['journal'] = $this->journal_model->journal_detail($id);
		$data['data']['issue'] = $this->journal_model->issue_detail($id);
				
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/archives',$data);
		
	}

function issues($para1)
  {
	  $issue = $data['issues'] = $this->journal_model->getResult('issues','Id',$para1);
	
	  $data['journal'] = $this->journal_model->getResult('journals','Id',$issue['main_cat']);
		$data['idGETS'] = $para1;
		$data['idGET'] = $issue['main_cat'];
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/journal/issue',$data);
	  
	  }

}

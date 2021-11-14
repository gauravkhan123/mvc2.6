<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcements extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->output->set_template('frontend');
		$this->load->model('announcements_model');
	}

	public function index()
	{
		
		$this->load->library('pagination');

		$config['base_url'] = site_url('announcements');
		
		$config['total_rows'] = $this->announcements_model->total_results();
		$config['per_page'] = 10;
//		$config['display_pages'] = FALSE;
//		$config['first_link']  = TRUE;
//		$config['last_link']  = TRUE;
		$config['uri_segment'] = 2;
//		$config['use_page_numbers'] = TRUE;		
		
//		$config['next_link'] = '&larr; Older posts';
//		$config['next_tag_open'] = '<p class="meta-nav-prev">';
//		$config['next_tag_close'] = '</p>';	
		
//		$config['prev_link'] = 'Newer posts &rarr;';
//		$config['prev_tag_open'] = '<p class="meta-nav-next">';
//		$config['prev_tag_close'] = '</p>';				
		
		$this->pagination->initialize($config);
		
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;		
		
		$data['pagination'] = $this->pagination->create_links();
		
				
		$data['data'] = $this->announcements_model->listing($offset,$config['per_page']);
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/announcement',$data);
		
	}
	
	public function announcement()
	{
		
		$id = $this->uri->segment(2);
		
		$data['data'] = $this->announcements_model->detail($id);
		
		
			//checking if record exist or not
			
			if(empty($data['data']))
			{
			$this->session->set_flashdata('error', 'This page does not exist. Please reivew the below list of announcements.');
			redirect('announcements'); 
			}
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/announcement-detail',$data);			
		
	}	

}
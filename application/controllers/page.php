<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->output->set_template('frontend');
		$this->load->model('front_page');
	}

	public function index()
	{
		$id = $this->uri->segment(2);
		
		if(!$id)
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect('404');	
		}
		
		$data['data'] = $this->front_page->show_content($id);
		
		if(empty($data['data']))
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect('404');	
		}
		
		$meta = getMetaTags('pages',$id,'alias');
		$this->output->set_common_meta($meta['title_tag'], $meta['meta_keyword_tag'], $meta['meta_desc_tag']);				
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/page',$data);
	}

}
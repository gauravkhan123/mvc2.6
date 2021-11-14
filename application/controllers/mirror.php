<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mirror extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->output->set_template('frontend');
		$this->load->model('mirror_model');
				
	}
	
	public function index()
	{
		die("Invalid Request");
	}		
	
	public function addarticles()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect('page/about-us');	
		}					
		
		$data = $this->mirror_model->article_detail($id);

		$data['stages'] = $this->mirror_model->stage_detail($data['Id']);
		$data['citation_authors'] = $this->mirror_model->citation_author_detail($data['Id']);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}	
		
	public function addjournal()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->journal_detail($id);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}		
	
	public function addissues()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->issues_detail($id);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}			


	public function addpages()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->pages_detail($id);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}	
	
	public function addtopmenu()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->topmenu_detail($id);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}		
	
	public function adddocuments()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->documents_detail($id);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}		
	
	public function addpictures()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
 
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->pictures_detail($id);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}			
	
	public function addannouncements()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->announcement_detail($id);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}	
	
	public function updatearticles()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		$last_update_date = $this->uri->segment(5);
		
		$last_update_date = str_replace("%20"," ",$last_update_date);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->articles_to_be_updated($id,$last_update_date);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}	
	
			public function updatecitation_authors()
			{
				$id = $this->uri->segment(3);
				$passcode = $this->uri->segment(4);
				$last_update_date = $this->uri->segment(5);
				
				$last_update_date = str_replace("%20"," ",$last_update_date);
				
				if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
				{
					$this->session->set_flashdata('error', 'Invalid Request');
					redirect(site_url());
				}					
				
				$data = $this->mirror_model->citation_authors_to_be_updated($id,$last_update_date);
				echo json_encode(array("response"=>$data)); 
				exit;		
			}	
			
			public function updatestages()
			{
				$id = $this->uri->segment(3);
				$passcode = $this->uri->segment(4);
				$last_update_date = $this->uri->segment(5);
				
				$last_update_date = str_replace("%20"," ",$last_update_date);
				
				if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
				{
					$this->session->set_flashdata('error', 'Invalid Request');
					redirect(site_url());
				}					
				
				$data = $this->mirror_model->stages_to_be_updated($id,$last_update_date);
				echo json_encode(array("response"=>$data)); 
				exit;		
			}						
			
			
	public function updatejournals()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		$last_update_date = $this->uri->segment(5);
		
		$last_update_date = str_replace("%20"," ",$last_update_date);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->journals_to_be_updated($id,$last_update_date);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}				


	public function updateissues()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		$last_update_date = $this->uri->segment(5);
		
		$last_update_date = str_replace("%20"," ",$last_update_date);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->issues_to_be_updated($id,$last_update_date);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}		
	
	
	public function updatepages()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		$last_update_date = $this->uri->segment(5);
		
		$last_update_date = str_replace("%20"," ",$last_update_date);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->pages_to_be_updated($id,$last_update_date);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}	
	
	public function updatetop_menu()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		$last_update_date = $this->uri->segment(5);
		
		$last_update_date = str_replace("%20"," ",$last_update_date);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->top_menu_to_be_updated($id,$last_update_date);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}	
	
	public function updatedocuments()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		$last_update_date = $this->uri->segment(5);
		
		$last_update_date = str_replace("%20"," ",$last_update_date);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->documents_to_be_updated($id,$last_update_date);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}	
	
	public function updatepictures()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		$last_update_date = $this->uri->segment(5);
		
		$last_update_date = str_replace("%20"," ",$last_update_date);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->pictures_to_be_updated($id,$last_update_date);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}	
	
	public function updateannouncements()
	{
		$id = $this->uri->segment(3);
		$passcode = $this->uri->segment(4);
		$last_update_date = $this->uri->segment(5);
		
		$last_update_date = str_replace("%20"," ",$last_update_date);
		
		if(sha1($passcode) != "ac00df58d47a2c50f9f0f1a2b66d5e2ddf0dd27d")
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(site_url());
		}					
		
		$data = $this->mirror_model->announcements_to_be_updated($id,$last_update_date);
		echo json_encode(array("response"=>$data)); 
		exit;		
	}										
					
	
}
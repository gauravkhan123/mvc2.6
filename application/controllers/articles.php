<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->output->set_template('frontend');
		$this->load->model('articles_model');
		


				
	}

	public function index()
	{
			
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('articles/');
						
		$config['total_rows'] = $this->articles_model->articles_count();
		
		$config['per_page'] = 10;
		$config['display_pages'] = TRUE;
		$config['first_link']  = FALSE;
		$config['last_link']  = FALSE;
		$config['uri_segment'] = 2;
		$config['use_page_numbers'] = TRUE;		
		
		$config['full_tag_open'] = '<div class="pagination">';
		
		$config['prev_link'] = '&lt; Previous';
		
		$config['next_link'] = 'Next &gt;';
			
		$config['full_tag_close'] = '</div>';
				
		$this->pagination->initialize($config);
		
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;		
		
		$data['results'] = $this->articles_model->articles_lists($config["per_page"], $offset * $config["per_page"]);
			
		$data["links"] = $this->pagination->create_links();
       		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/articles/articles',$data);
		
	}


	public function detail()
	{
		
		die;
		$id = $this->uri->segment(2);
		
		
		if(!$id)
		{
				$this->session->set_flashdata('error', 'Invalid Page Request.');
				redirect(site_url());
		}			
		
		$meta = getMetaTags('articles',$id,'Id');
		$this->output->set_common_meta($meta['title_tag'], $meta['meta_keyword_tag'], $meta['meta_desc_tag']);			
		
		$data['data'] = $this->articles_model->detail($id);
		


		if(empty($data['data']))
		{
				$this->session->set_flashdata('error', 'Page does not exist.');
				redirect(site_url());
		}		
		
		$data['data']['journal'] = $this->articles_model->journal_detail($data['data']['main_cat'],TRUE);		
		$data['data']['issue'] = $this->articles_model->issue_detail($data['data']['sub_cat'],TRUE);			

		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/articles/detail',$data);			
		
	}	
	
	public function reviewhistory()
	{
		
		$this->load->library('user_agent');		
		
		$id = $this->uri->segment(2);
		
		
		if(!$id)
		{
				$this->session->set_flashdata('error', 'Invalid Page Request.');
				redirect(site_url());
		}		

		
		$meta = getMetaTags('',$id,'','1');
		$this->output->set_common_meta($meta['title_tag'], $meta['meta_keyword_tag'], $meta['meta_desc_tag']);				
		
		$data['data'] = $this->articles_model->detail($id);
		$data['data']['journal'] = $this->articles_model->journal_detail($data['data']['main_cat'],TRUE);		
		$data['data']['issue'] = $this->articles_model->issue_detail($data['data']['sub_cat'],TRUE);			
		
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/articles/reviewhistory',$data);			
		
	}	
	
	public function postcomments()
	{
		
		$this->load->library('user_agent');		
		
		$id = $this->uri->segment(2);
		
		$data['data'] = $this->articles_model->detail($id);
		$data['data']['journal'] = $this->articles_model->journal_detail($data['data']['main_cat']);		
		$data['data']['issue'] = $this->articles_model->issue_detail($data['data']['sub_cat']);			
		
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/articles/postcomments',$data);			
		
	}		
	
	
	public function download()
	{
		//ob_start();
		//redirect(site_url());
//		die("dfd");

		$this->load->helper('download');
		
		 $id = $this->uri->segment(2);
		
		
		if(!$id)
		{
			$this->session->set_flashdata('error', 'Invalid Request');
			redirect(current_url());			
		}	
		
						
		$id = base64url_decode($id);

		
		 $id = explode("@@",$id);

		

		$record_id = $id[0];
		 $field = $id[1];
	
		if($field == 'ppf')
		{
			$field = 'provisional_pdf_file';
		}
		elseif($field == 'pf')
		{
			$field = 'pdf_file';
		}
		elseif($field == 'hf')
		{
			$field = 'html_file';
		}		
		
		 $filedetails = $this->articles_model->file_detail_to_download($record_id);
		
		//pr($filedetails[$field]);

		//pr(getJournalFilesFolder($record_id).$filedetails[$field]);
		
		if(!$this->check_auth($this->input->ip_address(),$record_id,$filedetails[$field])) 
		{
				$this->session->set_flashdata('error', 'Please purchase this article to download.');
				redirect('paynow/'.$record_id."/".$filedetails[$field]);				
		}
		else
		{	
			
			$path = getJournalFilesFolder($record_id).$filedetails[$field];
			
//			die($path);
			
			if(file_exists($path))
			{
				$data = file_get_contents($path); // Read the file's contents
				$name = $filedetails[$field];
			
				force_download($name, $data);
			}		
			else
			{
	/*				$this->load->library('email');
					$config['charset'] = 'utf-8';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					
					$this->email->clear();
					
					$message = "<html>
					<body>
					<p>Hi Admin,</p>
					
					<p>file not found - error found on one of below urls :</p>
					<p>".site_url('abstract/'.$record_id)."</p>	
					</body>
					</html>";
					
					$this->email->to(get_settings('8'));
					$this->email->from(get_settings('17'));
					$this->email->subject("file not found - error found");
					$this->email->message($message);
					$this->email->send();	*/				
				
				$this->session->set_flashdata('error', 'Sorry file does not exist.');
				redirect(site_url());			
			}
		}
	}
	
	
	function check_auth($ip_address,$article_id,$file)
	{
		
		/////////////token auuthorization
		$tokens = array("7326732dfaee80f6aaa7485989f15dc6","4a5f48b398027caa5115f76072926245","2ada2a1d0c88dda618fa98fa968a72e2","0e7e3e0abd976faa0be7d91d5ebdc867","2c62ffa01a30790d4374a05b11e444f6");
		
		if($this->session->userdata('validses'))
		{
			$masterkey = $this->session->userdata('validses');
		}
		
		if($masterkey and in_array($masterkey,$tokens))
		{
			return true;
		}
		/////////////token auuthorization ends		
		
		
		/////////////check_multiple_auth auuthorization		
		
		$userdata = $this->session->userdata('frontuser');		
		
		if(check_multiple_auth($userdata['id'],$article_id)) 
		{
			
					return true;	
		}
		
		/////////////check_multiple_auth auuthorization ends		
		
		
		$sql = "SELECT count(order_id) as total_count FROM `article_orders` 
				WHERE 1 AND article_id='".$article_id."' AND file_name='".$file."' AND ip_address='".$ip_address."' AND txn_id<>'' AND update_date<>'0000-00-00 00:00:00' AND `update_date` > NOW() - INTERVAL `validity_hours` HOUR";

				
		 $query = $this->db->query($sql);
		 $result = $query->row_array();		

		if($result['total_count'] > 0)
		{
			return true;	
		}
		else
		{
			return false;
		}
	}
	



         function article($id3)
		{
			
		
		$data['idGET3'] = (int)$id3;
		
		
		$article = $data['article'] = $this->journal_model->getResult('articles','Id',(int)$id3);
		
		$data['idGET'] = $main_cat = $article['main_cat'];
		
		$data['journal'] = $this->journal_model->getResult('journals','Id',$main_cat);
		
		$data['issue'] = $this->journal_model->issue_detail($main_cat);
	
		if(!empty($article)){
				$sql = "SELECT name FROM `issues` WHERE `Id` = ".$article['sub_cat'];
		        $query = $this->db->query($sql);
		        $ret = $data['issuename'] = $query->row_array();
		      
		        $fileext = explode(".",$article['html_file']);
		        $fileext = @$fileext[1];
		        $up_count = $article['download_count']+1;
		        
		        $sql_ins="update articles set download_count='$up_count' where Id='$id3'";
		        $rs_ins=$this->db->query($sql_ins);
			}
	
				
		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/articles/abstract',$data);
			}
			
	function archives($id2)
	{
		$data['idGET'] = $id2;
		$data['journal'] = $this->journal_model->getResult('journals','Id',$id2);
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/articles/archives' , $data);
		
		}	


function articles_press($para1)
	 {
		
		$data['journal'] = $this->journal_model->getResult('journals','Id',$para1);
		$data['idGET'] = $para1;
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/articles/articles-press' , $data);
		
		}	
function journal_article()
	{
		$para1 = $this->uri->segment(2);
		$this->load->library('pagination');
		
		$config['base_url'] = site_url("journal-articles/$para1");
						
		$config['total_rows'] = $this->articles_model->articlebymainid($para1);
		
		$config['per_page'] = 10;
		$config['display_pages'] = TRUE;
		$config['first_link']  = FALSE;
		$config['last_link']  = FALSE;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;		
		
		$config['full_tag_open'] = '<div class="pagination" style="text-align:left; padding-left:10px;">';
		
		$config['prev_link'] = '&lt; Previous';
		
		$config['next_link'] = 'Next &gt;';
			
		$config['full_tag_close'] = '</div>';
				
		$this->pagination->initialize($config);
		
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;		
		
		$data['results'] = $this->articles_model->articles_lists_byid($config["per_page"], $offset * $config["per_page"] , $para1);
//		echo $this->db->last_query();				
		$data["links"] = $this->pagination->create_links();
       		
		$this->load->section('header', 'frontend/includes/header');
		$this->load->section('footer', 'frontend/includes/footer');
		$this->load->view('frontend/articles/journal-articles',$data);
		
		}	


}

/* End of file articles.php */
/* Location: application/controllers/articles.php */
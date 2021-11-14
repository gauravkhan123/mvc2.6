<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mirror_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	public function article_detail($id)
	{
		$query = $this->db->query("select *,date as add_date,abstract as abstract_field FROM articles 
		WHERE 1
		AND Id > '".$id."' ORDER BY Id ASC LIMIT 1");
		return $query->row_array();
	}	

	public function stage_detail($id)
	{
		$query = $this->db->query("SELECT * FROM stages
		WHERE 1
		AND article_id = '".$id."'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}		
	
	public function citation_author_detail($id)
	{
		$query = $this->db->query("SELECT * FROM citation_authors
		WHERE 1
		AND article_id = '".$id."'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}	
	
	public function journal_detail($id)
	{
		$query = $this->db->query("SELECT * FROM `journals` WHERE Id > '".$id."' ORDER BY Id ASC LIMIT 1");
		return $query->row_array();
	}
	
	public function issues_detail($id)
	{
		$query = $this->db->query("SELECT * FROM `issues` WHERE Id > '".$id."' ORDER BY Id ASC LIMIT 1");
		return $query->row_array();
	}	
	
	public function pages_detail($id)
	{
		$query = $this->db->query("SELECT * FROM `pages` WHERE Id > '".$id."' ORDER BY Id ASC LIMIT 1");
		return $query->row_array();
	}		
	
	public function topmenu_detail($id)
	{
		$query = $this->db->query("SELECT * FROM `top_menu` WHERE Id > '".$id."' ORDER BY Id ASC LIMIT 1");
		return $query->row_array();
	}	
	
	public function documents_detail($id)
	{
		$query = $this->db->query("SELECT * FROM `documents` WHERE Id > '".$id."' ORDER BY Id ASC LIMIT 1");
		return $query->row_array();
	}	
	
	
	public function pictures_detail($id)
	{
		$query = $this->db->query("SELECT * FROM `pictures` WHERE Id > '".$id."' ORDER BY Id ASC LIMIT 1");
		return $query->row_array();
	}	
	
	public function announcement_detail($id)
	{
		$query = $this->db->query("SELECT * FROM `announcement_news` WHERE Id > '".$id."' ORDER BY Id ASC LIMIT 1");
		return $query->row_array();
	}		
	
	public function articles_to_be_updated($id,$last_update_date)
	{
		$query = $this->db->query("SELECT * FROM articles
		WHERE 1
		AND Id <= '".$id."'
		AND update_date > '".$last_update_date."'		
		AND update_date != '0000-00-00 00:00:00'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}	
	
			public function citation_authors_to_be_updated($id,$last_update_date)
			{
				$query = $this->db->query("SELECT * FROM citation_authors
				WHERE 1
				AND Id <= '".$id."'
				AND update_date > '".$last_update_date."'		
				AND update_date != '0000-00-00 00:00:00'
				ORDER BY Id ASC
				");
				
				return $query->result_array();
			}	
			
			public function stages_to_be_updated($id,$last_update_date)
			{
				$query = $this->db->query("SELECT * FROM stages
				WHERE 1
				AND Id <= '".$id."'
				AND update_date > '".$last_update_date."'		
				AND update_date != '0000-00-00 00:00:00'
				ORDER BY Id ASC
				");
				
				return $query->result_array();
			}				
	
	public function journals_to_be_updated($id,$last_update_date)
	{
		$query = $this->db->query("SELECT * FROM journals
		WHERE 1
		AND Id <= '".$id."'
		AND update_date > '".$last_update_date."'		
		AND update_date != '0000-00-00 00:00:00'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}
	
	public function issues_to_be_updated($id,$last_update_date)
	{
		$query = $this->db->query("SELECT * FROM issues
		WHERE 1
		AND Id <= '".$id."'
		AND update_date > '".$last_update_date."'		
		AND update_date != '0000-00-00 00:00:00'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}		
				
	public function pages_to_be_updated($id,$last_update_date)
	{
		$query = $this->db->query("SELECT * FROM pages
		WHERE 1
		AND Id <= '".$id."'
		AND update_date > '".$last_update_date."'		
		AND update_date != '0000-00-00 00:00:00'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}		
	
	public function top_menu_to_be_updated($id,$last_update_date)
	{
		$query = $this->db->query("SELECT * FROM top_menu
		WHERE 1
		AND Id <= '".$id."'
		AND update_date > '".$last_update_date."'		
		AND update_date != '0000-00-00 00:00:00'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}		
	
	public function documents_to_be_updated($id,$last_update_date)
	{
		$query = $this->db->query("SELECT * FROM documents
		WHERE 1
		AND Id <= '".$id."'
		AND update_date > '".$last_update_date."'		
		AND update_date != '0000-00-00 00:00:00'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}	
	
	public function pictures_to_be_updated($id,$last_update_date)
	{
		$query = $this->db->query("SELECT * FROM pictures
		WHERE 1
		AND Id <= '".$id."'
		AND update_date > '".$last_update_date."'		
		AND update_date != '0000-00-00 00:00:00'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}		
	
	public function announcements_to_be_updated($id,$last_update_date)
	{
		$query = $this->db->query("SELECT * FROM announcement_news

		WHERE 1
		AND Id <= '".$id."'
		AND update_date > '".$last_update_date."'		
		AND update_date != '0000-00-00 00:00:00'
		ORDER BY Id ASC
		");
		
		return $query->result_array();
	}						
	
}
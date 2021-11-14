<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcements_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function listing($offset,$per_page)
	{
		
		$query = $this->db->query("SELECT Id,name,alias,description FROM announcement_news
		WHERE 1
		AND publish = 1
		ORDER BY name
		LIMIT $offset, $per_page
		");
		
		return $query->result_array();
	}


	public function detail($id)
	{
		$query = $this->db->query("select name,description FROM announcement_news 
		WHERE 1
		AND publish = 1
		AND alias='".$id."'");
		return $query->row_array();
	}	
	
	public function total_results()
	{


		$query = $this->db->query("SELECT Id,name,description FROM announcement_news
		WHERE 1
		AND publish = 1
		ORDER BY name
		");
		
		return $query->num_rows();
	}	
	
	
	public function listing_backend($offset,$per_page)
	{
	
		$query = $this->db->query("SELECT * FROM announcement_news
		WHERE 1
		AND publish <> 2
		ORDER BY $this->db_id DESC
		LIMIT $offset, $per_page
		");
		
		return $query->result_array();
	}	
	
	public function total_results_backend()
	{

		$query = $this->db->query("SELECT * FROM announcement_news
		WHERE 1
		AND publish <> 2		
		ORDER BY $this->db_id DESC
		");
		
		return $query->num_rows();
	}		

}
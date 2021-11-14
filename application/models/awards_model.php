<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Awards_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function listing($offset,$per_page)
	{
		
		$query = $this->db->query("SELECT Id,name,alias,description FROM sd_awards
		WHERE 1
		AND publish = 1
		ORDER BY name
		LIMIT $offset, $per_page
		");
		
		return $query->result_array();
	}


	public function detail($id)
	{
		$query = $this->db->query("select name,description FROM sd_awards 
		WHERE 1
		AND publish = 1
		AND alias='".$id."'");
		return $query->row_array();
	}	
	
	public function total_results()
	{


		$query = $this->db->query("SELECT Id,name,description FROM sd_awards
		WHERE 1
		AND publish = 1
		ORDER BY name
		");
		
		return $query->num_rows();
	}	

}
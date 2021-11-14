<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function listing($offset,$per_page)
	{
		
		$query = $this->db->query("SELECT Id,name,abstract,main_cat,sub_cat FROM manuscript
		WHERE 1
		AND publish = 1
		ORDER BY name
		LIMIT $offset, $per_page
		");
		
		return $query->result_array();
	}
	
	public function listing_journal($offset,$per_page,$journalID)
	{
		
		if($journalID != 'all')
		{
			$where = "AND main_cat = '".$journalID."'";
		}
		else
		{
			$where = "";
		}		
		
		$query = $this->db->query("SELECT Id,name,abstract,main_cat,sub_cat FROM manuscript
		WHERE 1
		AND publish = 1
		$where
		ORDER BY name
		LIMIT $offset, $per_page
		");
		
		return $query->result_array();
	}	
	
	


	public function detail($id)
	{
		$query = $this->db->query("select * FROM manuscript 
		WHERE 1
		AND publish = 1
		AND Id='".$id."'");
		return $query->row_array();
	}	
	
	public function journal_detail($id,$evenUnpublished)
	{
		
		$condition = "";		
		if(!$evenUnpublished)
		{
		$condition = " AND publish = 1	";
		}
		
		$query = $this->db->query("select * FROM journals 
		WHERE 1
		$condition
		AND Id='".$id."'");
		return $query->row_array();
	}
	
	public function issue_detail($id,$evenUnpublished)
	{

		$condition = "";		
		if(!$evenUnpublished)
		{
		$condition = " AND publish = 1	";
		}		
		
		$query = $this->db->query("select * FROM issues 
		WHERE 1
		$condition
		AND Id='".$id."'");
		return $query->row_array();
	}		
	
		
	
	
	
	public function total_results()
	{


		$query = $this->db->query("SELECT Id,name,abstract,main_cat,sub_cat FROM manuscript
		WHERE 1
		AND publish = 1
		ORDER BY name
		");
		
		return $query->num_rows();
	}	
	
	public function total_results_journal($journalID)
	{
		
		if($journalID != 'all')
		{
			$where = "AND main_cat = '".$journalID."'";
		}
		else
		{
			$where = "";
		}


		$query = $this->db->query("SELECT Id,name,abstract,main_cat,sub_cat FROM manuscript
		WHERE 1
		AND publish = 1
		$where
		ORDER BY name
		");
		
		return $query->num_rows();
	}
	
	
	public function listing_backend($condition,$offset,$per_page)
	{
		
		$query = $this->db->query("SELECT * FROM users 
		$condition
		AND publish <> 2
		ORDER BY $this->db_id DESC
		LIMIT $offset, $per_page
		");
		
		return $query->result_array();
	}	
	
	public function total_results_backend($condition)
	{
		$query = $this->db->query("SELECT * FROM users 
		$condition
		AND publish <> 2
		ORDER BY $this->db_id DESC
		");
		
		return $query->num_rows();
	}

	
}
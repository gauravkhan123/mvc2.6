<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Issue_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function listing($journalID)
	{

		$query = $this->db->query("SELECT * FROM issues
		WHERE 1
		AND publish = 1
		AND main_cat = '".$journalID."'
		ORDER BY Id DESC
		");
		
		return $query->result_array();
	}
	
	
	

	
	public function issue_group_by_year($journalID)
	{

		$query = $this->db->query("SELECT year FROM issues
		WHERE 1
		AND publish = 1
		AND main_cat = '".$journalID."'
		GROUP BY year 
		ORDER BY year DESC
		");
		
		$records = $query->result_array();

		if(!empty($records))
		{
			foreach($records as $value)
			{
				$array = $this->volume_group_by_volume($journalID,$value['year']);
				
				if(!empty($array))
				{
					foreach($array as $value2)
					{
						$records2[$value['year']][] = $value2['volume'];
					}
				}

			}
		}		
		
		return $records2;
	}	
	
	public function volume_group_by_volume($journalID,$year)
	{

		$query = $this->db->query("SELECT * FROM issues
		WHERE 1
		AND publish=1
		AND main_cat='".$journalID."'
		AND year='".$year."'
		GROUP BY volume
		ORDER BY volume DESC
		");
		
		return $query->result_array();		
	}	
	
	
	
	
	public function detail($id)
	{

		$query = $this->db->query("SELECT * FROM issues
		WHERE 1
		AND publish = 1
		AND Id = '".$id."'
		ORDER BY Id DESC
		");
		return $query->row_array();
	}
	
	public function journal_detail($id)
	{

		$query = $this->db->query("SELECT * FROM journals
		WHERE 1
		AND publish = 1
		AND main_cat = '".$id."'
		ORDER BY Id DESC
		");
		return $query->row_array();
	}		
	
	
	
	
	
	public function listing_backend($condition,$offset,$per_page)
	{
	
		$query = $this->db->query("SELECT * FROM issues
		$condition
		AND publish <> 2
		ORDER BY $this->db_id DESC
		LIMIT $offset, $per_page
		");
		
		return $query->result_array();
	}	
	
	public function total_results_backend($condition)
	{

		$query = $this->db->query("SELECT * FROM issues
		$condition
		AND publish <> 2		
		ORDER BY $this->db_id DESC
		");
		
		return $query->num_rows();
	}			


}
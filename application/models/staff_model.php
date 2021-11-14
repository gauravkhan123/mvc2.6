<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();

	}

	public function edit_record_staff($table,$where,$id)
	{
		$query = $this->db->query("SELECT * from $table 
		WHERE 1
		AND publish != 2
		AND $where = $id
		");
		
		return $query->row_array();
	}	
	

}

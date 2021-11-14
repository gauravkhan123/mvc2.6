<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();

	}
	
	public function get_fields($table)
	{

		$query = $this->db->query("SELECT * from $table 
		WHERE 1
		AND publish = 1
		ORDER BY ordering
		");
		
		return $query->result_array();
	}	

	
	public function update_a_record($table,$data)
	{
		///////////////////emptying all checkboxes
				$insertVal['value'] = '';
				$this->db->where('field_type', 'checkbox');
				$this->db->update($table, $insertVal);
		//////////////////////////////////////////
		
		if(!empty($data))
		{
			foreach($data as $key=>$value)
			{
				$insertData['value'] = $value;
				
				$this->db->where('id', $key);
				$this->db->update($table, $insertData); 
			}
		}
		
		return TRUE;
	}	
	
	

}

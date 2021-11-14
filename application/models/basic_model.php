<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Basic_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();

	}

	public function list_result($coloums,$table)
	{
		$query = $this->db->query("SELECT ".implode(",",$coloums)." from $table 
		WHERE 1
		AND publish != 2
		order by Id DESC");
		
		return $query->result_array();
	}
	
	public function view_record($coloums,$table,$where,$id)
	{
		$query = $this->db->query("SELECT ".implode(",",$coloums).",CASE WHEN publish=1 THEN 'Active' ELSE 'In-Active' END as publish from $table 
		WHERE 1
		AND publish != 2
		AND $where = $id
		");
		
		return $query->row_array();
	}	
	
	public function view_record_query($query)
	{
		$query = $this->db->query($query);
		
		return $query->row_array();
	}		
	
	public function edit_record($table,$where,$id)
	{
		$query = $this->db->query("SELECT * from $table 
		WHERE 1
		AND publish != 2
		AND $where = $id
		");
		
		return $query->row_array();
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
	
	public function add_a_record($table,$data)
	{
		$this->db->insert($table, $data); 	
		return $this->db->affected_rows();
	}	
	
	public function update_a_record($table,$data,$where,$id)
	{
		$this->db->where($where, $id);
		$this->db->update($table, $data); 
		
		return $this->db->affected_rows();
	}		
	
	public function change_status_of_a_record($table,$data,$where,$id)
	{
		$this->db->where($where, $id);
		$this->db->update($table, $data); 
		
		return $this->db->affected_rows();
		
	}	
	
	public function delete_a_record($table,$array)
	{
		$this->db->delete($table, $array);
		return $this->db->affected_rows();
		
	}		
	
	public function bulkaction($table,$where)
	{
		$status=0;
		
		if($this->input->post('bulkaction')=='active')
		{
			$status=1;
		}
		else if($this->input->post('bulkaction')=='inactive')
		{
			$status=0;
		}
		else if($this->input->post('bulkaction')=='delete')
		{
			$status=2;
		}
		
		$ids = $this->input->post('ids');
		
		$this->db->where_in($where, $ids);
		
		$this->db->update($table, array('publish' => $status));
	}	
	
	public function dropdown_list($query)
	{
		$query = $this->db->query($query);
		
		return $query->result_array();
	}	
	

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();

	}
	
	public function view_record($coloums,$table,$where,$id)
	{
		$query = $this->db->query("SELECT (SELECT title from categories where id=category) as category_name,".implode(",",$coloums).",CASE WHEN publish=1 THEN 'Active' ELSE 'In-Active' END as publish from $table 
		WHERE 1
		AND publish != 2
		AND $where = $id
		");
		
		return $query->row_array();
	}		

	public function category_list()
	{
		$query = $this->db->query("SELECT * FROM categories
		WHERE 1
		AND publish = 1
		ORDER BY title");
		
		return $query->result_array();
	}
	
	public function import_sms()
	{
		$query = $this->db->query("SELECT node.nid, node.title, field_data_body.body_value, taxonomy_index.tid, taxonomy_term_data.name
FROM `node`
LEFT JOIN field_data_body ON field_data_body.entity_id = node.nid
LEFT JOIN taxonomy_index ON taxonomy_index.nid = node.nid
LEFT JOIN taxonomy_term_data ON taxonomy_term_data.tid = taxonomy_index.tid
WHERE taxonomy_index.tid != ''
ORDER BY taxonomy_index.tid");
		
		return $query->result_array();
	}	
	
	
}

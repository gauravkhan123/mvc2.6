<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Journal_Model extends CI_Model {

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

	public function show_subjects()
	{
		$query = $this->db->query("SELECT * FROM categories_spl
		WHERE 1
		AND publish = 1	
		ORDER BY name");
		
		return $query->result_array();
	}
	
	public function show_subjects_upcomingjournals()
	{
		$query = $this->db->query("SELECT * FROM categories_spl
		WHERE 1
		AND publish = 1		
		ORDER BY name");
		
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
	
	
	
	public function journal_detail($id)
	{
		$query = $this->db->query("select * from  journals where Id='".$id."'");
		return $query->row_array();
	}	

	public function issue_detail($id)
	{
		$query = $this->db->query("select * from  issues where main_cat='".$id."' and publish=1 order by Id desc limit 1");
		return $query->row_array();
	}		
	

       public function getResult($tbl , $fld , $id)
	{
		$sql = "select * from ".$tbl." where ".$fld." = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row_array();
		
		}
	public function article($idGET)
	{
		$sql = "select * from articles where main_cat='$idGET' and publish=1 order by Id desc limit 7";
		$query = $this->db->query($sql);
		return $query->result_array();
		
		
		}	
	function quicklinks()
	{
		$sql = "select * from quicklinks_journal where publish=1 order by serial";
		$query = $this->db->query($sql);
		return $query->result_array();
		
		}
		
	function junral_limit($fst , $sec)
	{
		$sql = "select * from journals where upcoming=1 order by Id desc limit ".$fst.",".$sec;
		$query = $this->db->query($sql);
		return $query->result_array();
		}	


       public function category_count()
	{
		return $this->db->count_all("categories_spl");
		
		}	
		
	public function category_lists($limit, $start)
	{
		
		$this->db->limit($limit, $start);
		$this->db->select('*');
		$this->db->order_by("name", "asc"); 
        $query = $this->db->get("categories_spl");
        
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
					
		}	

	
}
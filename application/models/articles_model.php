<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function listing($offset,$per_page)
	{
		
		$query = $this->db->query("SELECT Id,name,abstract,main_cat,sub_cat FROM articles
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
		
		$query = $this->db->query("SELECT Id,name,abstract,main_cat,sub_cat FROM articles
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
		$query = $this->db->query("select * FROM articles 
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


		$query = $this->db->query("SELECT Id,name,abstract,main_cat,sub_cat FROM articles
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


		$query = $this->db->query("SELECT Id,name,abstract,main_cat,sub_cat FROM articles
		WHERE 1
		AND publish = 1
		$where
		ORDER BY name
		");
		
		return $query->num_rows();
	}
	
	
	public function listing_backend($condition,$offset,$per_page)
	{
	
		$query = $this->db->query("SELECT *,date_format(date,'%b %d %Y %h:%i %p') as date FROM articles
		$condition
		AND publish <> 2
		ORDER BY $this->db_id DESC
		LIMIT $offset, $per_page
		");
		
		return $query->result_array();
	}	
	
	public function total_results_backend($condition)
	{

		$query = $this->db->query("SELECT * FROM articles
		$condition
		AND publish <> 2		
		ORDER BY $this->db_id DESC
		");
		
		return $query->num_rows();
	}
	
	
	public function listing_advancedsearch($condition,$offset,$per_page)
	{
		$query = $this->db->query("SELECT 
		A.name as journalName,
		A.issn,
		B.page_no,
		B.main_cat,
		B.sub_cat,
		B.Id,
		B.name,
		B.abstract,
		B.authors,
		B.keywords,
		B.full_text,
		B.page_no,B.year,
		C.name as issue,
		C.volume 
		FROM journals A 
		LEFT JOIN articles B on A.Id=B.main_cat 
		LEFT JOIN issues C on B.sub_cat=C.Id
		$condition
		AND A.publish=1 
		GROUP BY A.Id
		ORDER BY A.Id DESC
		LIMIT $offset, $per_page
		");
		
		return $query->result_array();
	}	
	
	public function total_results_advancedsearch($condition)
	{
		$query = $this->db->query("SELECT 
		A.name as journalName,
		A.issn,
		B.page_no,
		B.main_cat,
		B.sub_cat,
		B.Id,
		B.name,
		B.abstract,
		B.authors,
		B.keywords,
		B.full_text,
		B.page_no,B.year,
		C.name as issue,
		C.volume 
		FROM journals A 
		LEFT JOIN articles B on A.Id=B.main_cat 
		LEFT JOIN issues C on B.sub_cat=C.Id
		$condition
		AND A.publish=1 
		GROUP BY A.Id
		ORDER BY A.Id DESC
		");
		
		return $query->num_rows();
	}	
	
	
	public function file_detail_to_download($id)
	{
		$query = $this->db->query("select * FROM articles 
		WHERE 1
		AND publish = 1
		AND Id='".$id."'");
		return $query->row_array();
	}	
	
       public function articles_count()
	{
		return $this->db->count_all("articles");
		
		}
	
       public function articles_lists($limit, $start)
	{
		
		$this->db->limit($limit, $start);
		$this->db->select('Id,name,abstract,main_cat,sub_cat');
		$this->db->order_by("Id", "desc"); 
        $query = $this->db->get("articles");
        
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
					
		}
	function articlebymainid($id)
	{
		$this->db->where(array('main_cat'=> $id,'publish' => 1))
		->from('articles');
		$result = $this->db->count_all_results();
		return $result;
		}
	public function articles_lists_byid($limit, $start , $id)
	{
		
		$this->db->limit($limit, $start);
		$this->db->select('Id,name,abstract,main_cat,sub_cat');
		$this->db->where(array('main_cat'=> $id,'publish' => 1));
		$this->db->order_by("Id", "desc"); 
        $query = $this->db->get("articles");
        
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
					
		}
		
	
}
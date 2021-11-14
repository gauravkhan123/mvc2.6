<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Coupon_Model extends CI_Model {



	function __construct()

	{

		parent::__construct();

	}




	public function listing_backend($condition,$offset,$per_page)

	{
	

		$query = $this->db->query("SELECT A.*,B.name,B.username FROM coupons A LEFT JOIN users B on A.reviewer_id=B.Id 

		$condition

		AND A.publish <> 2

		ORDER BY A.$this->db_id DESC

		LIMIT $offset, $per_page

		");

		

		return $query->result_array();

	}	

	

	public function total_results_backend($condition)

	{



		$query = $this->db->query("SELECT A.*,B.name,B.username FROM coupons A LEFT JOIN users B on A.reviewer_id=B.Id 

		$condition

		AND A.publish <> 2

		ORDER BY A.$this->db_id DESC

		");

		

		return $query->num_rows();

	}

	

	


	

}
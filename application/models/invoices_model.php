<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Invoices_Model extends CI_Model {



	function __construct()

	{

		parent::__construct();

	}
	

	public function listing_backend($condition,$offset,$per_page)

	{
	

		$query = $this->db->query("select m.Id,m.status,m.title,m.journal_id,m.author_id,m.ms_word_file,m.date,o.id as orderid,DATE_FORMAT(o.date,'%e-%c-%Y, %h:%i:%S %p') as orderdate,o.discount,o.payment,j.name,j.short_name,a.name,a.username,a.country from manuscript m LEFT JOIN users a on m.author_id=a.Id LEFT JOIN journals j on m.journal_id=j.Id LEFT JOIN orders o on m.Id=o.mid $condition and m.Id=o.mid group by o.mid order by o.Id desc

		LIMIT $offset, $per_page

		");

			return $query->result_array();
		

	}	

	

	public function total_results_backend($condition)

	{



		$query = $this->db->query("select m.Id,m.status,m.title,m.journal_id,m.author_id,m.ms_word_file,m.date,o.id as orderid,DATE_FORMAT(o.date,'%e-%c-%Y, %h:%i:%S %p') as orderdate,o.discount,o.payment,j.name,j.short_name,a.name,a.username,a.country from manuscript m LEFT JOIN users a on m.author_id=a.Id LEFT JOIN journals j on m.journal_id=j.Id LEFT JOIN orders o on m.Id=o.mid $condition and  m.Id=o.mid group by o.mid order by o.Id desc

		");

		

		return $query->num_rows();

	}


}
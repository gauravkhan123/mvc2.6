<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Front_Page extends CI_Model {



	function __construct()

	{

		parent::__construct();



	}

	

	public function show_content($alias)

	{

		$query = $this->db->query("SELECT * FROM pages WHERE alias = '".$alias."' AND `publish` = '1'");

		return $query->row_array();

	}	

	

	public function show_video_gallery()

	{

		$query = $this->db->query("SELECT * FROM `video_gallery` WHERE 1 AND `publish` = '1'");

		return $query->result_array();

	}	

	

	public function show_image_gallery()

	{

		$query = $this->db->query("SELECT * FROM `image_gallery` WHERE 1 AND `publish` = '1'");

		return $query->result_array();

	}					

	

	public function show_testimonials()

	{

		$query = $this->db->query("SELECT * FROM `testimonials` WHERE 1 AND `publish` = '1' ORDER BY id DESC");

		return $query->result_array();

	}		

	

}


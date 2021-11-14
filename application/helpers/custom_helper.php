<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('pr'))
{
	function pr($array,$val=true)
	{
		echo "<pre>";
		print_r($array);
		echo "</pre>";				
		if($val){
			die;
		}
		
	}
}

if ( ! function_exists('current_date'))
{
	function current_date($format)
	{
			return date($format);
	}
}

if ( ! function_exists('get_one_record'))
{
	function get_one_record($query)
	{
		$CI =& get_instance();
				
		$query = $CI->db->query($query);
		$data = $query->row_array();

		if($data) {
			return $data;	
		} 
		else
		{
			return false;
		}
	}
}

if ( ! function_exists('get_corresponing_value'))
{
	function get_corresponing_value($table,$column,$str,$match)
	{
		
		$CI =& get_instance();
				
		$query = $CI->db->query("SELECT $column FROM $table WHERE 1 AND $match = '".$str."'");
		$data = $query->row_array();

		if(!empty($data)) {
			
			return $data[$column];	
		} 
		else
		{
			return "";
		}
	}
}


if ( ! function_exists('get_few_record'))
{
	function get_few_record($query)
	{
		$CI =& get_instance();
				
		$query = $CI->db->query($query);
		$data = $query->result_array();					

		if($data) {
			return $data;	
		} 
		else
		{
			return false;
		}
	}
}


if ( ! function_exists('get_dots'))
{
	function get_dots($table,$field,$id,$chars)
	{
		$CI =& get_instance();		
		
		$query = $CI->db->query("select $field from $table where id='".$id."'");
		$data = $query->row_array();
		
		$get_dots = strlen($data[$field]);
		if($get_dots < $chars)
		{
			$get_dots = "";
		} else
		{
			$get_dots = "...";
		}
		return $get_dots;
	}
}


if ( ! function_exists('get_dots_new'))
{
	function get_dots_new($table,$field,$id,$chars)
	{
		$CI =& get_instance();		
		
		$query = $CI->db->query("select $field from $table where id='".$id."'");
		$data = $query->row_array();
		
		$get_dots = strlen($data[$field]);
		
		if($get_dots < $chars)
		{
			$get_dots = "";
		} else
		{
			$get_dots = "...";
		}
		return substr(strip_tags($data[$field]),0,$chars) . $get_dots;
	}
}


if ( ! function_exists('manuscriptNo'))
{
	function manuscriptNo($mid)
	{
		$CI =& get_instance();		
		
		$query = $CI->db->query("select m.*,a.name,j.name,a.country,j.short_name from manuscript m LEFT JOIN users a on m.author_id=a.Id LEFT JOIN journals j on m.journal_id=j.Id where m.Id='$mid'");
		$data = $query->row_array();
		
		
		if($data['revised'] != 0)
		{
			$revised = '/R'.$data['revised'];
		}
		else
		{
			$revised = "";
		}

		$mid = substr($data['date'],0,4)."/";
		$mid .= get_short_name($data['journal_id']);
		$mid .= "/". $data['Id'] . $revised;

		return $mid;
	}
}





if ( ! function_exists('get_alias'))
{
	function get_alias($str)
	{
		$str = preg_replace('/[^\da-z]+/i', ' ', $str);
		$str = preg_replace('/\s/', '-', strtolower(trim($str)));
		return $str;
	}
}

if ( ! function_exists('get_settings'))
{
	function get_settings($id)
	{
		$CI =& get_instance();			

		$query = $CI->db->query("SELECT value FROM settings WHERE 1 AND id = '".$id."'");
		$data = $query->row_array();

		if($data['value']) {
			return $data['value'];	
		} 
		else
		{
			return false;
		}		
		

		
	}
}

if ( ! function_exists('unlink_image'))
{
	function unlink_image($table,$location,$id,$field="image")
	{
		$CI =& get_instance();			

		$query = $CI->db->query("SELECT $field FROM $table WHERE 1 AND Id = '".$id."'");
		$data = $query->row_array();

		if(!empty($data)) 
		{
			unlink($location.$data[$field]);
			return true;
		} 
		else 
		{
			return false;	
		}
	}
}


if ( ! function_exists('get_short_name'))
{
	function get_short_name($id)
	{
		$CI =& get_instance();			

		$query = $CI->db->query("SELECT short_name FROM journals WHERE 1 AND Id = '".$id."'");
		$data = $query->row_array();

		return strtoupper($data['short_name']);
	}
}


if ( ! function_exists('oldJournalFolder'))
{
	function oldJournalFolder($articleId)
	{
		$CI =& get_instance();			

		$query = $CI->db->query("SELECT main_cat FROM articles WHERE 1 AND Id = '".$articleId."'");
		$data = $query->row_array();

		return get_short_name($data['main_cat']).'_'.$data['main_cat'];
	}
}


if ( ! function_exists('getFolderNameYear'))
{
	function getFolderNameYear($id)
	{
		$CI =& get_instance();			

		$query = $CI->db->query("SELECT date FROM articles WHERE 1 AND Id = '".$id."'");
		$data = $query->row_array();

		$timestamp = strtotime($data['date']);	
		$folderName = date("/Y/",$timestamp);
	
		return $folderName;
	}
}

if ( ! function_exists('getFolderName'))
{
	function getFolderName($id)
	{
		$CI =& get_instance();			

		$query = $CI->db->query("SELECT date FROM articles WHERE 1 AND Id = '".$id."'");
		$data = $query->row_array();

		$timestamp = strtotime($data['date']);	
		$folderName = date("/Y/m/d/",$timestamp);
	
		return $folderName;
	}
}

if ( ! function_exists('unlinkImageJournal'))
{
	function unlinkImageJournal($field,$table,$column,$recordID)
	{
		$CI =& get_instance();			

		$query = $CI->db->query("SELECT $field,date FROM $table WHERE 1 AND $column = '".$recordID."'");
		$data = $query->row_array();

		$full_path = getJournalFilesFolder($recordID,'articleid');
		
		$tbd = $full_path.$data[$field];
	
		if(unlink($tbd))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

if ( ! function_exists('check_staff_permission'))
{
	function check_staff_permission($id,$module)
	{
		$CI =& get_instance();			

		$query = $CI->db->query("SELECT permissions FROM staff WHERE 1 AND publish = 1 AND Id = '".$id."'");
		$data = $query->row_array();

		$data['permissions'] = unserialize($data['permissions']);
	
		if(in_array($module,$data['permissions']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

if ( ! function_exists('getMetaTags'))
{
	function getMetaTags($table,$id,$field="id",$commonmeta="")
	{
		
			$CI =& get_instance();	
		
			$meta['title_tag'] = "";
			$meta['meta_keyword_tag'] = "";
			$meta['meta_desc_tag'] = "";
			
			$uri = current_url();
			
			if(!$commonmeta)
			{
				$query = $CI->db->query("SELECT title_tag,meta_keyword_tag,meta_desc_tag FROM meta_tags WHERE 1 AND publish = '1' AND fullurl = '".$uri."'");
				$misc_meta = $query->row_array();				
				
if(!empty($misc_meta))
				{
					$meta['title_tag'] = $misc_meta['title_tag'];
					$meta['meta_keyword_tag'] = $misc_meta['meta_keyword_tag'];
					$meta['meta_desc_tag'] = $misc_meta['meta_desc_tag'];								
				}
				else
				{
					
					if($table == '' && $id == '' && $field == 'default')
					{		
						$meta['title_tag'] = get_settings(11);
						$meta['meta_keyword_tag'] = get_settings(12);
						$meta['meta_desc_tag'] = get_settings(13);
					}					
					else
					{						
						$query = $CI->db->query("SELECT title_tag,meta_keyword_tag,meta_desc_tag FROM $table WHERE 1 AND $field = '".$id."'");
						$misc_meta = $query->row_array();
					
						$meta['title_tag'] = $misc_meta['title_tag'];
						$meta['meta_keyword_tag'] = $misc_meta['meta_keyword_tag'];
						$meta['meta_desc_tag'] = $misc_meta['meta_desc_tag'];					
					}
				}				
			}
			else
			{				

				$newuri = explode($id,$uri);

				$uri = $newuri[0].'wildcard';
				
				$query = $CI->db->query("SELECT availableReplacers,title_tag,meta_keyword_tag,meta_desc_tag FROM common_meta_tags WHERE 1 AND publish = '1' AND fullurl = '".$uri."'");
				$misc_meta = $query->row_array();
	
				$meta['title_tag'] = getReplacedReplacers($misc_meta['title_tag'],$misc_meta['availableReplacers']);
				$meta['meta_keyword_tag'] = getReplacedReplacers($misc_meta['meta_keyword_tag'],$misc_meta['availableReplacers']);
				$meta['meta_desc_tag'] = getReplacedReplacers($misc_meta['meta_desc_tag'],$misc_meta['availableReplacers']);
				
			}
			
		return $meta;			

	}
}



if ( ! function_exists('getReplacedReplacers'))
{
	function getReplacedReplacers($str,$availableReplacers) 
	{
	
		$availableReplacers = explode(",",$availableReplacers);
	
		if(!empty($availableReplacers))
		{
			foreach($availableReplacers as $value)
			{
				$str = str_replace($value,replacedValue($value),$str);
			}
		}
			
		return $str;
	}
}

if ( ! function_exists('replacedValue'))
{
	function replacedValue($replacer)
	{
		if($replacer == "[QUERY]")
		{
			//die($_GET['q']);
			$replacedValue = $_GET['q'];
		}
		elseif($replacer == "[USERNAME]")
		{
			$replacedValue = $_SESSION['user']['name'];
		}
		elseif($replacer == "[EMAIL]")
		{
			$replacedValue = $_SESSION['user']['username'];
		}
		elseif($replacer == "[ROLE]")
		{
			$replacedValue = $_SESSION['user']['role'];
		}
		elseif($replacer == "[ISSUE]")
		{
			$replacedValue = get_dots_new("issues","name",$_GET['iid'],"80");
		}
		elseif($replacer == "[JOURNAL]")
		{
			$replacedValue = get_dots_new("journals","name",$_GET['id'],"80");
		}
		elseif($replacer == "[ARTICLE_TITLE]")
		{
			$replacedValue = get_dots_new("articles","name",$_GET['aid'],"80");
		}
		elseif($replacer == "[ARTICLE_TEXT]")
		{
			$replacedValue = get_dots_new("articles","name",$_GET['aid'],"250");
		}
		elseif($replacer == "[MANUSCRIPT_NUMBER")
		{
			$replacedValue = manuscriptNo($_GET['mid']);
		}
		elseif($replacer == "[ASSIGNED_REVIEWER_1")
		{
			$replacedValue = assignedReviewer($_GET['mid'],"1");
		}
		elseif($replacer == "[ASSIGNED_REVIEWER_2")
		{
			$replacedValue = assignedReviewer($_GET['mid'],"2");
		}
		elseif($replacer == "[ASSIGNED_REVIEWER_3")
		{
			$replacedValue = assignedReviewer($_GET['mid'],"3");
		}
		elseif($replacer == "[ASSIGNED_REVIEWER_4")
		{
			$replacedValue = assignedReviewer($_GET['mid'],"4");
		}
		
//		pr($replacedValue);
	
		return $replacedValue;
	}
}

if ( ! function_exists('assignedReviewer'))
{
	function assignedReviewer($id,$number)
	{
		
		$CI =& get_instance();		
		
		$query = $CI->db->query("select assign_reviewer".$number." from  manuscript where Id = '".$id."'");
		$data = $query->row_array();		
		
		$reviewerId = $data['assign_reviewer'.$number];	
	
		if(empty($reviewerId))
		{
			return "";
		}
		
		$query2 = $CI->db->query("select name from  users where Id = '".$reviewerId."'");
		$data2 = $query2->row_array();			
			
		return $data2['name'];
	}
}


if ( ! function_exists('base64url_encode'))
{
	function base64url_encode($data) {
	  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}
}


if ( ! function_exists('base64url_decode'))
{
	function base64url_decode($data) {
	  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	} 
}

if ( ! function_exists('getJournalFilesFolder'))
{
	function getJournalFilesFolder($id,$by="articleid")
	{
		
		$CI =& get_instance();
		
		
		$path_prefix = 'media/journals/';
		$date_seg = "/Y/M/";
		
		
		if($by == "articleid")
		{
			$query = $CI->db->query("select main_cat,date from articles where Id = '".$id."'");
			$data = $query->row_array();	
			
			$timestamp = strtotime($data['date']);
			
			$full_path = $path_prefix.get_short_name($data['main_cat']).'_'.$data['main_cat'].date($date_seg,$timestamp);
			
		}
		elseif($by == "journalid")
		{
			$full_path = $path_prefix.get_short_name($id).'_'.$id.current_date($date_seg);
		}
		else
		{
			$full_path = "";
		}
		
		return $full_path;
	}
}

if ( ! function_exists('clean'))
{
	function clean($data)
	{
			return $data;
	}
}



if ( ! function_exists('check_multiple_auth'))
{
	function check_multiple_auth($sid,$aid)
	{
		$CI =& get_instance();		
		

		$query2 = $CI->db->query("SELECT main_cat,year,volume FROM articles where Id = '".$aid."'");
		$data2 = $query2->row_array();	
		
		
			$query3 = $CI->db->query("SELECT Id FROM issues where main_cat = '".$data2['main_cat']."' and year = '".$data2['year']."' and volume = '".$data2['volume']."'");
			$data3 = $query3->row_array();	




		$query = $CI->db->query("SELECT * FROM subscribers where id = '".$sid."'");
		$data = $query->row_array();			


										if(!empty($data['permissions']))
										{
											$permissions = unserialize($data['permissions']);
										}
										else
										{
											$permissions = array();	
										}
										

		$download = 0;
		
		if(!empty($data3))
		{
			foreach($data3 as $valcheck)
			{
				if(in_array($valcheck,$permissions))
				{
					$download = 1;
				}								
			}
		}

		if($download)
		{
			return true;	
		}
		else
		{
			return false;
		}
	}
}


if ( ! function_exists('randomPass'))

{

	function randomPass($number)

	{

		$arr = array('a', 'b', 'c', 'd', 'e', 'f',

					 'g', 'h', 'i', 'j', 'k', 'l',

					 'm', 'n', 'o', 'p', 'r', 's',

					 't', 'u', 'v', 'x', 'y', 'z',

					 'A', 'B', 'C', 'D', 'E', 'F',

					 'G', 'H', 'I', 'J', 'K', 'L',

					 'M', 'N', 'O', 'P', 'R', 'S',

					 'T', 'U', 'V', 'X', 'Y', 'Z',

					 '1', '2', '3', '4', '5', '6',

					 '7', '8', '9', '0');

		$token = "";

		for ($i = 0; $i < $number; $i++) {

			$index = rand(0, count($arr) - 1);

			$token .= $arr[$index];

		}

	

		return $token;

	}

}



if ( ! function_exists('getCount'))

{

	function getCount($query) {



		$CI =& get_instance();		

		

		$query = $CI->db->query($query);

		$data = $query->row_array();

		

		return sizeof($data);

	}

}



if ( ! function_exists('specialchars'))

{

	function specialchars($data)

	{

		

		$find = array('â€œ', 'â€™', 'â€¦', 'â€"', 'â€"', 'â€˜', 'Ã©', 'Â', 'â€¢', 'Ëœ', 'â€');

        $replace = array('"', "'", '…', '—', '–', "'", 'é', '', '•', '˜', '"');

		

		$data = str_replace($find, $replace, $data);		

		

			return $data;

	}

}





if ( ! function_exists('get_last_dept_comment'))

{

	function get_last_dept_comment($mid,$dept_id)

	{

		$CI =& get_instance();		

		

//		pr("select comment,staff_id,date from dept_comments where manuscript_id='".$mid."' AND dept_id='".$dept_id."' ORDER BY Id DESC LIMIT 1");

		

		$query = $CI->db->query("select comment,staff_id,date from dept_comments where manuscript_id='".$mid."' AND dept_id='".$dept_id."' ORDER BY Id DESC LIMIT 1");

		$data = $query->row_array();

		

		if(!empty($data))

		{						

		

			if($data['comment'])

			{

				return "<p title='By ".get_staff_info($data['staff_id'],'name')." on ".date("l, d F Y, g:i a",strtotime($data['date']))."'>".$data['comment']."</p><br />";

			}

			else

			{

				return "";	

			}

		}

				else

		{

			return "";	

		}

	}

}





if ( ! function_exists('get_staff_info'))

{

	function get_staff_info($id,$field = 'username')

	{

		$CI =& get_instance();		

		

		$query = $CI->db->query("select $field from staff where Id='".$id."' LIMIT 1");

		$data = $query->row_array();

		

		if(!empty($data))

		{						

		

			if($data[$field])

			{

				return $data[$field];

			}

			else

			{

				return "Administrator";	

			}

		}

				else

		{

			return "Administrator";	

		}

	}

}









if ( ! function_exists('get_field_color'))

{

	function get_field_color($mid,$dept_id)

	{

		$CI =& get_instance();		



		$query = $CI->db->query("select field_color from dept_color where manuscript_id='".$mid."' AND dept_id='".$dept_id."' ORDER BY Id DESC LIMIT 1");

		$data = $query->row_array();	

		

		if(!empty($data))

		{			

		

			if($data['field_color'])

			{

				return ' style="background-color:#'.$data['field_color'].';"';

			}

			else

			{

				return "";	

			}

		}

		else

		{

					return "";	

		}

	}

}





if ( ! function_exists('urlsafe'))

{

	function urlsafe($str)

	{

		$str = trim($str);

		$str = str_replace("andabbreviation","&",$str);

		return urldecode($str);

	}

}



if ( ! function_exists('get_id_from_email_autocomplete'))

{

	function get_id_from_email_autocomplete($str)

		{



			

				$str = explode("(Email:",$str);

				$str = str_replace(")","",$str[1]);

								

				return get_corresponing_value("users","Id",$str,"username");

	

		}		

}



if ( ! function_exists('get_id_from_email_autocomplete_reverse'))

{

	function get_id_from_email_autocomplete_reverse($str)

		{

			



			if(!$str)

			{

				return "";

			}

			else

			{

				return get_corresponing_value("users","name",$str,"Id") . " (Email:".get_corresponing_value("users","username",$str,"Id").")";

			}

	

		}		

}





if ( ! function_exists('get_mid_from_name_autocomplete'))

{

	function get_mid_from_name_autocomplete($str)

		{

			

				$str = explode("(Id:",$str);

				$str = str_replace(")","",$str[1]);

								

				return $str;

	

		}		

}





if ( ! function_exists('get_mid_from_name_autocomplete_reverse'))

{

	function get_mid_from_name_autocomplete_reverse($str)

		{



			if(!$str)

			{

				return "";

			}

			else

			{

				return get_corresponing_value("manuscript","title",$str,"Id") . " (Id:".$str.")";

			}

	

		}		

}
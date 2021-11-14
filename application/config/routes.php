<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = 'home/page_404';

// $route['manish'] = 'home';

$route[$this->config->item('backend').'/login'] = 'backend_auth/index';
$route[$this->config->item('backend').'/login'] = 'backend_auth/login';
$route[$this->config->item('backend').'/forgotpassword'] = 'backend_auth/forgotpassword';
$route[$this->config->item('backend').'/logout'] = 'backend_auth/logout';
$route[$this->config->item('backend').'/login'] = 'backend_auth';

$route[$this->config->item('backend')] = 'backend_home';
$route[$this->config->item('backend').'/(:any)'] = 'backend_$1';

#$route[$this->config->item('backend').'/(:any)/(:any)'] = 'backend_$1/$2';
#$route[$this->config->item('backend').'/(:any)/(:any)/(:any)'] = 'backend_$1/$2/$3';

$route['page/(:any)'] = "page/index/$0"; 
//pages controller to remove index function from url

$route['contact-us'] = 'home/contact';

$route['validses/(:any)'] = 'home/validses';

$route['institutes'] = 'home/institutes';


$route['articlecancel'] = 'home/articlecancel';
$route['articlesuccess/(:num)/(:any)'] = 'home/articlesuccess';



$route['paynow/(:num)/(:any)'] = 'home/paynow';

$route['search'] = 'home/search';

$route['advancedsearch'] = 'home/advancedsearch';
$route['advancedsearch/(:any)'] = 'home/advancedsearch/$0';


$route['journals'] = 'journal/index';
$route['editorial-policy/(:num)'] = 'journal/editorial_policy/$1';
$route['editorial-board-members/(:num)'] = 'journal/board_member/$1';

$route['journals/upcoming'] = 'journal/upcoming';
$route['journals/a-z'] = 'journal/az';

$route['journal/(:num)'] = 'journal/home';

$route['manuscript-submission/(:num)'] = 'journal/script_submission/$1';

$route['subjects'] = 'journal/subjects';


$route['upcoming_journals'] = 'journal/upcoming_journals';
$route['upcoming_journals/:num'] = 'journal/upcoming_journals/$1';

$route['journal/(:num)/(:any)'] = 'journal/journal_particular_field/$0/$1';

$route['issue/(:num)'] = "issue/issues/$1"; 
//$route['issue/(:any)'] = "issue/index/$0"; 



//pages controller to remove index function from url
//$route['archives/(:num)/(:num)'] = 'articles/archives/$1/$2';

$route['archives/(:num)'] = 'articles/archives/$1';

$route['archives/(:any)'] = "issue/archives/$0";


//$route['announcements/(:num)'] = 'announcements/index/$0';
$route['announcement/(:any)'] = 'announcements/announcement/$0';
$route['^(index|announcements)(/:any)?$'] = "announcements/$0";  

$route['sdi-awards'] = 'awards/index';
$route['^(sdi-awards)(/:any)?$'] = "sdi-awards/$0";  
$route['sdi-award/(:any)'] = 'awards/detail/$0';

$route['articles/(:num)'] = 'articles/index/$1';
//$route['abstract/(:any)/(:any)/(:any)'] = 'articles/article/$1/$2/$3';

$route['abstract/(:num)'] = 'articles/article/$1';


$route['abstract/(:any)'] = 'articles/detail/$0';
//$route['^(index|articles)(/:any)?$'] = "articles/$0"; 


$route['review-history/(:any)'] = 'articles/reviewhistory/$0';
$route['post-comments/(:any)'] = 'articles/postcomments/$0';

$route['articles/(:any)'] = 'articles/index/$0';

$route['download/(:any)'] = 'articles/download/$0';


//$route['articles/(:num)/(:num)'] = 'articles/index/$0/$1';
//$route['articles/all'] = 'articles/index';

$route['articles-press/(:num)'] = 'articles/articles_press/$1';

//$route['journal/home/(:num)'] = 'journal-home.php?id=$0';


$route['journal-home/(:num)'] = 'journal/journal_home/$1';
$route['about-journal/(:any)'] = 'journal/about_journal/$1';

//$route['journal'] = 'journal/journal_home';


$route['authors-instruction/(:num)'] = 'journal/authors_instruction/$1';

$route['journal-articles/(:num)'] = 'articles/journal_article/$0';
$route['journal-articles/(:num)/(:num)'] = 'articles/journal_article/$0/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
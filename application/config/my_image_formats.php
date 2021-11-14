 <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Image Formats
|--------------------------------------------------------------------------
|
| Used by the custom html helper img_format() function where the 'format' 
| parameter needs to correspond with a key in the following array of 
| image formats.
|
| Key and value pairs correspond with class settings as outlined at
| http://www.verot.net/php_class_upload.htm in Colin Verots class
| upload script.
|
| Example format:
| $config['image_formats']['small_gif'] = array('image_resize'=>TRUE, 'image_convert'=>'gif', 'image_x'=>100, 'image_ratio_y'=>TRUE);
|
| Usage:
| echo img_format('upload/default.jpg', 'small_gif');
|
*/

$config['image_formats']['small_gif'] = array('image_resize'=>true, 'image_convert'=>'gif', 'image_x'=>100, 'image_ratio_y'=>true);


/* End of file my_image_formats.php */
/* Location: ./system/application/config/my_image_formats.php */  
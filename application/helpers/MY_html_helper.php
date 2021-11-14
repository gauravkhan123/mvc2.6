<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 /**
 * Image Format
 *
 * Generates an image file in the specified format, or takes it from cache
 * and outputs an <img /> element using Colin Verots upload class. Set different
 * formats in /system/application/config/my_image_formats.php
 *
 */    
if(!function_exists('img_format')) {
    function img_format($src='', $format='', $index_page=FALSE) {
        // Load a codeigniter instance
        $CI =& get_instance();
        // Get the image format configurations
        $CI->config->load('my_image_formats');
        $formats = $CI->config->item('image_formats');        
        // The cached name of the file is just a md5 hash of the src and the format
        $hash = md5($format.$src);
        // Get the file extension (if we are converting get the new extension eg. jpg->gif)
        if(isset($formats[$format]['image_convert'])) $ext = '.'.$formats[$format]['image_convert'];
        else $ext = '.'.end(explode('.', $src));
        // Get the general path to the system
        $path = str_replace(SELF,'',FCPATH);    
        // Check if the image has already been generated in the cache
        if(!file_exists($path.'cache/'.$hash.$ext)) {
            // Make sure format is valid
            if(isset($formats[$format])) {
                // Increase memory allowance
                ini_set('memory_limit','36M');  
                // Load the image manipulation library                
                $CI->load->library('imaging');
                $CI->imaging->upload($path.$src);
                if($CI->imaging->uploaded) {
                    // Some default settings
                    $CI->imaging->file_new_name_body = $hash;
                    $CI->imaging->file_auto_rename = FALSE;
                    $CI->imaging->file_overwrite = TRUE;
                    // Settings for the format as defined in the config
                    foreach($formats[$format] as $key => $value) {
                        $CI->imaging->$key = $value;
                    }
                    // Process
                    $CI->imaging->Process($path.'cache');
                    if($CI->imaging->processed) $src = 'cache/'.$hash.$ext;
                }
            }         
        } else $src = 'cache/'.$hash.$ext;
        // Pass to the normal img function
        return img($src, $index_page);
    }
}  
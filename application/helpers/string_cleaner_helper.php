<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('stringCleanerHelper'))
{
	function stringCleanerHelper($data='')
    {
    	return preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', mysql_real_escape_string(strip_quotes(strip_slashes(trim($data)))));
    }
    
    function stringPergeHelper($data='')
    {
    	$r = mysql_real_escape_string(strip_quotes(strip_slashes(trim($data))));
    	$r =  preg_replace('/\&+/', 'and', $r);
    	$r =  preg_replace('/[^A-Za-z0-9]/', ' ', $r);
    	$r =  preg_replace('/\s+/', ' ', $r);
    	$r =  trim($r);
    	return $r;
    }
    
    
 }
?>
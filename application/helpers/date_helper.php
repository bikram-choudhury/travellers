<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('modified_six2six_date_convertor'))
{
    function modified_six2six_date_convertor()
    {
    	
		$CI =& get_instance();
		$time_zone=$CI->config->item('time_zone');
		date_default_timezone_set($time_zone);
		
        $date = date ( 'Y-m-d' );
		$time = date ( 'h:i:s' );
		$hour=date('H');
		
		$modified_date=$date;
		if($hour >=0 && $hour<6)
		{
			$modified_date=date('Y-m-d',strtotime($date.' -1 days'));
		}
		return $modified_date;
    }   
}
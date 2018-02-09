<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

if(!function_exists("LogicalDateForReports")){
	
	function LogicalDateForReports($from_date='',$to_date=''){
		
		$CI =& get_instance();
		$time_zone=$CI->config->item('time_zone');
		date_default_timezone_set($time_zone);
		
		if($from_date!='' && $to_date!=''){
			$currentHour=date("H");
			if($currentHour < 6){
				$start_date = date("Y-m-d",strtotime($from_date."-1 day "));
			}
			else{
				$start_date = $from_date;
			}
			$end_date = $to_date;
			
			$data = array('from_date'=>$start_date,'to_date'=>$end_date);
			return $data;
		}
	}
	
	
/* End of file LogicalDateForReports.php */
}

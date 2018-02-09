<?php
class HookClass extends CI_Controller
{
	function checkUserSession()
	{
		if($this->session->userdata('user_id')=='')
		{
			$skipControllersArray=array('login','process_bills','process_stocks','inventory_sync','sync','upload_bills','upload_pos_data','manager_app','communication');
			if(!in_array($this->router->fetch_class(),$skipControllersArray))
			redirect('login');
		}
	}
}
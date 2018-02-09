<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Authentication {
	
	public function random_str($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	public function portal_details(){
		$CI =& get_instance();
        /*$user_id = $CI->session->userdata('user_id');
        $user_type = $CI->session->userdata('user_type');
        
        $portal_result=new stdClass();
        if($user_id!='' && $user_type=='007'){*/
			$query="SELECT * FROM portal_settings ";
			$portal_result=$CI->main_model->run_manual_query_with_return_row($query);
		/*}*/
		
		return $portal_result;
	}
	
	public function status(){
		$CI =& get_instance();
		
        if($CI->session->userdata('user_id')==''){
			$CI->session->set_flashdata('status', 'Please Login');
            redirect('home');
		}
    }
	
    public function menu_list($type=''){
        $CI =& get_instance();
        $user_id = $CI->session->userdata('user_id');
        if($user_id!=""){
        	$level =0;
	        $user = $CI->main_model->run_manual_query_with_return_row('select user_type from users where id="'.$user_id.'"');
	        $result ='';
	        $result_data = array();
	        $count = 0;
	        if(isset($user->user_type) && $user->user_type=='007'){
				$result_data['admin'] = $user->user_type;
	        }
	        
	        $table_name='';
			if($type=='branch'){
				$table_name='permission';
			}
			elseif($type=='hub'){
				$table_name='hubpermission';
				$result_data['admin']=$user->user_type;
			}
	        
	        if(isset($user->user_type) && $user->user_type!='007' && $table_name!=''){
	        	$query='select permission_class classs, permission_menthod method from '.$table_name.' where permission_assignedto="'.$user_id.'"';
				$result = $CI->main_model->run_manual_query_with_return($query);
				
	            if(count($result) ){
	            	foreach($result as $r){
						$result_data[$r->classs][$r->method]='1';
					}	
				}
	        }
	     	return $result_data;
        }
        else{
			redirect ( "login" );
		}
    }
    
    public function set_default_branch($select_branch='0'){
    	$CI =& get_instance();
    	$user_id = $CI->session->userdata('user_id');
		
		if($user_id!=""){
			
			if($select_branch==''){
				$CI->session->set_userdata('outlet_id','');
				$CI->session->set_userdata('outlet_name','');
			}
			else{
				$query="SELECT name from users where id ='".$select_branch."' ";
		    	$result = $CI->main_model->run_manual_query_with_return_row($query);
		    	
				$CI->session->set_userdata('outlet_id',$select_branch);
				$CI->session->set_userdata('outlet_name',$result->name);
			}
		}
		else{
			redirect ( "login" );
		}
	}
	
	public function get_managerassigned_branches($manager_id=''){
		$CI =& get_instance();
		$user_id = $CI->session->userdata('user_id');
		
		if($user_id!="" && $manager_id!=''){
			$query="SELECT branch_list from users where user_type IN ('manager','hub_manager') and id='".$manager_id."'";
			$result = $CI->main_model->run_manual_query_with_return_row($query);
			
			$query="SELECT id,name from users where id in (".$result->branch_list." ) ";
			$branch_result = $CI->main_model->run_manual_query_with_return($query);
			
			return $branch_result;
		}
		else{
			redirect ( "login" );
		}
		
	}
	
}

/* End of file Authentication.php */
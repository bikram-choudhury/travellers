<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class custom_gcm extends CI_Controller{
	function __construct(){
		parent::__construct();
		$time_zone=$this->config->item('time_zone');
		date_default_timezone_set($time_zone);
		//date_default_timezone_set('Asia/Kolkata');
		$this->load->config('config_external');
	}
   public function send($gcm='', $message=''){	
 
		if(is_array($gcm) && $gcm!='' && $message!=''){
				$messageData = array('gcmmessage'=>$message);
				$this->load->library('gcm');
                $this->gcm->setMessage('BITPOS ' . date('d-m-Y H:i:s'));
				foreach($gcm as $g){
					$this->gcm->addRecepient($g) ;
				}
				$this->gcm->setData($messageData);;
				$this->gcm->setTtl(500);;
				$this->gcm->setTtl(false);;
				$this->gcm->setGroup('BITPOS');;
				$this->gcm->send();
				$s = $this->gcm->status; 
				return json_encode($s);
				$this->gcm->clearRecepients();
							
		}         
    }
}

/* End of file CustomGCM.php */
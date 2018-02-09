<?php
class Admin extends CI_Controller
{
	public function __construct()
    {
         parent::__construct();          
         date_default_timezone_set('Asia/Kolkata');
    }
	public function index()
	{	
		$this->load->view('template/header');
		$this->load->view('template/admin_sidebar');
		$this->load->view('admin/admin_home_page');
		$this->load->view('template/footer');
	}
	function settings()
	{
		
		$this->load->view('template/header');
		$this->load->view('template/admin_sidebar');
		$this->load->view('admin/settings');
		$this->load->view('template/footer');
	}
	
	function send_notificaton()
	{
	    $gcm 	 = $this->input->post('managers');
		$message = $this->input->post('message'); 
		if(is_array($gcm) && $gcm!='' && $message!='' ){
			
			$this->load->library('custom_gcm');
			$r = $this->custom_gcm->send($gcm,$message);
			//$this->session->set_flashdata('message',$r);
			redirect('admin/admin/send_notificaton/sent');
		}  
		
		$query='SELECT gcm,name FROM users WHERE user_type="manager" and gcm!="" ';
		$data['managers']=$this->main_model->run_manual_query_return_result($query);
		
		$this->load->view('template/header');
		$this->load->view('template/admin_sidebar');
		$this->load->view('admin/send_notificaton',$data);
		$this->load->view('template/footer');
	}
	
}
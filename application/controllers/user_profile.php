<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_profile extends CI_Controller {
	public function __construct(){
         parent::__construct();          
         date_default_timezone_set('Asia/Kolkata');
         
         $this->authentication->status();
    }
	public function index(){
		
		$this->load->view('template/header');
		$this->load->view('user/user_view');
		$this->load->view('template/footer');
	}
	public function settings(){
		
		$user_id=$this->session->userdata('user_id');
		
		$qurey="SELECT * FROM users where id='".$user_id."' ";
		$data['user_result']=$this->main_model->run_manual_query_with_return_row($qurey);
		
		$this->load->view('template/header');
		$this->load->view('user/settings_view',$data);
		$this->load->view('template/footer');
	}
	
	public function update_profille(){
		if($this->input->post()){
			if($this->session->userdata('user_id')){
				$user_id=$this->session->userdata('user_id');
			
				$full_name=$this->input->post('full_name');
				$email=$this->input->post('email');
				$mobile_no=$this->input->post('mobile_no');
				
				$data=array(
							'name'=>$full_name,
							'email'=>$email,
							'username'=>$email,
							'mobile_no'=>$mobile_no
						);
				$where=array('id'=>$user_id);
				$id=$this->main_model->update_table('users',$data,$where);
				if($id>0){
					$this->session->set_flashdata('status','Personal Information Stored Successfully !');
					$this->session->set_flashdata('error','0');
				}
				else{
					$this->session->set_flashdata('status','User Not Found !');
					$this->session->set_flashdata('error','1');
				}
			}
			else{
				$this->session->set_flashdata('status','User is Not Logged In ! <br> Please Login to change the Information .');
				$this->session->set_flashdata('error','1');
			}
		}
		redirect('user_profile/settings');
	}
	
	public function update_password(){
		if($this->input->post()){
			if($this->session->userdata('user_id')){
				$user_id=$this->session->userdata('user_id');
			
				$curnt_password=$this->input->post('curnt_password');
				$new_password=$this->input->post('new_password');
				$conf_password=$this->input->post('conf_password');
				
				if($new_password===$conf_password){
					$qurey="SELECT * FROM users where id='".$user_id."' AND password='".$curnt_password."' ";
					$isExist=$this->main_model->run_manual_query_with_return_row($qurey);
					
					if(count($isExist)>0){
						$data=array('password'=>$new_password);
						$where=array('id'=>$user_id);
						$this->main_model->update_table('users',$data,$where);
						
						$this->session->set_flashdata('status','Password successfully Updated !');
						$this->session->set_flashdata('error','0');
					}
					else{
						$this->session->set_flashdata('status','Current Password is not matching !');
						$this->session->set_flashdata('error','1');
					}
				}
				else{
					$this->session->set_flashdata('status','Confirm Password Should Match with New Password');
					$this->session->set_flashdata('error','1');
				}
			}
			else{
				$this->session->set_flashdata('status','User is Not Logged In ! <br> Please Login to change the password .');
				$this->session->set_flashdata('error','1');
			}
		}
		redirect('user_profile/settings');
	}
	
	public function update_portal_settings(){
		if($this->input->post()){
			print_r($this->input->post());
			print_r($_FILES);
			$portal_name=$this->input->post('portal_name');
			$target_file="";
			if(isset($_FILES['logo_image']['name'])){
				
				$target_dir = "assets/img/";
				$target_file = $target_dir . basename($portal_name);
				
				//if(copy($_FILES["logo_image"]["tmp_name"],$target_file)){
				if(move_uploaded_file($_FILES["logo_image"]["tmp_name"], $target_file)){
					echo "Sucess";
					chmod($target_file,0777);
				}
				else{
					echo "Error";
				}
			}
			$data=array(
						'portal_name'=>$portal_name,
						'portal_logo'=>$target_file.'.png'
					);
			$where=array('id'=>1);
			$this->main_model->update_table('portal_settings',$data,$where);
		}
		//redirect('user_profile/settings');
	}
	
}
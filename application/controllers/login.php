<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index(){
		
		$this->load->view('template/login_header');
		$this->load->view('login/login');		
		$this->load->view('template/login_footer');
	}
	
	public function signin(){
		if($this->input->post()){
			$username=$this->input->post('email');
			$password=$this->input->post('password');
			
			$getUserData=$this->login_model->login($username,$password);
			if(count($getUserData)){
				$session_data=array(
									'name'=>$getUserData->name,
									'user_id'=>$getUserData->id,
									'username'=>$getUserData->username,
									'created_date'=>$getUserData->created_date,
									'user_type'=>$getUserData->user_type,
									'user_image'=>$getUserData->images_path
								);
				$this->session->set_userdata($session_data);
				$this->session->set_flashdata('status','Registration successful !');
				$this->session->set_flashdata('error','0');
				
				redirect('home');
			}
			else{
				$this->session->set_flashdata('status','Registration Failed !');
				$this->session->set_flashdata('error','1');
				redirect('login');
			}
		}
	}
	
	public function signup(){
		if($this->input->post()){
			
			$full_name=$this->input->post('full_name');
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			
			$date=date("Y-m-d");
			$time=date("H:i:s");
			
			if(isset($_FILES['image']['name'])){

				if( $_FILES['image']['type']=='image/jpeg' || 
						$_FILES['image']['type']=='image/gif' || 
						$_FILES['image']['type']=='image/png' || 
						$_FILES['image']['type']=='image/jpg' 
				 ){
					
					$nameArray=explode(" ",$full_name);
					$image_name=strtolower($nameArray[0]);
					
					$target_dir = "assets/img/users/";
					$target_file = $target_dir . basename($image_name);

					if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
						
						if ($_FILES['image']['type']=='image/gif'){
							$source_image = imagecreatefromgif($target_file);
						}
						elseif ($_FILES['image']['type']=='image/jpeg' || $_FILES['image']['type']=='image/jpg'){
							$source_image = imagecreatefromjpeg($target_file);
						}
						elseif ($_FILES['image']['type']=='image/png'){
							$source_image = imagecreatefrompng($target_file);
						}
						$width          = imagesx($source_image);
						$height         = imagesy($source_image);
						$desired_width  = 350;
						$desired_height = 350;

						$virtual_image  = imagecreatetruecolor($desired_width, $desired_height);
						imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

						imagejpeg($virtual_image,$target_file.'.jpg');
						$images_path=$target_file.'.jpg';
						$data=array(
									'name'=>$full_name,
									'username'=>$email,
									'password'=>$password,
									'user_type'=>'user',
									'email'=>$email,
									'created_date'=>$date,
									'created_time'=>$time,
									'images_path'=>$images_path
								);
						
						$insert_id=$this->main_model->insert_table('users',$data);
						
						if($insert_id>0){
							
							$session_data=array(
												'name'=>$full_name,
												'user_id'=>$insert_id,
												'created_date'=>$date,
												'user_type'=>'user',
												'user_image'=>$images_path
											);
							$this->session->set_userdata($session_data);
							
							$this->session->set_flashdata('status','Registration successful !');
							$this->session->set_flashdata('error','0');
							
							redirect('home');
						}
						else{
							$this->session->set_flashdata('status','Registration Failed !');
							$this->session->set_flashdata('error','1');
							redirect('login');
						}
					}

				}
			}
		}
	}
	
}
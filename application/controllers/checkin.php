<?php
class Checkin extends CI_Controller{
	public function __construct(){
         parent::__construct();          
         date_default_timezone_set('Asia/Kolkata');
         
         $this->authentication->status();
    }
    
	public function index(){
		
		$this->load->view('template/header');
		$this->load->view('user/rooms_view');
		$this->load->view('template/footer');
	}
	
	public function pendings(){
		
		$username=$this->session->userdata('username');
		
		$query="SELECT * FROM room_inquiry WHERE room_partner_email='".$username."' AND is_used=0 AND is_active=1";
		$data['pending_checkin_result']=$this->main_model->run_manual_query_with_return($query);
		
		$this->load->view('template/header');
		$this->load->view('checkin/bookingid_view',$data);
		$this->load->view('template/footer');
	}
	
	public function check_booking_code(){
		if($this->input->post()){
			//print_r($this->input->post());
			
			$bookingid_hidden=$this->input->post('bookingid_hidden');
			$inquiry_info=$this->input->post('inquiry_info');
			$bookingid_display=$this->input->post('bookingid_display');
			$bookingid_input=$this->input->post('bookingid_input');
			$inquiry_id=$this->input->post('inquiry_id');
			
			$booking_id=$bookingid_display.$bookingid_input;
			
			if($bookingid_hidden===$booking_id){
				
				if($inquiry_info!=""){
					$inquiry_array=json_decode($inquiry_info,TRUE);
					$mail_body=$this->load->view('emails/customer_booked_room_email_view',$inquiry_array,TRUE);
					
					$portal_name=$inquiry_array['portal_name'];
					$customer_email=$inquiry_array['customer_email'];
					$$room_name=$inquiry_array['$room_name'];
					
					$subject= $room_name." Room Has been Booked !";
					
					$client_email="bikram.choudhury08@gmail.com";
					
					if($client_email!=''){
						$to=$client_email;
					    $headers  = "MIME-Version: 1.0" . "\r\n";
					    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					    $headers .= 'From: '.$portal_name.'.com <no-reply@52.76.112.38>' . "\r\n"; 
					    $headers .= 'cc: '.$customer_email.''. "\r\n";
					    $headers .= 'Bcc: bikram.choudhury527@gmail.com' . "\r\n";
					    if(mail($to, $subject, $mail_body, $headers)){
							echo "email sent Successfully ! ! ! !";
						}
						else{
							show_error($this->email->print_debugger());
						}
					}
					else{
						
					}
					
				}
				
				$data=array('is_used'=>1);
				$where=array('inq_id'=>$inquiry_id);
				$this->main_model->update_table('room_inquiry',$data,$where);
				
				$this->session->set_flashdata('error','0');
				$this->session->set_flashdata('status','Booking Id Successfully Confirmed !');
				
				redirect('checkin/pendings');
			}
			else{
				$this->session->set_flashdata('error','1');
				$this->session->set_flashdata('status',"Booking Id Can't be Confirmed. Please try again latter !");
				
				redirect('checkin/confirm_booking_code/'.$inquiry_id);
			}
			
		}
	}
	
	public function confirm_booking_code($inq_id=""){
		
		if($inq_id!='' && $inq_id!='0'){
			
			$username=$this->session->userdata('username');
			
			$query="SELECT * FROM room_inquiry WHERE room_partner_email='".$username."' AND inq_id='".$inq_id."' AND is_used=0 AND is_active=1";
			$data['inquiry_result']=$this->main_model->run_manual_query_with_return_row($query);
			
			$this->load->view('template/header');
			$this->load->view('checkin/confirm_booking_view',$data);
			$this->load->view('template/footer');
		}
		else{
			
		}
	}
	
	
}
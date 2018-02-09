<?php
class Ajax extends CI_Controller{
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
	}
	
	public function addRoomToTopFourPlaces(){
		if($this->input->post()){
			$room_id=$this->input->post('room_id');
			
			$data=array('is_in_top_four'=>1);
			$where=array('room_id'=>$room_id);
			$id=$this->main_model->update_table('rooms',$data,$where);
			
			echo $id;
		}
	}
	
	public function removeRoomFromTopFourPlaces(){
		if($this->input->post()){
			$room_id=$this->input->post('room_id');
			
			$data=array('is_in_top_four'=>0);
			$where=array('room_id'=>$room_id);
			$id=$this->main_model->update_table('rooms',$data,$where);
			
			echo $id;
		}
	}
	
	public function updateAmenitiesStatus(){
		if($this->input->post()){
			$type_id=$this->input->post('type_id');
			
			$query="UPDATE table amenities set is_active=IF(is_active=1,0,1 ) WHERE id='".$type_id."' ";
			$id=$this->main_model->run_manual_query_with_return_nof_affected_rows($query);
			
			/*$data=array('is_active'=>0);
			$where=array('id'=>$type_id);
			$id=$this->main_model->update_table('amenities',$data,$where);*/
			
			echo $id;
		}
	}
	
	public function updateSuitabilityStatus(){
		if($this->input->post()){
			$type_id=$this->input->post('type_id');
			
			$query="UPDATE table suitability set is_active=IF(is_active=1,0,1 ) WHERE id='".$type_id."' ";
			$id=$this->main_model->run_manual_query_with_return_nof_affected_rows($query);
			
			/*$data=array('is_active'=>0);
			$where=array('id'=>$type_id);
			$id=$this->main_model->update_table('suitability',$data,$where);*/
			
			echo $id;
		}
	}
	
	public function unset_outlet_session(){
		 
		if($this->input->post()){
			$select_branch_header=$this->input->post('select_branch_header');
			$this->session->set_userdata('outlet_id','');
			$this->session->set_userdata('outlet_name','');
			echo '1';
		}
		else{
			echo '0';
		}	 
	}
	
	public function check_session(){
		 $sess_id = $this->session->userdata('user_id');
		if($this->session->userdata('user_id')){
			echo '1';
		}
		else{
			echo '0';
		}	 
	}
	
}
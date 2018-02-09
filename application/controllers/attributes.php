<?php
class Attributes extends CI_Controller{
	public function __construct(){
         parent::__construct();          
         date_default_timezone_set('Asia/Kolkata');
    }
    
	public function index(){
		
		$query="SELECT * FROM amenities";
		$data['amenities_result']=$this->main_model->run_manual_query_with_return($query);
		
		$query="SELECT * FROM suitability";
		$data['suitability_result']=$this->main_model->run_manual_query_with_return($query);
		
		$this->load->view('template/header');
		$this->load->view('user/attribute_view',$data);
		$this->load->view('template/footer');
	}
	
	public function save_amenities(){
		if($this->input->post()){
			$attr_name=$this->input->post('attr_name');
			$attr_id=$this->input->post('attr_id');
			
			if($attr_id!='' && $attr_id!='0'){
				
				$data=array('type'=>$attr_name);
				$where=array('id'=>$attr_id);
				$id=$this->main_model->update_table('amenities',$data,$where);
			}
			else{
				$data=array('type'=>$attr_name);
				$id=$this->main_model->insert_table('amenities',$data);
			}
			
			if($id>0){
				$this->session->set_flashdata('status_a','Amenities Saved Successfully !');
				$this->session->set_flashdata('error_a','0');
			}
			else{
				$this->session->set_flashdata('status_a','User Not Found !');
				$this->session->set_flashdata('error_a','1');
			}
		}
		else{
			$this->session->set_flashdata('status_a','Data is not Posted !');
			$this->session->set_flashdata('error_a','1');
		}
		
		redirect('attributes');
	}
	
	public function save_suitability(){
		if($this->input->post()){
			$attr_name=$this->input->post('attr_name');
			$attr_id=$this->input->post('attr_id');
			
			if($attr_id!='' && $attr_id!='0'){
				
				$data=array('type'=>$attr_name);
				$where=array('id'=>$attr_id);
				$id=$this->main_model->update_table('suitability',$data,$where);
			}
			else{
				$data=array('type'=>$attr_name);
				$id=$this->main_model->insert_table('suitability',$data);
			}
			
			if($id>0){
				$this->session->set_flashdata('status_s','Suitability Saved Successfully !');
				$this->session->set_flashdata('error_s','0');
			}
			else{
				$this->session->set_flashdata('status_s','User Not Found !');
				$this->session->set_flashdata('error_s','1');
			}
		}
		else{
			$this->session->set_flashdata('status_s','Data is not Posted !');
			$this->session->set_flashdata('error_s','1');
		}
		
		redirect('attributes');
	}
	
	
}
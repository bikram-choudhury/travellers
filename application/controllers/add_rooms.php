<?php
class Add_rooms extends CI_Controller{
	public function __construct(){
         parent::__construct();          
         date_default_timezone_set('Asia/Kolkata');
         
         $this->authentication->status();
    }
    
	public function index(){
		
		$query="SELECT * FROM amenities WHERE is_active=1";
		$data['amenities_result']=$this->main_model->run_manual_query_with_return($query);
		
		$query="SELECT * FROM suitability WHERE is_active=1";
		$data['suitability_result']=$this->main_model->run_manual_query_with_return($query);
		
		$data['room_result']='';
		
		$this->load->view('template/header');
		$this->load->view('user/rooms_view',$data);
		$this->load->view('template/footer');
	}
	function getZipcode($address){
		$addressArray=array();
	    if(!empty($address)){
	        //Formatted address
	        $formattedAddr = str_replace(' ','+',$address);
	        //Send request and receive json data by address
	        $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=true_or_false'); 
	        $output1 = json_decode($geocodeFromAddr);
	        //Get latitude and longitute from json data
	        
	        //$output1->status!='ZERO_RESULTS'
	        if(count($output1->results)>0){
	        	
				$addressArray['latitude']=$latitude  = $output1->results[0]->geometry->location->lat; 
		        $addressArray['longitude']=$longitude = $output1->results[0]->geometry->location->lng;
		        //Send request and receive json data by latitude longitute
		        $geocodeFromLatlon = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&sensor=true_or_false');
		        $output2 = json_decode($geocodeFromLatlon);
		        
		        if(!empty($output2)){
		            $addressComponents = $output2->results[0]->address_components;
		            //echo '<pre>';print_r($addressComponents);echo '</pre>';
		            foreach($addressComponents as $addrComp){
		            //echo '<pre>';print_r($addrComp);echo '</pre>';
		            	
		                if($addrComp->types[0] == 'postal_code'){
		                    //Return the zipcode
		                    $addressArray['postal_code']= $addrComp->long_name;
		                }
		                if($addrComp->types[0] == 'country'){
		                    //Return the Country
		                    $addressArray['country']= $addrComp->long_name;
		                }
		                if($addrComp->types[0] == 'administrative_area_level_1'){
		                    //Return the Country
		                    $addressArray['state']= $addrComp->long_name;
		                }
		                if($addrComp->types[0] == 'administrative_area_level_2'){
		                    //Return the Country
		                    $addressArray['city']= $addrComp->long_name;
		                }
		                if(isset($addrComp->types[2]) && ($addrComp->types[2] == 'sublocality_level_1')){
		                    //Return the Country
		                    $addressArray['area']= $addrComp->long_name;
		                }
		            }
		            //print_r($addressArray);
		            return $addressArray;
		        }
				else{
		            return false;
		        }
			}
			else{
		        return false;   
		    }
	    }
		else{
	        return false;   
	    }
	}
	
	public function save_rooms(){
		if($this->input->post()){
			//echo '<pre>'; print_r($this->input->post()); echo '</pre>';
			//print_r($_FILES);
			
			$room_type="rental";
			
			$room_name=$this->input->post('room_name');
			$room_address=$this->input->post('address');
			$area_name=$this->input->post('area_name');
			$email=$this->input->post('email');
			$owner_name=$this->input->post('owner_name');
			$owner_email=$this->input->post('owner_email');
			$owner_phone_no=$this->input->post('owner_phone_no');
			$phone_no=$this->input->post('phone_no');
			$website=$this->input->post('website');
			$ratings=$this->input->post('ratings');
			$bedrooms=$this->input->post('bedrooms');
			$members=$this->input->post('members');
			$bathrooms=$this->input->post('bathrooms');
			$room_description=$this->input->post('description');
			
			$checked_amenities=$this->input->post('checked_amenities');
			$checked_suitability=$this->input->post('checked_suitability');
			
			$rent_per_night=$this->input->post('rent_per_night');
			$rent_per_one_day=$this->input->post('rent_per_one_day');
			$rent_per_oneplus_day=$this->input->post('rent_per_oneplus_day');
			$rent_per_month=$this->input->post('rent_per_month');
			
			if($owner_email==''){
				$owner_email=$email;
			}
			if($owner_phone_no==''){
				$owner_phone_no=$phone_no;
			}
			
			$amenities_list='';
			if($this->input->post('checked_amenities')){
				$amenities_list=implode(',',$checked_amenities);
			}
			
			$suitability_list='';
			if($this->input->post('checked_suitability')){
				$suitability_list=implode(',',$checked_suitability);
			}
			
			$addressArray = $this->getZipcode($area_name);
			
			$area =(isset($addressArray['area'])?$addressArray['area']:'');
	        $city = (isset($addressArray['city'])?$addressArray['city']:'');
	        $state = (isset($addressArray['state'])?$addressArray['state']:'');
	        $zip = (isset($addressArray['postal_code'])?$addressArray['postal_code']:'');
	        $country = (isset($addressArray['country'])?$addressArray['country']:'');
	        $latitude = (isset($addressArray['latitude'])?$addressArray['latitude']:'0');
	        $longitude = (isset($addressArray['longitude'])?$addressArray['longitude']:'0');
			
			$area_name=explode(",",$area);
			
			$query="SELECT country_id FROM country where lower(country_name)='".strtolower($country)."'";
			$country_result=$this->main_model->run_manual_query_with_return_row($query);
			
			$country_id=0;
			if(isset($country_result->country_id)){
				$country_id=$country_result->country_id;
			}
			else{
				$data=array('country_name'=>$country);
				$insert_id=$this->main_model->insert_table('country',$data);
				
				$country_id=$insert_id;
			}
			
			$query="SELECT state_id FROM states where lower(state_name)='".strtolower($state)."'";
			$state_result=$this->main_model->run_manual_query_with_return_row($query);
			
			$state_id=0;
			if(isset($state_result->state_id)){
				$state_id=$state_result->state_id;
			}
			else{
				$data=array('state_name'=>$state,'country_id'=>$country_id,'is_active'=>1);
				$insert_id=$this->main_model->insert_table('states',$data);
				
				$state_id=$insert_id;
			}
			
			$query="SELECT city_id FROM cities where lower(city_name)='".strtolower($city)."'";
			$city_result=$this->main_model->run_manual_query_with_return_row($query);
			
			$city_id=0;
			if(isset($city_result->city_id)){
				$city_id=$city_result->city_id;
			}
			else{
				$data=array('city_name'=>$city,'country_id'=>$country_id,'state_id'=>$state_id);
				$insert_id=$this->main_model->insert_table('cities',$data);
				
				$city_id=$insert_id;
			}
			
			$query="SELECT area_id FROM area where lower(area_name)='".strtolower($area_name[0])."'";
			$area_result=$this->main_model->run_manual_query_with_return_row($query);
			
			$area_id=0;
			if(isset($area_result->area_id)){
				$area_id=$area_result->area_id;
			}
			else{
				$data=array('area_name'=>$area_name[0],'country_id'=>$country_id,'city_id'=>$city_id);
				$insert_id=$this->main_model->insert_table('area',$data);
				
				$area_id=$insert_id;
			}
			
			//-----Image Part Starts-------
			
			echo '<pre>'; print_r($_FILES); echo '</pre>';
			
			$image_array =array();
            $time = time();
            $post_folder = $time;
            
            @mkdir("roomimages/", 0777);
            
            @mkdir("roomimages/".$post_folder."/", 0777);
            $count = 0;
            foreach ($_FILES['room_image']['name'] as $key => $value) {
                $count++;
                $name = '';
                     if(
                        $_FILES['room_image']['type'][$key]=='image/jpeg' || 
                        $_FILES['room_image']['type'][$key]=='image/gif' || 
                        $_FILES['room_image']['type'][$key]=='image/png' || 
                        $_FILES['room_image']['type'][$key]=='image/jpg' 
                        )
                      {
                        $name =  trim($_FILES['room_image']['name'][$key]);
                        $name =  preg_replace('/\s+/', '-', $name);//$this->includes->permalink($name);
                        $stamp = strtolower($this->authentication->random_str(10));

                        $target = 'roomimages/'.$post_folder.'/'.$stamp.'-'.$count.$name;
                        $target2 = 'roomimages/'.$post_folder.'/th-'.$stamp.'-'.$count.$name;
                       // $target = 'images/advertiser/'.$post_folder.'/'.$stamp.'_'.$count.$name;
                        if ($name!='') {
                        	
                            move_uploaded_file($_FILES['room_image']['tmp_name'][$key], $target);
                            
                            if ($_FILES['room_image']['type'][$key]=='image/gif'){
                                $source_image = imagecreatefromgif($target);
                            }
                            elseif ($_FILES['room_image']['type'][$key]=='image/jpeg' || $_FILES['room_image']['type'][$key]=='image/jpg'){
                                $source_image = imagecreatefromjpeg($target);
                            }
                            elseif ($_FILES['room_image']['type'][$key]=='image/png'){
                                $source_image = imagecreatefrompng($target);
                            }
                            
                            $width          = imagesx($source_image);
                            $height         = imagesy($source_image);
                            $desired_width  = 340;
                            $desired_height = 200;
                            // Content type
                            // Get new dimensions
                            list($width_orig, $height_orig) = getimagesize($target);

                            $ratio_orig = $width_orig/$height_orig;

                            if($desired_width/$desired_height > $ratio_orig) {
                               $desired_width = $desired_height*$ratio_orig;
                            }
                            else{
                               $desired_height = $desired_width/$ratio_orig;
                            }
                            
                            $virtual_image  = imagecreatetruecolor($desired_width, $desired_height);
                            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
                            
                            if ($_FILES['room_image']['type'][$key]=='image/gif'){
                                imagegif($virtual_image,$target2);
                            }
                            elseif ($_FILES['room_image']['type'][$key]=='image/jpeg' || $_FILES['room_image']['type'][$key]=='image/jpg'){
                                imagejpeg($virtual_image,$target2);
                            }
                            elseif ($_FILES['room_image']['type'][$key]=='image/png'){
                                imagepng($virtual_image,$target2);
                            }
                            
                            $image_array[$count]['path'] = $target;
                            $image_array[$count]['image_thumb'] = $target2;
                            $image_array[$count]['name'] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $name);;
                            
                        }
                    }
            }

			
			//-----Image Part Ends-------
			
			$r_data=array(
						'room_name'=>$room_name,
						'room_type'=>$room_type,
						'ratings'=>$ratings,
						'bedroom'=>$bedrooms,
						'members'=>$members,
						'bathrooms'=>$bathrooms,
						'rent_per_night'=>$rent_per_night,
						'rent_per_one_day'=>$rent_per_one_day,
						'rent_per_oneplus_day'=>$rent_per_oneplus_day,
						'rent_per_month'=>$rent_per_month,
						'description'=>$room_description,
						'email_id'=>$email,
						'owner_name'=>$owner_name,
						'owner_email'=>$owner_email,
						'owner_phone_no'=>$owner_phone_no,
						'phone_no'=>$phone_no,
						'website'=>$website,
						
						'latitude'=>$latitude,
						'longitude'=>$longitude,
						
						'area'=>$area,
						'area_id'=>$area_id,
						'city_id'=>$city_id,
						'city'=>$city,
						'state_id'=>$state_id,
						'state'=>$state,
						'country_id'=>$country_id,
						'country'=>$country,
						
						'address'=>$room_address,
						'amenities_list'=>$amenities_list,
						'suitability_list'=>$suitability_list
					);
			$insert_id=$this->main_model->insert_table('rooms',$r_data);
			
			//echo '<pre>'; print_r($image_array); echo '</pre>';
			
			if(is_array($image_array) && count($image_array)>0){

				$image_array2 = array();
				foreach ($image_array as $key => $value) {
					$i_data = array(
									'room_image_id'=>$insert_id,
									'image_path'=>$value['path'],
									'image_thumb'=>$image_array[$key]['image_thumb'],
									'alt_name'=>$image_array[$key]['name']
								);
					array_push($image_array2, $i_data);
				}
				if(count($image_array2)>0){
					$this->main_model->multiple_insert('room_images',$image_array2);
				}
			}
			
			if($insert_id>0){
				$this->session->set_flashdata('status_a','Changes Saved Successfully !');
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
		
		redirect('add_rooms');
	}
	
	public function update_rooms(){
		if($this->input->post()){
			
			$room_type="rental";
			
			$room_id=$this->input->post('room_id');
			$room_name=$this->input->post('room_name');
			$room_address=$this->input->post('address');
			$email=$this->input->post('email');
			$owner_name=$this->input->post('owner_name');
			$owner_email=$this->input->post('owner_email');
			$owner_phone_no=$this->input->post('owner_phone_no');
			$phone_no=$this->input->post('phone_no');
			$website=$this->input->post('website');
			$ratings=$this->input->post('ratings');
			$bedrooms=$this->input->post('bedrooms');
			$members=$this->input->post('members');
			$bathrooms=$this->input->post('bathrooms');
			$room_description=$this->input->post('description');
			
			$checked_amenities=$this->input->post('checked_amenities');
			$checked_suitability=$this->input->post('checked_suitability');
			
			$rent_per_night=$this->input->post('rent_per_night');
			$rent_per_one_day=$this->input->post('rent_per_one_day');
			$rent_per_oneplus_day=$this->input->post('rent_per_oneplus_day');
			$rent_per_month=$this->input->post('rent_per_month');
			
			if($owner_email==''){
				$owner_email=$email;
			}
			if($owner_phone_no==''){
				$owner_phone_no=$phone_no;
			}
			
			$amenities_list='';
			if(count($checked_amenities)>0){
				$amenities_list=implode(',',$checked_amenities);
			}
			
			$suitability_list='';
			if(count($checked_suitability)>0){
				$suitability_list=implode(',',$checked_suitability);
			}
			
			//-----Image Part Starts-------
			
			$image_array =array();
            
			//-----Image Part Ends-------
			
			$r_data=array(
						'room_name'=>$room_name,
						'room_type'=>$room_type,
						'ratings'=>$ratings,
						'bedroom'=>$bedrooms,
						'members'=>$members,
						'bathrooms'=>$bathrooms,
						'rent_per_night'=>$rent_per_night,
						'rent_per_one_day'=>$rent_per_one_day,
						'rent_per_oneplus_day'=>$rent_per_oneplus_day,
						'rent_per_month'=>$rent_per_month,
						'description'=>$room_description,
						'email_id'=>$email,
						'owner_name'=>$owner_name,
						'owner_email'=>$owner_email,
						'owner_phone_no'=>$owner_phone_no,
						'phone_no'=>$phone_no,
						'website'=>$website,
						'address'=>$room_address,
						'amenities_list'=>$amenities_list,
						'suitability_list'=>$suitability_list
					);
			$r_where=array('room_id'=>$room_id);
			if($room_id!='' && $room_id>0){
				$this->main_model->update_table('rooms',$r_data,$r_where);
				
				$this->session->set_flashdata('status_a','Changes Saved Successfully !');
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
		
		redirect('add_rooms/view_rooms');
	}
	
	public function edit_room($room_id=""){
		if($room_id!=""){
			$query="SELECT * FROM rooms WHERE room_id='".$room_id."' ";
			$data['room_result']=$this->main_model->run_manual_query_with_return_row($query);
			
			$query="SELECT * FROM room_images WHERE room_image_id='".$room_id."' ";
			$room_image_result=$this->main_model->run_manual_query_with_return($query);
			
			$roomImageArray=array();
			foreach($room_image_result as $ar){
				$roomImageArray[$ar->image_id]['image_path']=$ar->image_path;
				$roomImageArray[$ar->image_id]['image_thumb']=$ar->image_thumb;
				$roomImageArray[$ar->image_id]['alt_name']=$ar->alt_name;
			}
			
			$data['room_image_result']=$roomImageArray;
			
			$query="SELECT * FROM amenities WHERE is_active=1";
			$data['amenities_result']=$this->main_model->run_manual_query_with_return($query);
			
			$query="SELECT * FROM suitability WHERE is_active=1";
			$data['suitability_result']=$this->main_model->run_manual_query_with_return($query);
			
			$this->load->view('template/header');
			$this->load->view('user/rooms_view',$data);
			$this->load->view('template/footer');
		}
		else{
			redirect('add_rooms/view_rooms');
		}
	}
	
	public function view_rooms(){
		
		$query="SELECT * FROM amenities WHERE is_active=1";
		$amenities_result=$this->main_model->run_manual_query_with_return($query);
		
		$amenitiesArray=array();
		foreach($amenities_result as $ar){
			$amenitiesArray[$ar->id]=$ar->type;
		}
		
		$data['amenities_result']=$amenitiesArray;
		
		$query="SELECT * FROM suitability WHERE is_active=1";
		$suitability_result=$this->main_model->run_manual_query_with_return($query);
		
		$suitabilityArray=array();
		foreach($suitability_result as $ar){
			$suitabilityArray[$ar->id]=$ar->type;
		}
		
		$data['suitability_result']=$suitabilityArray;
		
		$query="SELECT * FROM rooms ";
		$data['room_result']=$this->main_model->run_manual_query_with_return($query);
		
		$query="SELECT * FROM room_images ";
		$room_image_result=$this->main_model->run_manual_query_with_return($query);
		
		$roomImageArray=array();
		foreach($room_image_result as $ar){
			$roomImageArray[$ar->room_image_id][$ar->image_id]['image_path']=$ar->image_path;
			$roomImageArray[$ar->room_image_id][$ar->image_id]['image_thumb']=$ar->image_thumb;
			$roomImageArray[$ar->room_image_id][$ar->image_id]['alt_name']=$ar->alt_name;
		}
		
		$data['room_image_result']=$roomImageArray;
		
		$this->load->view('template/header');
		$this->load->view('user/rooms_list',$data);
		$this->load->view('template/footer');
	}
	
	
}
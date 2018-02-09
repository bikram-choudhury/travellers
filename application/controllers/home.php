<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index(){
		
		$query="SELECT * FROM rooms WHERE is_in_top_four=1 and is_active=1";
		$data['top_four_room_result']=$top_four_room_result=$this->main_model->run_manual_query_with_return($query);
		
		$topArray=array();
		foreach($top_four_room_result as $tfr){
			$topArray[]=$tfr->room_id;
		}
		$topFourList="";
		if(count($topArray)>0){
			$topFourList=implode(",",$topArray);
		}
		
		$imageArray=array();
		if($topFourList!=''){
			$query="SELECT image_id,room_image_id,image_thumb,count(*) image_count FROM room_images WHERE room_image_id IN ($topFourList) group by room_image_id order by rand() ";
			$image_details=$this->main_model->run_manual_query_with_return($query);
			
			foreach($image_details as $id){
				$imageArray[$id->room_image_id]['image_thumb']=$id->image_thumb;
				$imageArray[$id->room_image_id]['image_count']=$id->image_count;
			}
		}
		
		$data['room_image_details']=$imageArray;
		
		
		$this->load->view('template/header');
		$this->load->view('home/home_view',$data);
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
	
	public function search_rooms(){
		if($this->input->post()){
			//echo '<pre>'; print_r($this->input->post());
			
			$area_name=$this->input->post('area_name');
			$start=$this->input->post('start');
			$end=$this->input->post('end');
			$select_members=$this->input->post('select_members');
			$select_guest=$this->input->post('select_guest');
			
			$area_id=0;
			if($this->input->post('area_name')){
				
				$addressArray = $this->getZipcode($area_name);
				
				$area =(isset($addressArray['area'])?$addressArray['area']:'');
		        $city = (isset($addressArray['city'])?$addressArray['city']:'');
		        $state = (isset($addressArray['state'])?$addressArray['state']:'');
		        $zip = (isset($addressArray['postal_code'])?$addressArray['postal_code']:'');
		        $country = (isset($addressArray['country'])?$addressArray['country']:'');
				
				$areaArray=explode(",",$area_name);
				
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
				
				$query="SELECT area_id FROM area where lower(area_name)='".strtolower($area)."'";
				$area_result=$this->main_model->run_manual_query_with_return_row($query);
				
				if(isset($area_result->area_id)){
					$area_id=$area_result->area_id;
				}
				else{
					$data=array('area_name'=>$area,'country_id'=>$country_id,'city_id'=>$city_id);
					$insert_id=$this->main_model->insert_table('area',$data);
					
					$area_id=$insert_id;
				}
			}
			//echo $area_id;
			//echo 'home/rooms_result/'.$area_id;
			redirect('home/rooms_result/'.$area_id);
		}
		else{
			redirect('home');
		}
	}
	
	public function rooms_filter_result(){
		//echo '<pre>'; print_r($this->input->post());die;
		if($this->input->post()){
			$area_id=$this->input->post('area_id');
			$price_range=$this->input->post('price_range');
			$ratings=$this->input->post('ratings');
			$bedrooms=$this->input->post('bedrooms');
			$amenities=$this->input->post('amenities');
			$suitability=$this->input->post('suitability');
			
			$urlArray=array(
							'price_range'=>$price_range,
							'ratings'=>$ratings,
							'bedrooms'=>$bedrooms,
							'amenities'=>$amenities,
							'suitability'=>$suitability,
						);
			
			$encodedURL=urlencode(json_encode($urlArray));
			
			/*echo $decodedURL=urldecode($encodedURL);
			$decodedURLArray=json_decode($decodedURL,TRUE);
			echo "====================<br>";
			print_r($decodedURLArray);
			echo "====================<br>";
			echo 'home/rooms_result/'.$area_id.'/'.$encodedURL;*/
			redirect('home/rooms_result/'.$area_id.'/'.$encodedURL);
		}
		else{
			redirect('home');
		}
	}
	
	public function rooms_result($area_id='0',$encodedURL='',$page='0'){
		
		$data['area_id']=$area_id;
		
		$price_range='';$ratings='';$bedrooms='';$amenities='';$suitability='';
		if($encodedURL!=''){
			$decodedURL=urldecode($encodedURL);
			$decodedURLArray=json_decode($decodedURL,TRUE);
			
			$price_range=(isset($decodedURLArray['price_range'])?$decodedURLArray['price_range']:'');
			$ratings=(isset($decodedURLArray['ratings'])?$decodedURLArray['ratings']:'');
			$bedrooms=(isset($decodedURLArray['bedrooms'])?$decodedURLArray['bedrooms']:'');
			$amenities=(isset($decodedURLArray['amenities'])?$decodedURLArray['amenities']:'');
			$suitability=(isset($decodedURLArray['suitability'])?$decodedURLArray['suitability']:'');
		}
		
		$where_price_range=""; $where_ratings=""; $where_bedrooms=""; $where_amenities=""; $where_suitability="";
		
		if($price_range!=''){
			$priceArray=explode(";",$price_range);
			$where_price_range=" rent_per_month BETWEEN '".$priceArray[0]."' AND '".$priceArray[1]."' ";
		}
		
		if($ratings!=''){
			$ratings_list=implode(",",$ratings);
			$where_ratings="OR FIND_IN_SET(ratings,'$ratings_list') ";
		}
		
		if($bedrooms!=''){
			$bedrooms_list=implode(",",$bedrooms);
			$where_bedrooms="OR FIND_IN_SET(bedroom,'$bedrooms_list') ";
		}
		
		if($amenities!=''){
			$amenities_list=implode(",",$amenities);
			$where_amenities="OR FIND_IN_SET(bedroom,'$amenities_list') ";
		}
		
		if($suitability!=''){
			$suitability_list=implode(",",$suitability);
			$where_suitability="OR FIND_IN_SET(bedroom,'$suitability_list') ";
		}
		
		$consolidate_where="";
		if($where_price_range!='' || $where_ratings!='' || $where_bedrooms!='' || $where_amenities!='' || $where_suitability!='' ){
			$consolidate_where =" AND ( $where_price_range $where_ratings $where_bedrooms $where_amenities $where_suitability )";
		}
		
		$query="SELECT count(*) row_count FROM rooms WHERE area_id='$area_id' $consolidate_where AND is_active=1 ORDER BY ratings DESC";
		$rooms_result=$this->main_model->run_manual_query_with_return_row($query);
		
		$total_rows=(isset($rooms_result->row_count)?$rooms_result->row_count:0);
		
		$this->load->library('pagination');
		$config ['full_tag_open'] = "<ul class='pagination'>";
		$config ['full_tag_close'] = "</ul>";
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config ['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config ['prev_link'] = 'Previous';
		$config ['next_link'] = 'Next Page';
		$config ['next_tag_open'] = "<li>";
		$config ['next_tagl_close'] = "</li>";
		$config ['prev_tag_open'] = "<li>";
		$config ['prev_tagl_close'] = "</li>";
		$config ['first_tag_open'] = "<li>";
		$config ['first_tagl_close'] = "</li>";
		$config ['last_tag_open'] = "<li>";
		$config ['last_tagl_close'] = "</li>";
		$config ["base_url"]=site_url('home/rooms_result/'.$area_id.'/'.$encodedURL);
		$data['total_rows']=$config ["total_rows"] =$total_rows;
		$data['per_page']=$limit = $config ["per_page"] = $this->input->post('selected_show_option')?$total_rows:2;
		$config ["uri_segment"] = 5;
		$config ['use_page_numbers'] = TRUE;
		$this->pagination->initialize ( $config );
		
		if ($this->uri->segment ( 5 )){
			$page = ($this->uri->segment ( 5 ) - 1) * $limit;
			$data['slno_init_no']=$page+1;
		}				
		else{
			$page = 0;
			$data['slno_init_no']=1;
		}	
		$data ['pagelink'] = $this->pagination->create_links();
		
		$data['page']=$page;
		$data['encodedURL']=$encodedURL;
		
		
		$query="SELECT area_id,area_name FROM area where area_id='".$area_id."'";
		$data['area_result']=$this->main_model->run_manual_query_with_return_row($query);
		
		$query="SELECT * FROM amenities WHERE is_active=1";
		$data['amenities_result']=$this->main_model->run_manual_query_with_return($query);
		
		$query="SELECT * FROM suitability WHERE is_active=1";
		$data['suitability_result']=$this->main_model->run_manual_query_with_return($query);
		
		$query="SELECT * FROM rooms WHERE area_id='$area_id' $consolidate_where AND is_active=1 ORDER BY ratings DESC LIMIT $page,$limit";
		$data['rooms_result']=$this->main_model->run_manual_query_with_return($query);
		
		$query="SELECT image_id,room_image_id,image_thumb,count(*) image_count FROM room_images group by room_image_id order by rand() ";
		$image_details=$this->main_model->run_manual_query_with_return($query);
		
		$imageArray=array();
		foreach($image_details as $id){
			$imageArray[$id->room_image_id]['image_thumb']=$id->image_thumb;
			$imageArray[$id->room_image_id]['image_count']=$id->image_count;
		}
		$data['room_image_details']=$imageArray;
		
		$this->load->view('template/header');
		$this->load->view('home/result_view',$data);
		$this->load->view('template/footer');
	}
	
	public function send_room_inquiry(){
		$room_id="";
		if($this->input->post()){
			//echo '<pre>'; print_r($this->input->post()); echo '</pre>';die;
			$room_id=$this->input->post('room_id');
			$room_name=$this->input->post('room_name');
			$room_address=$this->input->post('room_address');
			$phone_no=$this->input->post('phone_no');
			$customer_email=$this->input->post('customer_email');
			$email=$this->input->post('email');
			$client_email=$this->input->post('client_email');
			$comment=$this->input->post('comment');
			$person_name=$this->input->post('person_name');
			$adult_options=$this->input->post('adult_options');
			$child_options=$this->input->post('child_options');
			
			$owner_name=$this->input->post('owner_name');
			$owner_email=$this->input->post('owner_email');
			$owner_phone_no=$this->input->post('owner_phone_no');
			
			$portal_result=$this->authentication->portal_details();
			
			$portal_name=(isset($portal_result->portal_name)?$portal_result->portal_name:"Bikram");
			$portal_logo=(isset($portal_result->portal_logo)?$portal_result->portal_logo:"assets/img/logon.png");
			
			$booking_prefix=substr($portal_name,0,3);
			
			$query="SELECT max(inq_id) last_inqid FROM room_inquiry";
			$last_inq=$this->main_model->run_manual_query_with_return_row($query);
			
			$last_inqid=0;
			if(isset($last_inq->last_inqid)){
				$last_inqid=$last_inq->last_inqid;
			}
			
			$booking_code=strtoupper($booking_prefix).date("YmdHis").sprintf("%04s",$last_inqid);
			
			$data=array(
						'booking_code'=>$booking_code,
						'room_id'=>$room_id,
						'room_name'=>$room_name,
						'room_address'=>$room_address,
						'phone_no'=>$phone_no,
						'email'=>$email,
						'person_name'=>$person_name,
						'adult_options'=>$adult_options,
						'child_options'=>$child_options,
						'comment'=>$comment,
						'owner_name'=>$owner_name,
						'owner_email'=>$owner_email,
						'customer_email'=>$customer_email,
						'owner_phone_no'=>$owner_phone_no,
						'portal_name'=>$portal_name,
						'portal_logo'=>$portal_logo
					);
			
			$mail_body=$this->load->view('emails/room_inquiry_email_view',$data,TRUE);
			
			//echo $mail_body;die;
			
			$subject= $room_name." Room Has been came for inquiry !";
			
			if($client_email!=''){
				$to=$client_email;
			    $headers  = "MIME-Version: 1.0" . "\r\n";
			    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			    $headers .= 'From: '.$portal_name.'.com <no-reply@52.76.112.38>' . "\r\n"; 
			    $headers .= 'cc: '.$customer_email.''. "\r\n";
			    $headers .= 'Bcc: bikram.choudhury527@gmail.com' . "\r\n";
			    if(mail($to, $subject, $mail_body, $headers)){
					echo "email sent Successfully ! ! ! !";
					
					$insert_data=array(
									'room_id'=>$room_id,
									'room_name'=>$room_name,
									'booking_code'=>$booking_code,
									'sender_name'=>$person_name,
									'sender_contact_no'=>$phone_no,
									'room_partner_name'=>$owner_name,
									'room_partner_contact_no'=>$owner_phone_no,
									'room_partner_email'=>$owner_email,
									'inquiry_info'=>json_encode($data)
									);
					$this->main_model->insert_table('room_inquiry',$insert_data);
					
					
				}
				else{
					show_error($this->email->print_debugger());
				}
			}
			else{
				
			}
			
		}
		else{
			
		}
		
		redirect('home/rooms_detail/'.$room_id);
		
	}
	
	public function rooms_detail($room_id=""){
		if($room_id!="" && $room_id!="0"){
			
			$query="SELECT * FROM amenities WHERE is_active=1";
			$data['amenities_result']=$this->main_model->run_manual_query_with_return($query);
			
			$query="SELECT * FROM suitability WHERE is_active=1";
			$data['suitability_result']=$this->main_model->run_manual_query_with_return($query);
			
			$query="SELECT * FROM rooms WHERE is_active=1 AND room_id='$room_id' ORDER BY ratings DESC";
			$data['rooms_result']=$this->main_model->run_manual_query_with_return_row($query);
			
			$query="SELECT * FROM room_images WHERE room_image_id='$room_id' order by rand() ";
			$room_image_result=$this->main_model->run_manual_query_with_return($query);
			
			$roomImageArray=array();
			foreach($room_image_result as $ar){
				$roomImageArray[$ar->room_image_id][$ar->image_id]['image_path']=$ar->image_path;
				$roomImageArray[$ar->room_image_id][$ar->image_id]['image_thumb']=$ar->image_thumb;
				$roomImageArray[$ar->room_image_id][$ar->image_id]['alt_name']=$ar->alt_name;
			}
			
			$data['room_image_result']=$roomImageArray;
			
			$this->load->view('template/header');
			$this->load->view('home/result_details_view',$data);
			$this->load->view('template/footer');
		}
		else{
			redirect('home');
		}
	}
	
	public function test_details(){
		
		/*headers = {'X-APP-TOKEN' : "your_api_token"};
		payload= {'pickup_lat': 12.9490936, 'pickup_lng': 77.67773056, 'drop_lat': 12.9190934, 'drop_lng': 77.1777356, 'category': 'micro'};
		response = requests.get('https://devapi.olacabs.com/v1/products', params=payload, headers=headers);
		print(response.json());*/
		
		$url = 'https://devapi.olacabs.com/v1/products?pickup_lat=12.9491416&pickup_lng=77.64298&category=mini';
		
		$ch = curl_init($url);
		
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
		
		//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, FALSE);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded","X-APP-TOKEN: 559e5487c9614cbb8f4bb330b2e21677") );

		$response = curl_exec($ch);
		print($response);
		curl_close($ch);
		
		$this->load->view('template/header');
		$this->load->view('home/test_view');
		$this->load->view('template/footer');
	}
	
}
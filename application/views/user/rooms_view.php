	<link href="<?php echo base_url() ?>assets/dist/imageuploadify.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/dist/imageuploadify.min.js"></script>
		<div class="container">
            <h1 class="page-title"><?php echo ucwords(str_replace('_',' ',$this->router->fetch_class())); ?></h1>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php $this->load->view('template/profile_sidebar'); ?>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="<?php  echo (isset($room_result->room_id)?site_url('add_rooms/update_rooms'):site_url('add_rooms/save_rooms')) ; ?>" method="post" enctype="multipart/form-data" id="add_room_form" onsubmit="return validate_form()" >
                                
                                <?php if($this->session->flashdata('error_a')!='' &&  $this->session->flashdata('error_a')==0){ ?>
								    <div class="alert alert-success fade in block-inner">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo $this->session->flashdata('status_a'); ?>
									</div>
							<?php	 }
									elseif($this->session->flashdata('error_a')!='' &&  $this->session->flashdata('error_a')==1){ ?>
								   	<div class="alert alert-danger fade in block-inner">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo $this->session->flashdata('status_a'); ?>
									</div>
							<?php	} ?>
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Name</label>
                                    <input class="noSpecialChar form-control room_name" name="room_name" value="<?php echo (isset($room_result->room_name)?$room_result->room_name:''); ?>" type="text" />
                                    <input type="hidden" name="room_id" value="<?php echo (isset($room_result->room_id)?$room_result->room_id:''); ?>" />
                                </div>
                                
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                	<label>Area Name</label>
                                    <div id="locationField">
							    		<input id="autocomplete" name="area_name" class="form-control area_name" placeholder="Enter your Area" onFocus="geolocate()" type="text"></input>
							    	</div>
                                </div>
                                
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Address</label>
                                    <textarea class="form-control address" rows="5" cols="5" name="address" style="resize: none;"><?php echo (isset($room_result->address)?$room_result->address:''); ?></textarea>
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Partener Name</label>
                                    <input class=" form-control owner_name" name="owner_name" value="<?php echo (isset($room_result->owner_name)?$room_result->owner_name:''); ?>" type="text" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Partener Email</label>
                                    <input class=" form-control owner_email" name="owner_email" value="<?php echo (isset($room_result->owner_email)?$room_result->owner_email:''); ?>" type="text" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Partner Phone No</label>
                                    <input class="intNumberOnly form-control owner_phone_no" maxlength="11" name="owner_phone_no" value="<?php echo (isset($room_result->owner_phone_no)?$room_result->owner_phone_no:''); ?>" type="text" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Email</label>
                                    <input class=" form-control email" name="email" value="<?php echo (isset($room_result->email_id)?$room_result->email_id:''); ?>" type="text" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Phone No</label>
                                    <input class="intNumberOnly form-control phone_no" maxlength="11" name="phone_no" value="<?php echo (isset($room_result->phone_no)?$room_result->phone_no:''); ?>" type="text" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Website</label>
                                    <input class="form-control website" name="website" value="<?php echo (isset($room_result->website)?$room_result->website:''); ?>" type="text" />
                                </div>
                                
                                <div class="form-group">
                                    <label>Amenities</label>
                                    <div style="border: 1px solid #ed8323; padding: 10px; height: auto; contain: content;">
                                    <?php
                                    	$amenitiesListArray=(isset($room_result->amenities_list)?explode(",",$room_result->amenities_list):array());
                                    	if(count($amenities_result)>0){
											foreach($amenities_result as $ar){ ?>
												<div class="col-sm-3 col-xs-12 amenities_div " style="margin-top: 5px;" >
													<div class="checkbox"><!--checkbox-stroke-->
						                                <label class="">
						                                    <input class="i-check checked_amenities" <?php echo (in_array($ar->id,$amenitiesListArray)?'checked':''); ?>  type="checkbox" name="checked_amenities[<?php echo $ar->id; ?>]" value="<?php echo $ar->id; ?>" />
						                                    <?php echo ucwords($ar->type); ?>
														</label>
						                            </div>
												</div>
							<?php			}
										} ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Suitability</label>
                                    <div style="border: 1px solid #ed8323; padding: 10px; height: auto; contain: content;">
                                    <?php
                                    	$suitabilityListArray=(isset($room_result->suitability_list)?explode(",",$room_result->suitability_list):array());
                                    	if(count($suitability_result)>0){
											foreach($suitability_result as $ar){ ?>
												<div class="col-sm-3 col-xs-12 suitability_div " style="margin-top: 5px;" >
													<div class="checkbox"><!--checkbox-stroke-->
						                                <label class="">
						                                    <input class="i-check checked_suitability" <?php echo (in_array($ar->id,$suitabilityListArray)?'checked':''); ?> type="checkbox" name="checked_suitability[<?php echo $ar->id; ?>]" value="<?php echo $ar->id; ?>" />
						                                    <?php echo ucwords($ar->type); ?>
														</label>
						                            </div>
												</div>
							<?php			}
										} ?>
                                	</div>
                                </div>
                                <div class="form-group row">
                                	<div class="col-md-3">
                                	<!--form-group form-group-lg form-group-select-plus-->
                                		<label>Ratings</label>
                                		<select class="form-control ratings" name="ratings">
                            			<?php
                            				for($i=1;$i<=5;$i++){ ?>
												<option <?php echo ((isset($room_result->ratings) && ($room_result->ratings==$i))?'selected':''); ?> value="<?php echo $i; ?>"><?php echo $i." Star"; ?></option>
							<?php			} ?>
                                			
                                		</select>
                                	</div>
                                	<div class="col-md-3">
                                		<label>Bedrooms</label>
                                		<select class="form-control bedrooms" name="bedrooms">
                            			<?php
                            				for($i=1;$i<=3;$i++){ ?>
												<option <?php echo ((isset($room_result->bedroom) && ($room_result->bedroom==$i))?'selected':''); ?> value="<?php echo (($i=='3')?'2m':$i); ?>">
													<?php echo (($i=='3')?'2+ ':$i)." Bedroom" ; ?>
												</option>
							<?php			} ?>
                                			
                                		</select>
                                	</div>
                                	<div class="col-md-3">
                                	<!--form-group form-group-lg form-group-select-plus-->
                                		<label>Members</label>
                                		<select class="form-control members" name="members">
                            			<?php
                            				for($i=1;$i<=5;$i++){ ?>
												<option <?php echo ((isset($room_result->members) && ($room_result->members==$i))?'selected':''); ?> value="<?php echo $i; ?>"><?php echo $i." Members"; ?></option>
							<?php			} ?>
                                			
                                		</select>
                                	</div>
                                	<div class="col-md-3">
                                		<label>Bathroom</label>
                                		<select class="form-control bathrooms" name="bathrooms">
                            			<?php
                            				for($i=1;$i<=3;$i++){ ?>
												<option <?php echo ((isset($room_result->bathrooms) && ($room_result->bathrooms==$i))?'selected':''); ?> value="<?php echo $i; ?>">
													<?php echo $i." Bathroom" ; ?>
												</option>
							<?php			} ?>
                                			
                                		</select>
                                	</div>
                                </div>
                                
                                <div class="form-group row">
                                	<div class="col-md-3">
                                		<label>Rent Per Night</label>
                                		<input class="form-control rent_per_night floatNumberOnly" name="rent_per_night" value="<?php echo (isset($room_result->rent_per_night)?$room_result->rent_per_night:''); ?>" type="text" />
                                	</div>
                                	<div class="col-md-3">
                                		<label>Rent Per 24 Hours</label>
                                		<input class="form-control rent_per_one_day floatNumberOnly" name="rent_per_one_day" value="<?php echo (isset($room_result->rent_per_one_day)?$room_result->rent_per_one_day:''); ?>" type="text" />
                                	</div>
                                	<div class="col-md-3">
                                		<label>Rent Per 1+ Days</label>
                                		<input class="form-control rent_per_oneplus_day floatNumberOnly" name="rent_per_oneplus_day" value="<?php echo (isset($room_result->rent_per_oneplus_day)?$room_result->rent_per_oneplus_day:''); ?>" type="text" />
                                	</div>
                                	<div class="col-md-3">
                                		<label>Rent Per 1 Month</label>
                                		<input class="form-control rent_per_month floatNumberOnly" name="rent_per_month" value="<?php echo (isset($room_result->rent_per_month)?$room_result->rent_per_month:''); ?>" type="text" />
                                	</div>
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Description</label>
                                    <textarea class="form-control description" rows="5" cols="5" name="description" style="resize: none;"><?php echo (isset($room_result->description)?$room_result->description:''); ?></textarea>
                                </div>
                                <div class="form-group ">
                                    <label>Image</label>
                                    <!--<input type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple>-->
                                    <input type="file" accept="image/*" name="room_image[]" multiple>
                                </div>
                                <hr>
                                <div class="form-actions text-center">
                                	<input type="submit" class="btn btn-primary" value="Save Changes">
                                	<a href="<?php echo site_url(uri_string()); ?>" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="gap"></div>

<script type="text/javascript">
	
	function validate_form(){
		var room_name=$(".room_name").val();
		if(room_name==''){
			$(".room_name").focus();
			swal("Oopss !","You missed to fill Room Name. ","error");
			return false;
		}
		var area_name=$(".area_name").val();
		if(area_name==''){
			$(".area_name").focus();
			swal("Oopss !","You missed to fill Area Name. ","error");
			return false;
		}
		var address=$(".address").val();
		if(address==''){
			$(".address").focus();
			swal("Oopss !","You missed to fill Address. ","error");
			return false;
		}
		var owner_name=$(".owner_name").val();
		if(owner_name==''){
			$(".owner_name").focus();
			swal("Oopss !","You missed to fill Partner Name. ","error");
			return false;
		}
		var owner_email=$(".owner_email").val();
		if(owner_email==''){
			$(".owner_email").focus();
			swal("Oopss !","You missed to fill Partner Email Id. ","error");
			return false;
		}
		var owner_phone_no=$(".owner_phone_no").val();
		if(owner_phone_no==''){
			$(".owner_phone_no").focus();
			swal("Oopss !","You missed to fill Partner Mobile No. ","error");
			return false;
		}
		var email=$(".email").val();
		if(email==''){
			$(".email").focus();
			swal("Oopss !","You missed to fill Room Email Id. ","error");
			return false;
		}
		var phone_no=$(".phone_no").val();
		if(phone_no==''){
			$(".phone_no").focus();
			swal("Oopss !","You missed to fill Room Mobile No. ","error");
			return false;
		}
		var website=$(".website").val();
		if(website==''){
			$(".website").focus();
			swal("Oopss !","You missed to fill Room Website Addr. ","error");
			return false;
		}
		var rent_per_night=$(".rent_per_night").val();
		if(rent_per_night==''){
			$(".rent_per_night").focus();
			swal("Oopss !","You missed to fill Rent Per Night. ","error");
			return false;
		}
		var rent_per_one_day=$(".rent_per_one_day").val();
		if(rent_per_one_day==''){
			$(".rent_per_one_day").focus();
			swal("Oopss !","You missed to fill Rent Per One Day. ","error");
			return false;
		}
		var rent_per_oneplus_day=$(".rent_per_oneplus_day").val();
		if(rent_per_oneplus_day==''){
			$(".rent_per_oneplus_day").focus();
			swal("Oopss !","You missed to fill Rent Per One Plus Day. ","error");
			return false;
		}
		var rent_per_month=$(".rent_per_month").val();
		if(rent_per_month==''){
			$(".rent_per_month").focus();
			swal("Oopss !","You missed to fill Rent Per Month. ","error");
			return false;
		}
		var description=$(".description").val();
		if(description==''){
			$(".description").focus();
			swal("Oopss !","You missed to fill Room Description. ","error");
			return false;
		}
		return true;
	}
	
    $(document).ready(function() {
        $('input[type="file"]').imageuploadify();
    })
</script>


<script>
    	
    
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIp5eclDgmB3rpB-ilKuww0_pvnwX9wCM&libraries=places&callback=initAutocomplete" async defer></script>



		<div class="container">
            <div class="booking-item-details">
                <header class="booking-item-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h2 class="lh1em">Midtown Manhattan Oversized</h2>
                            <?php
                            	$amenitiesArray=explode(",",$rooms_result->amenities_list);
                            	$suitabilityArray=explode(",",$rooms_result->suitability_list);
                            ?>
                            <p class="lh1em text-small"><i class="fa fa-map-marker"></i> <?php echo $rooms_result->address; ?></p>
                            <ul class="list list-inline text-small">
                                <li><a href="#"><i class="fa fa-envelope"></i> <?php echo $rooms_result->email_id; ?></a>
                                </li>
                                <li><a href="#"><i class="fa fa-home"></i> <?php echo $rooms_result->website; ?></a>
                                </li>
                                <li><i class="fa fa-phone"></i> <?php echo $rooms_result->phone_no; ?></li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <p class="booking-item-header-price">
                            	<span class="text-lg">
                        		<?php
                        			$price_name=$this->lang->line('price_name');
	                        		$rent_per_month=$rooms_result->rent_per_month;
	                        		
	                        		echo $price_name." ".$rent_per_month;
                        		?>
                            	</span>/Month
                            </p>
                        </div>
                    </div>
                </header>
                <div class="row">
                    <div class="col-md-7">
                        <div class="tabbable booking-details-tabbable">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-camera"></i>Photos</a>
                                </li>
                                <li><a href="#google-map-tab" data-toggle="tab"><i class="fa fa-map-marker"></i>On the Map</a>
                                </li>
                                <li><a href="#tab-3" data-toggle="tab"><i class="fa fa-info-circle"></i>About</a>
                                </li>
                                <!--<li><a href="#tab-4" data-toggle="tab"><i class="fa fa-bars"></i>Similar</a></li>-->
                                
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab-1">
                                    <!-- START LIGHTBOX GALLERY -->
                                    <div class="row row-no-gutter" id="popup-gallery">
                                    <?php
                                    	if( isset($room_image_result[$rooms_result->room_id]) && count($room_image_result[$rooms_result->room_id])>0){
											foreach($room_image_result[$rooms_result->room_id] as $key=>$value){
												$image_thumb=(isset($value['image_thumb'])?$value['image_thumb']:'assets/img/no-image.png');
												$image_path=(isset($value['image_path'])?$value['image_path']:'assets/img/no-image.png');
												$image_alt_name=(isset($value['alt_name'])?$value['alt_name']:$rooms_result->room_name);
												 ?>
												<div class="col-md-3">
		                                            <a class="hover-img popup-gallery-image" href="<?php echo base_url().$image_path; ?>" data-effect="mfp-zoom-out">
		                                                <img src="<?php echo base_url().$image_thumb; ?>" height="100px" alt="Image Alternative text" title="<?php echo $image_alt_name ?>" /><i class="fa fa-plus round box-icon-small hover-icon i round"></i>
		                                            </a>
		                                        </div>
						<?php				}
										} ?>
										
                                    </div>
                                    <!-- END LIGHTBOX GALLERY -->
                                </div>
                                <div class="tab-pane fade" id="google-map-tab">
                                    <div id="map-canvas" style="width:100%; height:500px;"></div>
                                </div>
                                <div class="tab-pane fade" id="tab-3">
                                    <div class="mt20">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5>Description</h5>
                                                <p><?php $rooms_result->description; ?></p>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Amenities</h5>
                                                <ul class="booking-item-features booking-item-features-expand mb30 clearfix">
                                                <?php
                                                	if(count($amenities_result)>0){
														foreach($amenities_result as $ar){
															if(in_array($ar->id,$amenitiesArray)){ 
																$iconArray=explode(" ",$ar->type);
															?>
																<li><i class="im im-<?php echo strtolower($iconArray[0]); ?>"></i><span class="booking-item-feature-title"><?php echo $ar->type; ?></span></li>
								<?php						}
														}
													} ?>
                                                
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <h5>Suitability</h5>
                                                <ul class="booking-item-features booking-item-features-expand mb30 clearfix">
                                                    <?php
                                                	if(count($suitability_result)>0){
														foreach($suitability_result as $ar){
															if(in_array($ar->id,$suitabilityArray)){ 
																$iconArray=explode(" ",$ar->type);
															?>
																<li><i class="im im-<?php echo strtolower($iconArray[0]); ?>"></i><span class="booking-item-feature-title"><?php echo $ar->type; ?></span></li>
								<?php						}
														}
													} ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- tab-4 -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="booking-item-meta">
                            <h2 class="lh1em mt40">Exeptional!</h2>
                            <div class="booking-item-rating">
                            	<?php $ratings=$rooms_result->ratings; ?>
                                <ul class="icon-list icon-group booking-item-rating-stars">
                                    <?php for($i=1;$i<=5;$i++){ 
                              			$classs="";
                              			if($i<=$ratings){
											$classs="fa fa-star";
										}
										else{
											$classs="fa fa-star-o";
										}?>
                                	<li><i class="<?php echo $classs; ?>"></i></li>
                      <?php        	} ?>
                                </ul><span class="booking-item-rating-number"><b ><?php echo $ratings; ?></b> of 5 <small class="text-smaller">guest rating</small></span>
                                <p><a class="text-default" href="#"></a>
                                </p>
                            </div>
                        </div>
                        <div class="booking-item-dates-change">
                            <form action="<?php echo site_url('home/send_room_inquiry') ?>" method="post" id="inquiry_form">
                            	<input type="hidden" name="room_id" value="<?php echo $rooms_result->room_id; ?>" />
                            	<input type="hidden" name="room_name" value="<?php echo $rooms_result->room_name; ?>" />
                            	<input type="hidden" name="client_email" value="<?php echo $rooms_result->email_id; ?>" />
                            	<input type="hidden" name="room_address" value="<?php echo $rooms_result->address; ?>" />
                            	<input type="hidden" name="owner_name" value="<?php echo $rooms_result->owner_name; ?>" />
                            	<input type="hidden" name="owner_email" value="<?php echo $rooms_result->owner_email; ?>" />
                            	<input type="hidden" name="owner_phone_no" value="<?php echo $rooms_result->owner_phone_no; ?>" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <label>Adults</label>
                                            <select class="form-control" name="adult_options">
                                                <option selected="selected">1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                                <option>13</option>
                                                <option>14</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Children</label>
                                            <select class="form-control" name="child_options">
                                                <option selected="selected">0</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>11</option>
                                                <option>12</option>
                                                <option>13</option>
                                                <option>14</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                        	<label>Person Name</label>
		                                    <input class="form-control person_name" name="person_name" value="" type="text" />
		                                </div>
		                            </div>
		                            <div class="col-md-6">
		                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
		                                    <label>Phone No</label>
		                                    <input class=" form-control email" name="email" value="" type="hidden" />
		                                    <input class="intNumberOnly form-control phone_no" maxlength="11" name="phone_no" value="" type="text" />
		                                </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
		                                    <label>Email Id</label>
		                                    <input class=" form-control customer_email" name="customer_email" value="" type="text" />
		                                </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                            <label>Inquire</label>
                                            <textarea class="form-control comment" rows="5" cols="5" required="" name="comment" style="resize: none;">I would like to Inquire About <?php echo ucwords($rooms_result->room_name); ?> Rooms.</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="gap gap-small"></div>	<span class="btn btn-primary btn-lg send_message">Send Message</span>
                    </div>
                </div>
            </div>
            <div class="gap"></div>
        </div>
        
<script>
	
	/*function isValidEmailAddress(emailAddress) {
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(emailAddress);
	};*/
	function isValidEmailAddress(emailAddress) {
	    //var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
	    var pattern = new RegExp("^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$");
	    // alert( pattern.test(emailAddress) );
	    return pattern.test(emailAddress);
	};

	$(document).ready(function(){
		
		$(".send_message").click(function(){
			
			var phone_no=$(".phone_no").val();
			var comment=$(".comment").val();
			var customer_email=$(".customer_email").val();
			if(phone_no==''){
				$(".phone_no").focus();
				swal("Ooppss !","You missed the Phone Number Field !","error");
			}
			else if(comment==''){
				$(".comment").focus();
				swal("Ooppss !","You missed the Inquire text Field !","error");
			}
			else if(customer_email==''){
				$(".customer_email").focus();
				swal("Ooppss !","You missed the Emil Id text Field !","error");
			}
			else if( !isValidEmailAddress( customer_email ) ) {
				//$(".customer_email").val('');
				$(".customer_email").focus();
				swal("Ooppss !","Please mention your valid Email Id !","error");
			}
			else{
				swal({   title: "Are you sure?",   text: "You want to send the message to room owners!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, send it!",   cancelButtonText: "No, cancel it!",   closeOnConfirm: false,   closeOnCancel: false },
				function(isConfirm){
					if (isConfirm){
						$("#inquiry_form").submit();
						swal("Sent!", "Room Owner will call to your No "+phone_no+" with in some time.", "success");
					}
					else{
						swal("Cancelled", "Your Message has not been sent :)", "error");
					}
				});
			}
		});
		
	});
</script>


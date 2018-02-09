
		<div class="container">
            <!--<h1 class="page-title"><?php echo ucwords(str_replace('_',' ',$this->router->fetch_class())); ?></h1>-->
            <h3 class="pull-right">Room List</h3>
        </div>
        <hr />
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php $this->load->view('template/profile_sidebar'); ?>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                        	<div class="row row-col-gap">
                        		<div class="col-md-12">
	                        		<div class="col-md-4">
	                        			<label>Search Rooms</label>
	                        			<select class="select-search search-control" id="select_room">
			                        		<!--<option value=""> Search Rooms</option>-->
			                        		<?php foreach($room_result as $rro){ ?>
			                        				<option value="<?php echo $rro->room_id; ?>"><?php echo ucwords($rro->room_name); ?></option>
			                      <?php 		} ?>
			                        	</select>
	                        		</div>
	                        		<div class="col-md-4">
	                        			<label>Search Location</label>
	                        			<select class="select-search search-control" id="select_area">
			                        		<?php $locationArray=array();
			                        			foreach($room_result as $rro){
			                        				$area=(isset($rro->area) && $rro->area!='')?ucwords($rro->area):"Not Available";
			                        				$area_id=(isset($rro->area) && $rro->area!='')?$rro->area_id:0;
			                        				if(!in_array($area_id,$locationArray)){ ?>
														<option value="<?php echo $area_id; ?>"><?php echo ucwords($area); ?></option>
								<?php				array_push($locationArray,$area_id);
													}
										 		} ?>
			                        	</select>
	                        		</div>
	                        		<div class="col-md-4">
	                        			<div class="gap gap-top"></div>
	                        			<span class="btn btn-warning all_item">All Rooms</span>
	                        		</div>
	                        	</div>
                        	</div>
                        	
                        	<div class="col-md-12">
                        	<?php if(count($room_result)>0){ 
                        				$typeArray=array(
                        								'hotel'=>'<i class="fa fa-building-o"></i>',
                        								'rental'=>'<i class="fa fa-home"></i>',
                        							);
                        		?>
                        		<table class="table table-bordered table-striped table-booking-history room_table" style="width: 100%">
			                        <thead>
			                            <tr>
			                            	<th>Type</th>
			                            	<th>Name</th>
			                            	<th>Location</th>
			                            	<th>Rent</th>
			                            	<th>Features</th>
			                            	<th>Images</th>
			                            	<th>Add to Top Rooms </th>
			                            	<th>Action</th>
			                            </tr>
			                        </thead>
			                        <tbody>
			                        <?php
			                        	$price_name=$this->lang->line('price_name');
			                        	foreach($room_result as $rr){ ?>
											<tr class="room_tr tr_<?php echo $rr->room_id; ?> tr_area_<?php echo $rr->area_id; ?>">
												<td class="booking-history-type">
												<?php  
													echo (isset($typeArray[$rr->room_type])?$typeArray[$rr->room_type]:'<i class="fa fa-bell"></i>');
													echo "<small>".ucwords($rr->room_type)."</small>";
												?>
												</td>
												<td><?php echo ucwords($rr->room_name); ?></td>
												<td><?php echo (isset($rr->area) && $rr->area!='')?ucwords($rr->area):"Not Available"; ?></td>
												<td>
												<table style="white-space: nowrap;">
													<tbody>
														<tr>
															<td>Per Night &nbsp;</td><td>: <?php echo $rr->rent_per_night." ".$price_name; ?></td>
														</tr>
														<tr>
															<td>Per 24 Hours &nbsp; </td><td>: <?php echo $rr->rent_per_one_day." ".$price_name; ?></td>
														</tr>
														<tr>
															<td>Per 24+ Hours &nbsp; </td><td>: <?php echo $rr->rent_per_oneplus_day." ".$price_name; ?></td>
														</tr>
														<tr>
															<td>Per 1 Month &nbsp; </td><td>: <?php echo $rr->rent_per_month." ".$price_name; ?></td>
														</tr>
													</tbody>
												</table>
												</td>
												<td>
												<table style="white-space: nowrap;">
													<tbody>
														<tr>
															<td>Ratings &nbsp;</td><td>: <?php echo $rr->ratings." Star"; ?></td>
														</tr>
														<tr>
															<td>Compatibility &nbsp; </td><td>: <?php echo $rr->members." Members"; ?></td>
														</tr>
														<tr>
															<td>Availability &nbsp; </td><td>: <?php echo $rr->bedroom." Bedrooms"; ?></td>
														</tr>
													</tbody>
												</table>
												</td>
												<td>
												<?php if(isset($room_image_result[$rr->room_id]) && count($room_image_result[$rr->room_id])>0){
														$count=1;
													?>
													<div class="" id="popup-gallery_<?php echo $rr->room_id; ?>">
												<?php 	
														foreach($room_image_result[$rr->room_id] as $key=>$value){ 
															$c_style='style="display: none; outline: none; text-decoration: none; "';
															if($count==1){
																$c_style='style="display: block; outline: none; text-decoration: none; "';
															}
														?>
															<a <?php echo $c_style; ?> class="hover-img popup-gallery-image" href="<?php echo base_url().$value['image_path']; ?>" data-effect="mfp-zoom-out">
																View
															</a>
									<?php				$count++;
														} ?>
													</div>
													<script>
														var room_id="<?php echo $rr->room_id; ?>";
														$('#popup-gallery_'+room_id+' ').each(function() {
															
														    $(this).magnificPopup({
														        delegate: 'a.popup-gallery-image',
														        type: 'image',
														        gallery: {
														            enabled: true
														        }
														    });
														});
													</script>
									<?php			} ?>
												</td>
												
												<td style="white-space: nowrap">
												<?php if($rr->is_in_top_four=='1'){?>
														<label>
															<span class="btn btn-ghost btn-success add_to_top_four" is_added="<?php echo $rr->is_in_top_four; ?>" room_id="<?php echo $rr->room_id; ?>" style="display: none;">
																Add
															</span>
															<span class="btn btn-ghost btn-danger remove_to_top_four" is_added="<?php echo $rr->is_in_top_four; ?>" room_id="<?php echo $rr->room_id; ?>">
																Remove
															</span>
														</label>
									<?php			}
													else{ ?>
														<label>
															<span class="btn btn-ghost btn-success add_to_top_four" is_added="<?php echo $rr->is_in_top_four; ?>" room_id="<?php echo $rr->room_id; ?>">
																Add
															</span>
															<span class="btn btn-ghost btn-danger remove_to_top_four" is_added="<?php echo $rr->is_in_top_four; ?>" room_id="<?php echo $rr->room_id; ?>"  style="display: none;">
																Remove
															</span>
														</label>
									<?php			} ?>
													
												</td>
												<td><a href="<?php echo site_url('add_rooms/edit_room/'.$rr->room_id); ?>">Edit</a></td>
											</tr>
						<?php			} ?>
			                        </tbody>
								</table>
                        	<?php } ?>
                        	</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="gap"></div>

<script type="text/javascript">

function validate_top_rooms(){
	var count=0;
	$(".room_table .add_to_top_four").each(function(){
		var is_added=$(this).attr("is_added");
		if(is_added=='1'){
			count++;
		}
	});
	
	if(count>=4){
		swal("Sorry !","Already 4 Rooms are Added to Top Four !<br> To Add new Rooms Please Remove any rooms from previous.","error");
		return false;
	}
	return true;
	
}

$(document).ready(function() {
	
	$(document).on("change","#select_room",function(){
		$(".room_table tbody").find(".room_tr").hide();
		
		var room_id=$(this).val();
		if(room_id!=''){
			$(".tr_"+room_id+" ").show();
		}
		else{
			$(".tr_"+room_id+" ").hide();
		}
	});
	
	$(document).on("change","#select_area",function(){
		$(".room_table tbody").find(".room_tr").hide();
		
		var area_id=$(this).val();
		if(area_id!=''){
			$(".tr_area_"+area_id+" ").show();
		}
		else{
			$(".tr_area_"+area_id+" ").hide();
		}
	});
	
	$(document).on('click',".all_item",function(){
		$(".room_table tbody").find(".room_tr").hide();
		$(".room_table tbody").find(".room_tr").show();
	});
	
	$(document).on("click",".add_to_top_four",function(){
		var room_id=$(this).attr("room_id");
		var thiss=$(this);
		if(validate_top_rooms()){
			$.post(
				"<?php echo site_url('ajax/addRoomToTopFourPlaces'); ?>",
				{room_id:room_id},
				function(res){
					if(res!='0' && res!=''){
						thiss.hide();
						thiss.attr("is_added",'1');
						thiss.closest('tr').find(".remove_to_top_four").show();
						swal("Updated !","Changes have been Saved successfully.","success");
					}
					else{
						swal("Oopss !","Changes can't be Saved .","error");
					}
			});
		}
		/*else{
			swal("Oopss !","Value Can't be posted ' .","error");
		}*/
	});
	
	$(document).on("click",".remove_to_top_four",function(){
		var room_id=$(this).attr("room_id");
		var thiss=$(this);
		
		$.post(
			"<?php echo site_url('ajax/removeRoomFromTopFourPlaces'); ?>",
			{room_id:room_id},
			function(res){
				if(res!='0' && res!=''){
					thiss.hide();
					thiss.closest('tr').find(".add_to_top_four").show();
					thiss.closest('tr').find(".add_to_top_four").attr("is_added",'0');
					swal("Updated !","Changes have been Saved successfully.","success");
				}
				else{
					swal("Oopss !","Changes can't be Saved .","error");
				}
		});
	});
	
});

</script>

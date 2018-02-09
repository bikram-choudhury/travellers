

        <div class="container">
            <h3 class="booking-title">Stay Home Results in <?php echo (isset($area_result->area_name)?$area_result->area_name:''); ?> </h3>
        	<?php $this->load->view('template/search_modal'); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php $this->load->view('template/result_sidebar'); ?>
                </div>
                <div class="col-md-9">
			
			<?php if(count($rooms_result)>0){ ?>
				
                    <div class="nav-drop booking-sort">
                        <h5 class="booking-sort-title"><a href="#">Sort: <span id="selected_sort_filter">Rating (hight to low)</span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a></h5>
                        <ul class="nav-drop-menu">
                            <li><a class="ul-lh-drop-menu" filter="phl" href="#">Price (hight to low)</a></li>
                            <li><a class="ul-lh-drop-menu" filter="plh" href="#">Price (low to high)</a></li>
                            <li><a class="ul-lh-drop-menu" filter="rhl" href="#">Rating (hight to low)</a></li>
                            <li><a class="ul-lh-drop-menu" filter="rlh" href="#">Rating (low to high)</a></li>
                        </ul>
                    </div>
                    <ul class="booking-list" id="roomsResultULView">
                    <?php
                    	if(count($rooms_result)>0){
							foreach($rooms_result as $rr){
								$image_thumb=(isset($room_image_details[$rr->room_id]['image_thumb'])?$room_image_details[$rr->room_id]['image_thumb']:'assets/img/no-image.png');
								$image_count=(isset($room_image_details[$rr->room_id]['image_count'])?$room_image_details[$rr->room_id]['image_count']:'0');
								 ?>
								<li value="<?php echo $rr->rent_per_month; ?>" rating="<?php echo $rr->ratings; ?>">
		                            <a class="booking-item" href="<?php echo base_url('home/rooms_detail/'.$rr->room_id); ?>">
		                                <div class="row">
		                                    <div class="col-md-3">
		                                        <div class="booking-item-img-wrap">
		                                            <img src="<?php echo base_url().$image_thumb; ?>" alt="Room Image " title="<?php echo "Hotel ".ucwords($rr->room_name); ?>" />
		                                            <div class="booking-item-img-num"><i class="fa fa-picture-o"></i><?php echo $image_count; ?></div>
		                                        </div>
		                                    </div>
		                                    <div class="col-md-5">
		                                        <div class="booking-item-rating">
		                                        	<?php $ratings=$rr->ratings; ?>
		                                            <ul class="icon-group booking-item-rating-stars">
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
		                                                
		                                            </ul><span class="booking-item-rating-number"><b ><?php echo $ratings; ?></b> of 5</span><small></small>
		                                        </div>
		                                        <h5 class="booking-item-title"><?php echo ucwords($rr->room_name); ?></h5>
		                                        <p class="booking-item-address"><i class="fa fa-map-marker"></i> <?php echo (isset($rr->address)?ucwords($rr->address):'') ?></p>
		                                        <ul class="booking-item-features booking-item-features-rentals booking-item-features-sign">
		                                            <li rel="tooltip" data-placement="top" title="Sleeps"><i class="fa fa-male"></i><span class="booking-item-feature-sign">x <?php echo $rr->members; ?></span>
		                                            </li>
		                                            <li rel="tooltip" data-placement="top" title="Bedrooms"><i class="im im-bed"></i><span class="booking-item-feature-sign">x <?php echo $rr->bedroom; ?></span>
		                                            </li>
		                                            <li rel="tooltip" data-placement="top" title="Bathrooms"><i class="im im-shower"></i><span class="booking-item-feature-sign">x <?php echo $rr->bathrooms; ?></span>
		                                            </li>
		                                        </ul>
		                                    </div>
		                                    <div class="col-md-4">
		                                    	<span class="booking-item-price">
		                                    	<?php 
		                                    		$price_name=$this->lang->line('price_name');
		                                    		$rent_per_month=$rr->rent_per_month;
		                                    		
		                                    		echo $price_name." ".$rent_per_month;
		                                    	?>
		                                    	</span>
		                                    	<span>/Month</span>
		                                    	<span class="btn btn-primary">Book Now</span>
		                                    </div>
		                                </div>
		                            </a>
		                        </li>
		<?php				}
						} ?>
                    	
                    </ul>
                    <div class="row">
                        <div class="col-md-6">
                            <p><small><?php echo $total_rows; ?> rentals rooms found in <?php echo (isset($area_result->area_name)?$area_result->area_name:''); ?>. &nbsp;&nbsp;Showing <?php echo $page; ?> – <?php echo ($page+$per_page); ?></small>
                            </p>
                            <?php echo $pagelink; ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <p>Not what you're looking for? <a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out">Try your search again</a>
                            </p>
                        </div>
                    </div>

			<?php }
				  else{ ?>
				  	<div class="row" >
				  		<!--<label>No results found !</label>
				  		border: 1px solid #12d9e2;
					    padding: 10px;
					    color: #ed8323;
					    font-size: x-large;
					    font-family: cursive;
				  		-->
				  		<img src="<?php echo base_url('assets/img/no_result.png'); ?>" />
				  		    
				  	</div>
			<?php  } ?>
			
                </div>
            </div>
            <div class="gap"></div>
        </div>
        
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$(".ul-lh-drop-menu").click(function(){
			
			var filter_text=$(this).text();
			var filter_type=$(this).attr("filter");
			
			$("#selected_sort_filter").text(filter_text);
			
			if(filter_type=='phl'){
				$("#roomsResultULView").html(
					$("#roomsResultULView").children("li").sort(function(a,b){
						return $(b).val()-$(a).val();
					})
				);
			}
			if(filter_type=='plh'){
				$("#roomsResultULView").html(
					$("#roomsResultULView").children("li").sort(function(a,b){
						return $(a).val()-$(b).val();
					})
				);
			}
			if(filter_type=='rhl'){
				$("#roomsResultULView").html(
					$("#roomsResultULView").children("li").sort(function(a,b){
						return $(b).attr("rating")-$(a).attr("rating");
					})
				);
			}
			if(filter_type=='rlh'){
				$("#roomsResultULView").html(
					$("#roomsResultULView").children("li").sort(function(a,b){
						return $(a).attr("rating")-$(b).attr("rating");
					})
				);
			}
			
		});
	});
</script>        

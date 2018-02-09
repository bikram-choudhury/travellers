				
	<aside class="booking-filters text-white">
        <h3>Filter By:</h3>
        <?php
        	$decodedURLArray=array();
        	$price_range='';$ratings=array();$bedrooms=array();$amenities=array();$suitability=array();
        	if($encodedURL!=''){
        		$decodedURL=urldecode($encodedURL);
				$decodedURLArray=json_decode($decodedURL,TRUE);
				
				$price_range=(isset($decodedURLArray['price_range'])?$decodedURLArray['price_range']:'');
				$ratings=(isset($decodedURLArray['ratings'])?$decodedURLArray['ratings']:array());
				$bedrooms=(isset($decodedURLArray['bedrooms'])?$decodedURLArray['bedrooms']:array());
				$amenities=(isset($decodedURLArray['amenities'])?$decodedURLArray['amenities']:array());
				$suitability=(isset($decodedURLArray['suitability'])?$decodedURLArray['suitability']:array());
        	}
        	$from_price=1000; $to_price=25000;
        	if($price_range!=''){
				$priceArray=explode(";",$price_range);
				
				$from_price=$priceArray[0];
				$to_price=$priceArray[1];
			}
        	
        ?>
        <form action="<?php echo site_url('home/rooms_filter_result') ?>" id="filter_form" method="post">
        	<input type="hidden" name="area_id" value="<?php echo $area_id; ?>" />
	        <ul class="list booking-filters-list">
	            <li>
	                <h5 class="booking-filters-title">Price</h5>
	                <input type="text" id="rental-price-slider" name="price_range" value="<?php echo $price_range; ?>">
	            </li>
	            <li>
	                <h5 class="booking-filters-title">Star Rating</h5>
	                <?php
	                	for($i=5;$i>=1;$i--){
	                		$selectedd="";
	                		if( $ratings!='' && in_array($i,$ratings)){
								$selectedd="checked";
							}
	                		 ?>
	                		<div class="checkbox" >
	                            <label>
	                                <input class="i-check ratings" <?php echo $selectedd; ?> name="ratings[]" type="checkbox" value="<?php echo $i; ?>" /><?php echo $i." Star"; ?></label>
	                        </div>
	          <?php   	} ?>
	                
	            </li>
	            <li>
	                <h5 class="booking-filters-title">Bedrooms</h5>
	                <?php
	                	for($i=1;$i<=3;$i++){
	                		$selectedd="";
	                		if( $bedrooms!='' && in_array($i,$bedrooms)){
								$selectedd="checked";
							}
	                		 ?>
	                		<div class="checkbox">
	                            <label>
	                                <input class="i-check bedrooms" name="bedrooms[]" <?php echo $selectedd; ?> type="checkbox" value="<?php echo (($i=='3')?'2m':$i); ?>" />
	                                	<?php echo (($i=='3')?'2+ ':$i)." Bedroom" ; ?>
								</label>
	                        </div>
	          <?php   	} ?>
	                
	            </li>
	            <li>
	                <h5 class="booking-filters-title">Amenities</h5>
	                <?php
	                	if(count($amenities_result)>0){
							foreach($amenities_result as $ar){
								$selectedd="";
		                		if( $amenities!='' && in_array($ar->id,$amenities)){
									$selectedd="checked";
								}
								 ?>
								<div class="checkbox">
	                                <label>
	                                    <input class="i-check amenities" type="checkbox" <?php echo $selectedd; ?> name="amenities[]" value="<?php echo $ar->id; ?>" />
	                                    <?php echo ucwords($ar->type); ?>
	                                </label>
	                            </div>
			<?php			}
						} ?>
	            </li>
	            <li>
	                <h5 class="booking-filters-title">Suitability</h5>
	                
	                <?php
	                	if(count($suitability_result)>0){
							foreach($suitability_result as $ar){
								$selectedd="";
		                		if( $suitability!='' && in_array($ar->id,$suitability)){
									$selectedd="checked";
								}
								 ?>
								<div class="checkbox">
	                                <label>
	                                    <input class="i-check suitability" type="checkbox" <?php echo $selectedd; ?> name="suitability[]" value="<?php echo $ar->id; ?>" />
	                                    <?php echo ucwords($ar->type); ?>
	                                </label>
	                            </div>
			<?php			}
						} ?>
	                
	            </li>
	        </ul>
		</form>
    </aside>
    
<script>
	function submitForm(){
		//alert("Bikram");
		$("#filter_form").submit();
	}
	$(document).ready(function(){
		
		$('input').on('ifToggled', function(event){
		  //alert(event.type + ' callback');
		  submitForm();
		});
		
		$("#rental-price-slider").ionRangeSlider({
		    min: 1000,
		    max: 25000,
		    from:'<?php echo $from_price; ?>',
		    to:'<?php echo $to_price; ?>',
		    type: 'double',
		    prefix: "$",
		    // maxPostfix: "+",
		    prettify: false,
		    hasGrid: true,
		    onLoad: function (obj){        // callback is called after slider load and update
		    	//alert("1");
		        console.log(obj);
		    },
		    onChange: function (obj){      // callback is called on every slider change
		    	//alert("2");
		    	submitForm();
		        console.log(obj);
		    }
		});
		
	});
</script>
    
    
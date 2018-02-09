	
		<div class="container">
            <h1 class="page-title"><?php echo ucwords(str_replace('_',' ',$this->router->fetch_class())); ?></h1>
        </div>
        <style>
        	.bookingid_info{
				cursor: pointer;
			}
        </style>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php $this->load->view('template/profile_sidebar'); ?>
                </div>
                <div class="col-md-7 col-md-offset-1">
                <?php if($this->session->flashdata('error')!='' &&  $this->session->flashdata('error')==0){ ?>
						    <div class="alert alert-success fade in block-inner">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<?php echo $this->session->flashdata('status'); ?>
							</div>
					<?php	 }
							elseif($this->session->flashdata('error')!='' &&  $this->session->flashdata('error')==1){ ?>
						   	<div class="alert alert-danger fade in block-inner">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<?php echo $this->session->flashdata('status'); ?>
							</div>
					<?php	} ?>
                    <!--<i class="fa fa-check round box-icon-large box-icon-center box-icon-success mb30"></i>	-->
                    <h2 class="text-center"> Please Enter last 6 digits of the Booking Id !</h2>
                    <h3 class="text-center mb30" style="color: blueviolet;"><?php echo substr($inquiry_result->booking_code,0,-6).str_repeat("&Chi;",6) ?></h3>
                    <ul class="order-payment-list list mb30">
                        <li>
                            <div class="row">
                            	<div class="col-xs-4"></div>
                            	<div class="col-xs-4 text-center">
                            		<form action="<?php echo site_url('checkin/check_booking_code') ?>" id="booking_form" method="post" onsubmit="return validate_form()">
                            			<input type="hidden" name="inquiry_info" value='<?php echo $inquiry_result->inquiry_info; ?>' />
                            			<input type="hidden" name="inquiry_id" value="<?php echo $inquiry_result->inq_id; ?>" />
                            			<input type="hidden" name="bookingid_hidden" value="<?php echo $inquiry_result->booking_code; ?>" />
                            			<input type="hidden" name="bookingid_display" value="<?php echo substr($inquiry_result->booking_code,0,-6); ?>" />
                            			<input type="text" id="bookingid_input" name="bookingid_input" value="" match_bookingid="<?php echo substr($inquiry_result->booking_code,-6); ?>" maxlength="6" autofocus="" placeholder="<?php echo str_repeat("&Chi;",6); ?>" class="form-control" style="border: 2px solid #009688;text-align: center;font-size: xx-large;padding: 25px;" />
                            		</form>
                            	</div>
                            	<div class="col-xs-4"></div>
                                
                            </div>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
        
        <div class="gap"></div>


<script type="text/javascript">
	
	function validate_form(){
		var bookingid_input=$("#bookingid_input").val();
		var match_bookingid=$("#bookingid_input").attr("match_bookingid");
		
		if(bookingid_input==''){
			//alert('123');
			$(this).focus();
			swal("Sorry !","Field Can't be empty !","error");
			return false;
		}
		else if(match_bookingid!=bookingid_input){
			//alert("456");
			$(this).focus();
			swal("Sorry !","Entered Value is not matching !","error");
			return false;
		}
		return true;
	}
	
	$(document).ready(function(){
		/*$(document).on("keyup","#bookingid_input",function(e){
			if(e.keyCode==13){
				var match_bookingid=$(this).attr("match_bookingid");
				var value=$(this).val();
				alert(match_bookingid+"--------"+value);
				if(validate_form()){
					//$("#booking_form").submit();
				}
			}
			
		});*/
	});
	
</script>




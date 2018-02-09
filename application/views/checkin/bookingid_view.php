	
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
                <div class="col-md-9">
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
                    <div class="row row-wrap">
                    	<div class="mfp-with-anim mfp-hide mfp-dialog" id="edit-card-dialog">
                        <h3 class="mb0">Edit Card</h3>
                        <p>Visa XXXX XXXX XXXX 1234</p>
                        <form class="cc-form">
                            <div class="clearfix">
                                <div class="form-group form-group-cc-number">
                                    <label>Card Number</label>
                                    <input class="form-control" placeholder="xxxx xxxx xxxx xxxx" type="text" /><span class="cc-card-icon"></span>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div class="form-group form-group-cc-name">
                                    <label>Cardholder Name</label>
                                    <input class="form-control" value="John Doe" type="text" />
                                </div>
                                <div class="form-group form-group-cc-date">
                                    <label>Valid Thru</label>
                                    <input class="form-control" placeholder="mm/yy" type="text" />
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input class="i-check" type="checkbox" />Set as primary</label>
                            </div>
                            <ul class="list-inline">
                                <li>
                                    <input class="btn btn-primary" type="submit" value="Edit Card" />
                                </li>
                                <li>
                                    <button class="btn btn-primary"><i class="fa fa-times"></i> Remove Card</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <?php
                    if(count($pending_checkin_result)>0){
						foreach($pending_checkin_result as $pcr){ ?>
							<div class="col-md-4 bookingid_info" booking_info='<?php echo $pcr->inquiry_info; ?>' inquiry_id="<?php echo $pcr->inq_id; ?>">
	                            <div class="card-thumb">
	                                <ul class="card-thumb-actions">
	                                    <li>
	                                        <a class="fa fa-pencil popup-text" href="#edit-card-dialog" rel="tooltip" data-placement="top" title="edit" data-effect="mfp-zoom-out"></a>
	                                    </li>
	                                    <li>
	                                        <a class="fa fa-times" href="#" rel="tooltip" data-placement="top" title="remove"></a>
	                                    </li>
	                                </ul>
	                                <p class="card-thumb-number"><?php echo substr($pcr->booking_code,0,-6).str_repeat("&Chi;",6) ?></p>
	                                <p class="card-thumb-valid">Contact No <span><?php echo $pcr->sender_contact_no; ?></span>
	                                </p>
	                                <!--<img class="card-thumb-type" src="img/payment/american-express-curved-32px.png" alt="Image Alternative text" title="Image Title" />--><small>Idholder name</small>
	                                <h5 class="uc"><?php echo ucwords($pcr->sender_name); ?></h5>
	                            </div>
	                        </div>
		<?php			}
					} ?>
                        
                    </div>

                </div>
            </div>
        </div>
        
        <div class="gap"></div>


<script type="text/javascript">
	
	$(document).ready(function(){
		$(document).on("click",".bookingid_info",function(){
			var inquiry_id=$(this).attr("inquiry_id");
			window.location.href="<?php echo site_url('checkin/confirm_booking_code'); ?>/"+inquiry_id;
		});
	});
	
</script>




	
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
                        <div class="col-md-5">
                            <form action="<?php echo site_url('attributes/save_amenities') ?>" method="post" onsubmit="return amenities_validation()">
                                <h4>Amenities</h4>
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
                                    <input class="form-control attr_name" name="attr_name" value="" type="text" />
                                    <input class="form-control attr_id" name="attr_id" value="" type="hidden" />
                                </div>
                                
                                <hr>
                                <div class="form-actions text-center">
                                	<input type="submit" class="btn btn-primary" value="Save Changes">
                                	<a href="<?php echo site_url(uri_string()); ?>" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                            <div class="gap gap-small"></div>
                            <div class="row">
                            	<h4>View</h4>
                            	<div class="col-md-12" style="overflow-y: auto; max-height: 400px;">
                            	<?php if(count($suitability_result)>0){ ?>
                            		<table class="table table-bordered table-striped table-booking-history">
				                        <thead>
				                            <tr><th>Type</th><th>Action</th></tr>
				                        </thead>
				                        <tbody>
			                        	<?php
			                        		foreach($amenities_result as $ar){ ?>
												<tr>
													<td><?php echo ucwords($ar->type); ?></td>
													<td>
														<ul class="list-inline">
															<li>
																<i class="fa fa-edit box-icon attr_edit" type_name="<?php echo $ar->type; ?>" type_id="<?php echo $ar->id; ?>" ></i>
															</li>
															<li>
																<div class="checkbox checkbox-stroke"><!--checkbox-switch-->
									                                <label class="">
									                                    <input class="i-check attr_status" type="checkbox" type_id="<?php echo $ar->id; ?>" <?php echo (($ar->is_active=='1')?'checked':''); ?>  />
																	</label>
									                            </div>
															</li>
															
														</ul>
													</td>
												</tr>
								<?php		} ?>
				                        </tbody>
				                    </table>
                            	<?php } ?>
                            	</div>
                            </div>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <form action="<?php echo site_url('attributes/save_suitability') ?>" method="post" onsubmit="return suitability_validation()">
                                <h4>Suitability</h4>
                                <?php if($this->session->flashdata('error_s')!='' &&  $this->session->flashdata('error_s')==0){ ?>
								    <div class="alert alert-success fade in block-inner">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo $this->session->flashdata('status_s'); ?>
									</div>
							<?php	 }
									elseif($this->session->flashdata('error_s')!='' &&  $this->session->flashdata('error_s')==1){ ?>
								   	<div class="alert alert-danger fade in block-inner">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo $this->session->flashdata('status_s'); ?>
									</div>
							<?php	} ?>
                                <div class="form-group form-group-icon-left"><i class="fa fa-chain input-icon"></i>
                                    <label>Name</label>
                                    <input class="form-control suitattr_name" name="attr_name" value="" type="text" />
                                    <input class="form-control suitattr_id" name="attr_id" value="" type="hidden" />
                                </div>
                                
                                <hr>
                                <div class="form-actions text-center">
                                	<input type="submit" class="btn btn-primary" value="Save Changes">
                                	<a href="<?php echo site_url(uri_string()); ?>" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                            <div class="gap gap-small"></div>
                            <div class="row">
                            	<h4>View</h4>
                            	<div class="col-md-12" style="overflow-y: auto; max-height: 400px;">
                            	<?php if(count($suitability_result)>0){ ?>
                            		<table class="table table-bordered table-striped table-booking-history">
				                        <thead>
				                            <tr><th>Type</th><th>Action</th></tr>
				                        </thead>
				                        <tbody>
			                        	<?php
			                        		foreach($suitability_result as $ar){ ?>
												<tr>
													<td><?php echo ucwords($ar->type); ?></td>
													<td>
														<ul class="list-inline">
															<li>
																<i class="fa fa-edit box-icon suitattr_edit" type_name="<?php echo $ar->type; ?>" type_id="<?php echo $ar->id; ?>" ></i>
															</li>
															<li>
																<div class="checkbox checkbox-stroke"><!--checkbox-switch-->
									                                <label class="">
									                                    <input class="i-check suitattr_status" type="checkbox" type_id="<?php echo $ar->id; ?>" <?php echo (($ar->is_active=='1')?'checked':''); ?>  />
																	</label>
									                            </div>
															</li>
															
														</ul>
													</td>
												</tr>
								<?php		} ?>
				                        </tbody>
				                    </table>
                            	<?php } ?>
                            	</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="gap"></div>


<script type="text/javascript">
	
	function amenities_validation(){
		var attr_name=$(".attr_name").val();
		if(attr_name==''){
			
			$(".attr_name").focus();
			swal('Error!',"Amenities Field Can't be NULL","error");
			return false;
		}
		
		return true;
	}
	
	function suitability_validation(){
		var suitattr_name=$(".suitattr_name").val();
		if(suitattr_name==''){
			
			$(".suitattr_name").focus();
			swal('Error!',"Amenities Field Can't be NULL","error");
			return false;
		}
		
		return true;
	}
	
	$(document).ready(function(){
		$(document).on('click',".attr_edit",function(){
			var type_name=$(this).attr('type_name');
			var type_id=$(this).attr('type_id');
			
			$(".attr_name").val(type_name);
			$(".attr_id").val(type_id);
			
		});
		
		$(document).on('click',".suitattr_edit",function(){
			var type_name=$(this).attr('type_name');
			var type_id=$(this).attr('type_id');
			
			$(".suitattr_name").val(type_name);
			$(".suitattr_id").val(type_id);
			
		});
		
		$(document).on('click',".attr_status",function(){
			alert('123');
			var type_id=$(this).attr('type_id');
			
			/*swal({ title: "Are you sure?", text: "You want to Change the status this Amenities!", type: "warning", showCancelButton: true, confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, Change it!", cancelButtonText: "No, cancel plx!", closeOnConfirm: false, closeOnCancel: false }, 
				function(isConfirm){
					if(isConfirm){
		 			
					 	$.ajax
					 	({
					 		type:'POST',
					 		url:"<?php echo site_url('ajax/updateAmenitiesStatus'); ?>",
					 		data:{type_id:type_id},
					 		async:false,
					 		success:function(response){
					 			if(response==1){
									swal("Success!", "Requested Type has been successfully activeted.", "success");
								}
								else{
									swal("Error!", "Your request has not been processed successfully!.", "error");
								}
							} 				
					 	});
	 			   }
	 			   else{
	 			   		swal("Cancelled", "Request has been cancelled :)", "error");
	 			   	}
			});*/
			
		});
		
		$(document).on('click',".suitattr_status",function(){
			alert('123suit');
			var type_id=$(this).attr('type_id');
			
			/*swal({ title: "Are you sure?", text: "You want to Change the status this Amenities!", type: "warning", showCancelButton: true, confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, Change it!", cancelButtonText: "No, cancel plx!", closeOnConfirm: false, closeOnCancel: false }, 
				function(isConfirm){
					if(isConfirm){
		 			
					 	$.ajax
					 	({
					 		type:'POST',
					 		url:"<?php echo site_url('ajax/updateSuitabilityStatus'); ?>",
					 		data:{type_id:type_id},
					 		async:false,
					 		success:function(response){
					 			if(response==1){
									swal("Success!", "Requested Type has been successfully activeted.", "success");
								}
								else{
									swal("Error!", "Your request has not been processed successfully!.", "error");
								}
							} 				
					 	});
	 			   }
	 			   else{
	 			   		swal("Cancelled", "Request has been cancelled :)", "error");
	 			   	}
			});*/
			
		});
		
	});
	
</script>




	
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
                            <form action="<?php echo site_url('user_profile/update_profille') ?>" method="post" onsubmit="return personal_setting_validation()">
                                <h4>Personal Infomation</h4>
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
                                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon"></i>
                                    <label>Name</label>
                                    <input class="form-control full_name" name="full_name" value="<?php echo (isset($user_result->name)?$user_result->name:''); ?>" type="text" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon"></i>
                                    <label>E-mail</label>
                                    <input class="form-control email" name="email" value="<?php echo (isset($user_result->email)?$user_result->email:''); ?>" type="text" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-phone input-icon"></i>
                                    <label>Phone Number</label>
                                    <input class="form-control mobile_no" name="mobile_no" maxlength="11" value="<?php echo (isset($user_result->mobile_no)?$user_result->mobile_no:''); ?>" type="text" />
                                </div>
                                
                                <hr>
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            </form>
                            <?php if($this->session->userdata('user_id') && $this->session->userdata('user_type')=='007'){
                            			$portal_result=$this->authentication->portal_details();
                            			$portal_name=(isset($portal_result->portal_name)?$portal_result->portal_name:"Bikram");
                            			$portal_logo=(isset($portal_result->portal_logo)?$portal_result->portal_logo:"assets/img/logon.png");
                            			
                            	 	?>
		                            <div class="gap gap-small"></div>
		                            <form method="post" action="<?php echo site_url('user_profile/update_portal_settings') ?>" enctype="multipart/form-data" onsubmit="return portal_settings_validate()">
		                            	<h4>Portal Settings</h4>
		                            	<div class="form-group form-group-icon-left"><i class="fa fa-plane input-icon"></i>
		                                    <label><?php echo $this->lang->line('portal_name'); ?></label>
		                                    <input class="form-control portal_name" value="<?php echo $portal_name; ?>" type="text" name="portal_name" />
		                                </div>
		                                <div class="form-group">
		                                    <label>Logo</label>
		                                    <img src="<?php echo base_url().$portal_logo; ?>" alt="Traveler Logo" title="Traveler" />
		                                    <input class="form-control" type="file" id="logo_image" name="logo_image" />
		                                </div>
		                                <hr>
		                                <input type="submit" class="btn btn-primary" value="Save Changes">
		                            </form>
                            <?php } ?>
                        </div>
                        <div class="col-md-5 col-md-offset-1">
                            <h4>Change Password</h4>
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
                            <form action="<?php echo site_url('user_profile/update_password') ?>" method="post" onsubmit="return password_validation()">
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>Current Password</label>
                                    <input class="form-control curnt_password" type="password" name="curnt_password" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>New Password</label>
                                    <input class="form-control new_password" name="new_password" type="password" />
                                </div>
                                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon"></i>
                                    <label>New Password Again</label>
                                    <input class="form-control conf_password" name="conf_password" type="password" />
                                </div>
                                <hr />
                                <input class="btn btn-primary" type="submit" value="Change Password" />
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="gap"></div>


<script type="text/javascript">
	
	function password_validation(){
		var curnt_password=$(".curnt_password").val();
		if(curnt_password==''){
			$(".curnt_password").focus();
			swal('Error!',"Current Password Can't be NULL","error");
			return false;
		}
		var new_password=$(".new_password").val();
		if(new_password==''){
			$(".new_password").focus();
			swal('Error!',"New Password Can't be NULL","error");
			return false;
		}
		var conf_password=$(".conf_password").val();
		if(conf_password==''){
			$(".conf_password").focus();
			swal('Error!',"Confirm Password Can't be NULL","error");
			return false;
		}
		
		if(conf_password!=new_password){
			$(".conf_password").val('');
			$(".new_password").val('');
			$(".new_password").focus();
			swal('Error!',"Confirm Password Should Match with New Password .","error");
			return false;
		}
		return true;
	}
	
	function personal_setting_validation(){
		var full_name=$(".full_name").val();
		if(full_name==''){
			$(".full_name").focus();
			swal('Error!',"Name Can't be NULL","error");
			return false;
		}
		
		var email=$(".email").val();
		if(email==''){
			$(".email").focus();
			swal('Error!',"Email Can't be NULL","error");
			return false;
		}
		
		var mobile_no=$(".mobile_no").val();
		if(mobile_no==''){
			$(".mobile_no").focus();
			swal('Error!',"Phone Number Can't be NULL","error");
			return false;
		}
		
		return true;
	}
	
	function portal_settings_validate(){
		
		var portal_name=$(".portal_name").val();
		if(portal_name==''){
			$(".portal_name").focus();
			var x='<?php echo $this->lang->line("portal_name"); ?>';
			var message="Please enter "+x+" !";
			swal('Error!',message,"error");
			
			return false;
		}
		var file = $('#logo_image');
		var ext = getExtension(file.val());
		
		/*var extensionArray=["png"];
		if($.inArray('ext', extensionArray) > -1 ){*/
		if(ext!='png'){
			swal('Error!','You can only attatch PNG Images ! ! !, Please select proper file !.','error');
			return false;
		}
		
		return true;
	}
	
	function getExtension(filename) 
	{
	    var parts = filename.split('.');
	    return parts[parts.length - 1];
	}
	
</script>





	<aside class="user-profile-sidebar">
        <div class="user-profile-avatar text-center">
        	<?php 
        		$user_image=$this->session->userdata('user_image');
              	$name=$this->session->userdata('name');
              	$created_date=$this->session->userdata('created_date');
            ?>
            <img src="<?php echo base_url().$user_image ?>" alt="Image Alternative text" title="<?php echo $name; ?>" />
            <h5><?php echo $name; ?></h5>
            <p>Member Since <?php echo date("M Y",strtotime($created_date)) ?></p>
        </div>
        <ul class="list user-profile-nav">
            <li><a href="<?php echo site_url('user_profile'); ?>"><i class="fa fa-user"></i>Overview</a></li>
            <li><a href="<?php echo site_url('user_profile/settings'); ?>"><i class="fa fa-cog"></i>Settings</a></li>
	<?php if($this->session->userdata('user_id') && $this->session->userdata('user_type')=='007'){ ?>
            <li><a href="<?php echo site_url('attributes'); ?>"><i class="fa fa-plus-circle"></i>Attributes</a></li>
            <li><a href="<?php echo site_url('add_rooms'); ?>"><i class="fa fa-plus-square"></i>Add Rooms</a></li>
            <li><a href="<?php echo site_url('add_rooms/view_rooms'); ?>"><i class="fa fa-list-ul"></i>View Rooms</a></li>
	<?php } ?>
            <li><a href="<?php echo site_url('checkin/pendings'); ?>"><i class="fa fa-star-o"></i>Pending CheckIn</a></li>
            
            <!--<li><a href="user-profile-photos.html"><i class="fa fa-camera"></i>My Travel Photos</a></li>
            <li><a href="user-profile-booking-history.html"><i class="fa fa-clock-o"></i>Booking History</a></li>
            <li><a href="user-profile-cards.html"><i class="fa fa-credit-card"></i>Credit/Debit Cards</a></li>
            <li><a href="user-profile-wishlist.html"><i class="fa fa-heart-o"></i>Wishlist</a></li>-->
        </ul>
    </aside>
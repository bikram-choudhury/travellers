<!DOCTYPE HTML>
<html>

<head>
	<?php 
		$portal_result=$this->authentication->portal_details(); 
		$portal_name=(isset($portal_result->portal_name)?$portal_result->portal_name:"Bikram");
		$portal_logo=(isset($portal_result->portal_logo)?$portal_result->portal_logo:"assets/img/logon.png");
	?>
    <title><?php echo $portal_name; ?></title>


    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <!--<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>-->
    <!-- /GOOGLE FONTS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mystyles.css">
    <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>assets/js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    
    <link href="<?php echo base_url();?>assets/selectbox/select2.css" rel="stylesheet"/>
	<script src="<?php echo base_url();?>assets/selectbox/select2.js"></script>
	
    <script src="<?php echo base_url(); ?>assets/js/custom_out.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/magnific.js"></script>
    
</head>

<body>

    <!-- FACEBOOK WIDGET -->
    <div id="fb-root"></div>
    <script>
        /*(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));*/
    </script>
    <!-- /FACEBOOK WIDGET -->
    <div class="global-wrap">
        <header id="main-header">
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <a class="logo" href="<?php echo site_url('home'); ?>">
                                <img src="<?php echo base_url().$portal_logo; ?>" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </div>
                        <div class="col-md-3 col-md-offset-2">
                            <form class="main-header-search">
                                <div class="form-group form-group-icon-left">
                                    <i class="fa fa-search input-icon"></i>
                                    <input type="text" class="form-control">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="top-user-area clearfix">
                                <ul class="top-user-area-list list list-horizontal list-border">
                              <?php if($this->session->userdata('user_id')){
                              			$user_image=$this->session->userdata('user_image');
                              			$name=$this->session->userdata('name');
                              			 ?>
                                		<li class="top-user-area-avatar">
	                                        <a href="<?php echo site_url('user_profile') ?>">
	                                            <img class="origin round" src="<?php echo base_url().$user_image; ?>" alt="Image Alternative text" title="AMaze" />Hi, <?php echo $name; ?></a>
	                                    </li>
	                                    <li><a href="<?php echo site_url('logout') ?>">Sign Out<!--fa-power-off<i class="fa fa-sign-out box-icon-big box-icon-border round"></i>--></a></li>
                            <?php  	}
                            		else{ ?>
                            			<li><a href="<?php echo site_url('login') ?>">Sign In<!--<i class="fa fa-sign-in box-icon-big box-icon-border round"></i>--></a></li>
                            <?php	} ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="nav">
                    <ul class="slimmenu" id="slimmenu">
                        <li class="active"><a href="<?php echo site_url('home'); ?>">Home</a></li>
                        <li><a href="<?php echo site_url('home/rooms_result') ?>">Rentals</a></li>
                        <li><a href="hotels.html">Hotels</a>
                            <ul>
                                <li><a href="hotel-details.html">Details</a>
                                    <ul>
                                        <li><a href="hotel-details.html">Layout 1</a>
                                        </li>
                                        <li><a href="hotel-details-2.html">Layout 2</a>
                                        </li>
                                        <li><a href="hotel-details-3.html">Layout 3</a>
                                        </li>
                                        <li><a href="hotel-details-4.html">Layout 4</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="hotel-payment.html">Payment</a>
                                    <ul>
                                        <li><a href="hotel-payment.html">Registered</a>
                                        </li>
                                        <li><a href="hotel-payment-registered-card.html">Existed Cards</a>
                                        </li>
                                        <li><a href="hotel-payment-unregistered.html">Unregistered</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="hotel-search.html">Search</a>
                                    <ul>
                                        <li><a href="hotel-search.html">Layout 1</a>
                                        </li>
                                        <li><a href="hotel-search-2.html">Layout 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="hotels.html">Results</a>
                                    <ul>
                                        <li><a href="hotels.html">Layout 1</a>
                                        </li>
                                        <li><a href="hotels-search-results-2.html">Layout 2</a>
                                        </li>
                                        <li><a href="hotels-search-results-3.html">Layout 3</a>
                                        </li>
                                        <li><a href="hotels-search-results-4.html">Layout 4</a>
                                        </li>
                                        <li><a href="hotel-search-results-5.html">Layout 5</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </header>
        
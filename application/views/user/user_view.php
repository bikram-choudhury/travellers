		<div class="container">
            <h1 class="page-title"><?php echo ucwords(str_replace('_',' ',$this->router->fetch_class())); ?></h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?php $this->load->view('template/profile_sidebar'); ?>
                </div>
                <div class="col-md-9">
                    <h4>Total Traveled</h4>
                    <ul class="list list-inline user-profile-statictics mb30">
                        <li><i class="fa fa-dashboard user-profile-statictics-icon"></i>
                            <h5>12540</h5>
                            <p>Miles</p>
                        </li>
                        <li><i class="fa fa-globe user-profile-statictics-icon"></i>
                            <h5>2%</h5>
                            <p>World</p>
                        </li>
                        <li><i class="fa fa-building-o user-profile-statictics-icon"></i>
                            <h5>15</h5>
                            <p>Cityes</p>
                        </li>
                        <li><i class="fa fa-flag-o user-profile-statictics-icon"></i>
                            <h5>3</h5>
                            <p>Countries</p>
                        </li>
                        <li><i class="fa fa-plane user-profile-statictics-icon"></i>
                            <h5>20</h5>
                            <p>Trips</p>
                        </li>
                    </ul>
                    <div id="map-canvas" style="width:100%; height:400px;"></div>
                </div>
            </div>
        </div>



        <div class="gap"></div>
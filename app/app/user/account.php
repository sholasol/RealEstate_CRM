<?php 
include 'dash_nav.php'; 

$qq=  dbConnect()->prepare("SELECT sum(obalance) AS bal, count(id) AS bank FROM bank WHERE compID='$uid'");
$qq->execute();
$r=$qq->fetch();
$no=$r['bank'];
$balance = $r['bal'];
?>
<!--Horizontal Nav-->
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!--/Horizontal Nav-->
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header">
                    <div>
			<h2 class="hk-pg-title font-weight-600">Bank Accounts</h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                        <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="" class="btn btn-outline-secondary">company</a>
                            <a href="" class="btn btn-outline-secondary">New employee</a>
                        </div>
                        <a href="addAccount" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span><span class="btn-text">New Account</span></a>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hk-row">
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">All Banks</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($no)." Accounts"; ?></span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Bank Balance</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block">
                                                                        <span class="display-5 font-weight-300 text-dark"> <span class="counter-anim"> <?php echo number_format($balance); ?> </span></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Revenue this month</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark">$8,725</span>
                                                                            <small>excl tax</small>
                                                                    </span>
                                                            </div>
                                                            <div>
                                                                    <span class="text-success font-12 font-weight-600">+5%</span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Outstanding Invoices</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark">18 invoices</span>
                                                                    </span>
                                                            </div>
                                                            <div>
                                                                    <span class="text-danger font-12 font-weight-600">-12%</span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="hk-row">
                            <div class="col-lg-8">
                                    <div class="card card-refresh">
                                            <div class="refresh-container">
                                                    <div class="loader-pendulums"></div>
                                            </div>
                                            <div class="card-header card-header-action">
                                                    <h6>Double Click Campaigning Stats</h6>
                                                    <div class="d-flex align-items-center card-action-wrap">
                                                            <a href="#" class="inline-block refresh mr-15">
                                                                    <i class="ion ion-md-radio-button-off"></i>
                                                            </a>
                                                            <a href="#" class="inline-block full-screen">
                                                                    <i class="ion ion-md-expand"></i>
                                                            </a>
                                                    </div>
                                            </div>
                                            <div class="card-body">
                                                    <div class="hk-legend-wrap mb-20">
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Click Rate</span>
                                                            </div>
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-5 rounded-circle d-inline-block"></span><span>Impressions</span>
                                                            </div>
                                                    </div>
                                                    <div id="area_chart" class="echart" style="height: 194px;"></div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                            <div class="card">
                                            <div class="card-header card-header-action">
                                                    <h6>Lead Stats</h6>
                                                    <div class="d-flex align-items-center card-action-wrap">
                                                            <div class="inline-block dropdown">
                                                                    <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-ios-more"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="card-body">
                                                    <div class="hk-legend-wrap mb-20">
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown rounded-circle d-inline-block"></span><span>Won Leads</span>
                                                            </div>
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-5 rounded-circle d-inline-block"></span><span>Lost Leads</span>
                                                            </div>
                                                    </div>
                                                    <div id="e_chart_4" class="echart" style="height:194px;"></div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="hk-row">
                            <div class="col-lg-4">
                                    <div class="card">
                                            <div class="card-header card-header-action">
                                                    <h6>Balance Sheet Statistics</h6>
                                                    <div class="d-flex align-items-center card-action-wrap">
                                                            <div class="d-flex align-items-center card-action-wrap">
                                                                    <a href="#" class="inline-block refresh mr-15">
                                                                            <i class="ion ion-md-arrow-down"></i>
                                                                    </a>
                                                                    <a class="inline-block card-close" href="#" data-effect="fadeOut">
                                                                            <i class="ion ion-md-close"></i>
                                                                    </a>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="card-body">
                                                    <div id="flot_line_chart_moving" class="" style="height:334px;"></div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                            <div class="card">
                                            <div class="card-header card-header-action">
                                                    <h6>Budget</h6>
                                                    <div class="d-flex align-items-center card-action-wrap">
                                                            <div class="inline-block dropdown">
                                                                    <a class="dropdown-toggle no-caret" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="ion ion-ios-more"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="#">Action</a>
                                                                            <a class="dropdown-item" href="#">Another action</a>
                                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                                            <div class="dropdown-divider"></div>
                                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
                                            <div class="card-body">
                                                    <div class="hk-legend-wrap mb-20">
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-2 rounded-circle d-inline-block"></span><span>A1</span>
                                                            </div>
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>A2</span>
                                                            </div>
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>A3</span>
                                                            </div>
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-4 rounded-circle d-inline-block"></span><span>A4</span>
                                                            </div>
                                                    </div>
                                                    <div id="e_chart_9" class="echart" style="height:287px;"></div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-4">
                                            <div class="card">
                                            <div class="card-header card-header-action">
                                                    <h6>Risk</h6>
                                                    <div class="d-flex align-items-center card-action-wrap">
                                                            <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary risk-switch"></div>
                                                    </div>
                                            </div>
                                            <div class="card-body">
                                                    <div id="e_chart_10" class="echart" style="height:260px;"></div>
                                                    <div class="hk-legend-wrap mt-20 mb-5">
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-2 rounded-circle d-inline-block"></span><span>Net Search</span>
                                                            </div>
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Email Search</span>
                                                            </div>
                                                    </div>
                                                    <div class="hk-legend-wrap">
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>Direct Search</span>
                                                            </div>
                                                            <div class="hk-legend">
                                                                    <span class="d-10 bg-brown-light-4 rounded-circle d-inline-block"></span><span>Paid Search</span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
                            <h4>Accounts</h4>
                            <button class="btn btn-sm btn-link">view all</button>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                    <div class="table-wrap">
                                            <div class="table-responsive">
                                                    <table class="table table-sm table-hover mb-0">
                                                            <thead>
                                                                    <tr>
                                                                            <th></th>
                                                                            <th>Bank</th>
                                                                            <th>Account No</th>
                                                                            <th>Opening Balance</th>
                                                                            <th>Balance</th>
                                                                            <th>Status</th>
                                                                            <th>Transactions</th>
                                                                            <th>Last Transaction</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM bank WHERE compID='$comp'");
                                                                $q->execute();
                                                                while($ro=$q->fetch()){
                                                                ?>
                                                                    <tr>
                                                                            <td><img class="img-fluid rounded" src="dist/img/logo1.jpg" alt="icon"></td>
                                                                            <td><?php echo $ro['bank']; ?></td>
                                                                            <td><?php echo $ro['account']; ?></td>
                                                                            <td><?php echo number_format($ro['obalance']); ?></td>
                                                                            <td><?php echo number_format($ro['balance']); ?></td>
                                                                            <td><span class="badge badge-success"><?php echo $ro['status']; ?></span></td>
                                                                            <td><span class="d-flex align-items-center"><i class="zmdi zmdi-time-restore font-25 mr-10 text-light-40"></i><span><?php echo $ro['transactions']; ?></span></span></td>
                                                                            <td><?php echo $ro['last_transact']; ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                    </table>
                                            </div>
                                    </div>
                            </div>
                    </div>		
		 </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
			
            <!-- Footer -->
            <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>Powered by<a href="" class="text-dark">Hybridsoft</a> © <?php echo date('Y'); ?></p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p class="d-inline-block">Follow us</p>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
	
	<!-- Toastr JS -->
    <script src="vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    
	<!-- Counter Animation JavaScript -->
	<script src="vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="vendors/raphael/raphael.min.js"></script>
    <script src="vendors/morris.js/morris.min.js"></script>
	
	<!-- Easy pie chart JS -->
    <script src="vendors/easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	
	<!-- Flot Charts JavaScript -->
    <script src="vendors/flot/excanvas.min.js"></script>
    <script src="vendors/flot/jquery.flot.js"></script>
    <script src="vendors/flot/jquery.flot.pie.js"></script>
    <script src="vendors/flot/jquery.flot.resize.js"></script>
    <script src="vendors/flot/jquery.flot.time.js"></script>
    <script src="vendors/flot/jquery.flot.stack.js"></script>
    <script src="vendors/flot/jquery.flot.crosshair.js"></script>
    <script src="vendors/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
	
	<!-- EChartJS JavaScript -->
    <script src="vendors/echarts/dist/echarts-en.min.js"></script>
    
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
	<script src="dist/js/dashboard2-data.js"></script>
	
</body>

</html>
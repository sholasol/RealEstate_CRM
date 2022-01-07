<?php 
include 'dash_nav.php';

$dd=date('m');
$dat= date('F');
$yr=date('Y');
                                        
$qq=  dbConnect()->prepare("SELECT distinct(month) AS month, year, count(userID) AS user, sum(basic) AS basic, sum(benefit) AS benefit, sum(deduction) AS deduction, sum(net) AS net FROM emp_pay WHERE branch='$branch' AND year='$yr' AND month='$dd' GROUP BY branch ORDER BY month DESC");
$qq->execute();
$ro=$qq->fetch();
        
?>
<div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
<!--/Horizontal Nav-->
<!-- Main Content -->
<div class="hk-pg-wrapper">
                <!-- Container -->
    <div class="container mt-xl-50 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header">
            <div>
                <h2 class="hk-pg-title font-weight-600">Payroll</h2>
            </div>
            <div class="d-flex mb-0 flex-wrap">
                <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                    <a href="schedule" class="btn btn-outline-secondary">Payment Schedule</a>
                    <a href="emp_sal" class="btn btn-outline-secondary">Employee Salary </a>
                </div>
                <?php
                 if($role=='HRAdmin'){ echo"
                <a href='apayroll' class='btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15'><span class='icon-label'><span class='feather-icon'><i data-feather='plus'></i></span> </span><span class='btn-text'>Shedule Monthly Payroll</span></a>";
                 }
                ?>
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
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Staff on Payroll</span>
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                    <div>
                                                        <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($ro['user']) ;?></span>
                                                    </div>
                                                    <!--<div class="position-absolute r-0">
                                                            <span id="pie_chart_1" class="d-flex easy-pie-chart" data-percent="86">
                                                                    <span class="percent head-font">86</span>
                                                            </span>
                                                    </div>-->
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Last Payroll (Net)</span>
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark">=N=<span class="counter-anim"><?php echo number_format($ro['net']) ;?></span></span>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Deductions</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark">=N= <?php echo number_format($ro['deduction']) ;?></span>
                                                                    
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Benefit</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark">=N= <?php echo number_format($ro['benefit']) ;?></span>
                                                            </span>
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
                    <div class="col-lg-6">
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
                    <div class="col-lg-6">
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
            <h4>Recent Payroll</h4>
    </div>
    <div class="card">
            <div class="card-body pa-0">
                    <div class="table-wrap">
                            <div class="table-responsive">
                               <table id="datable_1" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Employee</th>
                                        <th>Basic Salary</th>
                                        <th>Benefits</th>
                                        <th>Deductions</th>
                                        <th>Net</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        
                                        
                                        //$q=  dbConnect()->prepare("SELECT * FROM emp_pay WHERE month='$dd' AND year='$yr' AND branch='$branch'");
                                        $q=  dbConnect()->prepare("SELECT distinct(month) AS month, year, count(userID) AS user, sum(basic) AS basic, sum(benefit) AS benefit, sum(deduction) AS deduction, sum(net) AS net FROM emp_pay WHERE branch='$branch' GROUP BY month, year, branch ORDER BY month DESC");
                                        $q->execute();
                                        $counter =0;
                                        while($ro=$q->fetch()){
                                           $month= $ro['month'];
                                           $yar= $ro['year'];
                                            /*
                                            $gr=$ro['grade'];
                                            $jbl=$ro['job'];
                                            $u=$ro['userID'];
                                            /*
                                            $empN = dbConnect()->prepare("SELECT * FROM users WHERE userID='$u'");
                                            $empN->execute();
                                            $x= $empN->fetch();
                                            $empName=$x['fname']." ".$x['lname'];


                                            $gg=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$gr' ");
                                            $gg->execute();
                                            $rr=$gg->fetch();
                                            $grade =$rr['grade'];

                                            $gg1=  dbConnect()->prepare("SELECT job FROM job WHERE id='$jbl' ");
                                            $gg1->execute();
                                            $rr1=$gg1->fetch();
                                            $spec =$rr1['job'];
                                            
                                            */
                                        ?>
                                        <tr>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo $ro['user']; ?></td>
                                                <td><?php echo $ro['basic']; ?></td>
                                                <td><?php echo $ro['benefit']; ?></td>
                                                <td><?php echo $ro['deduction']; ?></td>
                                                <td><?php echo $ro['net']; ?></td>
                                                <td><?php echo $ro['month']; ?></td>
                                                <td><?php echo $ro['year']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="calendar"></i></span> <span class="caret"></span></button>
                                                            <div role="menu" class="dropdown-menu">
                                                                <a class="dropdown-item" href="m_schedule?m=<?php echo $month; ?>&yr=<?php echo $yar; ?>">View Schedule</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>
                                        <?php } ?>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Employee</th>
                                        <th>Basic Salary</th>
                                        <th>Benefits</th>
                                        <th>Deductions</th>
                                        <th>Net</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th width="10%"></th>
                                    </tr>
                                </tfoot>
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
    
    <!-- Data Table JavaScript -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/dataTables-data.js"></script>
	
	<!-- EChartJS JavaScript -->
    <script src="vendors/echarts/dist/echarts-en.min.js"></script>
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
	<script src="dist/js/dashboard2-data.js"></script>
	
</body>

</html>
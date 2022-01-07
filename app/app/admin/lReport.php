<?php 
include 'dash_nav.php'; 
//total leave
$q1=  dbConnect()->prepare("SELECT count(id) AS no FROM leaves WHERE branch='$branch'");
$q1->execute();
$rr=$q1->fetch();
$leaves=$rr['no'];

//Approved leave
$q2=  dbConnect()->prepare("SELECT count(id) AS no FROM leaves WHERE branch='$branch' AND status='Approved'");
$q2->execute();
$rr2=$q2->fetch();
$lapprove=$rr2['no'];

//Pending leave
$q3=  dbConnect()->prepare("SELECT count(id) AS no FROM leaves WHERE branch='$branch' AND status='Pending'");
$q3->execute();
$rr3=$q3->fetch();
$lpending=$rr3['no'];

//Declined leave
$q4=  dbConnect()->prepare("SELECT count(id) AS no FROM leaves WHERE branch='$branch' AND status='Declined'");
$q4->execute();
$rr4=$q4->fetch();
$ldecline=$rr4['no'];
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
			<h2 class="hk-pg-title font-weight-600">Leaves Report</h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                        <!--<div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="" class="btn btn-outline-secondary">Vendors</a>
                            <a href="" class="btn btn-outline-secondary">Expenses</a>
                        </div>-->
                        <a href="leaveR" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span><span class="btn-text">Leave Request</span></a>
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
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Leaves Year till Date</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($leaves); ?></span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Approved</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block">
                                                                        <span class="display-5 font-weight-400 text-dark"><span class="counter-anim"><?php echo number_format($lapprove); ?></span></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Pending</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($lpending); ?></span>
                                                                            
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Declined</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($ldecline); ?></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                        
                        
                        
                   
                   
                        
                        
                        
                   <div class="hk-row">
                                <div class="col-lg-6">
                                                <div class="card">
                                                <div class="card-header card-header-action">
                                                        <h6>Budget</h6>
                                                </div>
                                                <div class="card-body">

                                                        <div id="e_chart_a" class="echart" style="height:287px;"></div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                                <div class="card">
                                                <div class="card-header card-header-action">
                                                        <h6>Leave Process</h6>
                                                        <div class="d-flex align-items-center card-action-wrap">
                                                                <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary risk-switch"></div>
                                                        </div>
                                                </div>
                                                <div class="card-body">
                                                    <div id="e_chart_9" class="echart" style="height:260px;"></div><br>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        
                    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
                            <h4>Leaves</h4>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th><i class="icon icon-user"></i> Employee</th>
                                                    <th><i class="icon icon-calender"></i> Star date</th>
                                                    <th><i class="icon icon-calender"></i> End Date</th>
                                                    <th><i class="icon icon-list"></i> Purpose</th>
                                                    <th><i class="fa fa-clock-o"></i> Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tr=  dbConnect()->prepare("SELECT * FROM leaves WHERE branch='$branch'");
                                                $counter=0;
                                                $tr->execute();
                                                while($r=$tr->fetch())
                                                {
                                                    $usr= $r['userID'];
                                                    $id= $r['id'];
                                                    $q=  dbConnect()->prepare("SELECT fname, lname FROM users WHERE userID='$usr'");
                                                        $q->execute();
                                                        $rr=$q->fetch();
                                                        
                                                        $u_name=$rr['fname']." ".$rr['lname'];
                                                ?>
                                                <tr>
                                                        <td><?php echo ++$counter; ?></td>
                                                        <td><?php echo $u_name; ?></td>
                                                        <td><?php echo $r['start']; ?></td>
                                                        <td><?php echo $r['end']; ?></td>
                                                        <td><?php echo $r['purpose']; ?></td>
                                                        <td><span class="badge badge-primary"><?php echo $r['status']; ?></span></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="book"></i></span> <span class="caret"></span></button>
                                                                        <div role="menu" class="dropdown-menu">
                                                                            <a class="dropdown-item" href="leaveP?id=<?php echo $id; ?>">Process Request</a>
                                                                            <!--
                                                                            <a class="dropdown-item" href="esalary?id=<?php echo $id;?>">Set Salary</a>
                                                                            <a class="dropdown-item" href="edit_emp?id=<?php echo $id; ?>">Edit Employee</a>
                                                                            <a class="dropdown-item" href="#">Deactivate</a>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </td>
                                                </tr>
                                                <?php } ?>    
                                            <tfoot>
                                               <tr>
                                                    <th></th>
                                                    <th>Employee</th>
                                                    <th>Travel date</th>
                                                    <th>Return Date</th>
                                                    <th>Purpose</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="../dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="../dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="../dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="../vendors/jquery-toggles/toggles.min.js"></script>
    <script src="../dist/js/toggle-data.js"></script>
    
    
	
	<!-- Toastr JS -->
   <!-- <script src="../vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>-->
    
	<!-- Counter Animation JavaScript -->
	<script src="../vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="../vendors/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="../vendors/raphael/raphael.min.js"></script>
    <script src="../vendors/morris.js/morris.min.js"></script>
	
	<!-- Easy pie chart JS -->
    <script src="../vendors/easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	
	<!-- Flot Charts JavaScript -->
    <script src="../vendors/flot/excanvas.min.js"></script>
    <script src="../vendors/flot/jquery.flot.js"></script>
    <script src="../vendors/flot/jquery.flot.pie.js"></script>
    <script src="../vendors/flot/jquery.flot.resize.js"></script>
    <script src="../vendors/flot/jquery.flot.time.js"></script>
    <script src="../vendors/flot/jquery.flot.stack.js"></script>
    <script src="../vendors/flot/jquery.flot.crosshair.js"></script>
    <script src="../vendors/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    
    
    <!-- Data Table JavaScript -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../dist/js/dataTables-data.js"></script>
    
     <!-- Form Wizard JavaScript -->
    <script src="../vendors/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="../dist/js/form-wizard-data.js"></script>

	
	<!-- EChartJS JavaScript -->
    <script src="../vendors/echarts/dist/echarts-en.min.js"></script>
    
    <!-- Init JavaScript -->
    <script src="../dist/js/init.js"></script>
<!--    <script src="../dist/js/dashboard2-data.js"></script>-->
    <script src="../dist/js/validation-data.js"></script>
    <!-- Daterangepicker JavaScript -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/daterangepicker/daterangepicker.js"></script>
    <script src="../dist/js/daterangepicker-data.js"></script>
    <script>
        /*Dashboard3 Init*/
 
"use strict"; 
$(document).ready(function() {	
});

/*****E-Charts function start*****/
var echartsConfig = function() { 
	
        if( $('#e_chart_9').length > 0 ){
		var eChart_9 = echarts.init(document.getElementById('e_chart_9'));
		
		var option8 = {
			tooltip: {
				show: true,
				backgroundColor: '#fff',
				borderRadius:6,
				padding:6,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#324148',
					fontFamily: '"Roboto", sans-serif',
					fontSize: 12
				}	
			},
			series: [
				{
					name:'',
					type:'pie',
					radius : '60%',
					center : ['50%', '50%'],
					roseType : 'radius',
					color: ['#7a5449', '#666','#bca9a4'],
					data:[
						
						{value:<?php echo $lapprove; ?>, name:'Approved'},
						{value:<?php echo $lpending; ?>, name:'Pending'},
                                                {value:<?php echo $ldecline; ?>, name:'Declined'}
					],
					label: {
						normal: {
							formatter: '{b}\n{d}%'
						},
				  
					}
				}
			]
		};
		eChart_9.setOption(option8);
		eChart_9.resize();
	}

	if( $('#e_chart_a').length > 0 ){
		var eChart_a = echarts.init(document.getElementById('e_chart_a'));
		
		var option8 = {
			tooltip: {
				show: true,
				backgroundColor: '#fff',
				borderRadius:6,
				padding:6,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#324148',
					fontFamily: '"Roboto", sans-serif',
					fontSize: 12
				}	
			},
			series: [
				{
					name:'',
					type:'pie',
					radius : '60%',
					center : ['50%', '50%'],
					roseType : 'radius',
					color: ['#7a5449', '#a58b84', '#bca9a4', '#666'],
					data:[
						{value:400, name:'Purchase'},
						{value:800, name:'Income'},
                                                {value:200, name:'Expenses'}
					],
					label: {
						normal: {
							formatter: '{b}\n{d}%'
						},
				  
					}
				}
			]
		};
		eChart_a.setOption(option8);
		eChart_a.resize();
	}

	
}
/*****E-Charts function end*****/

/*****Resize function start*****/
var echartResize;
$(window).on("resize", function () {
	/*E-Chart Resize*/
	clearTimeout(echartResize);
	echartResize = setTimeout(echartsConfig, 200);
}).resize(); 
/*****Resize function end*****/

/*****Function Call start*****/
echartsConfig();
/*****Function Call end*****/
    </script>
	
</body>

</html>
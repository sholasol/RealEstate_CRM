 <!--Horizontal Nav-->
<?php 
include 'dash_nav.php'; 

$ep=  dbConnect()->prepare("SELECT count(userID) as count FROM employee WHERE status='Active'");
$ep->execute();
$r=$ep->fetch();

$no=$r['count'];



//Total leaves
$q1=  dbConnect()->prepare("SELECT count(id) as count FROM leaves WHERE YEAR(created)= Year(CURRENT_DATE()) and branch='$branch'");
$q1->execute();
$rr=$q1->fetch();
$leave=$rr['count'];

//Salary Paid YTD
$q2=  dbConnect()->prepare("SELECT sum(net) as sum FROM emp_pay WHERE branch='$branch' AND YEAR(created)= Year(CURRENT_DATE())");
$q2->execute();
$rr2=$q2->fetch();
$sal=$rr2['sum'];

//Expense YTD
$q3=  dbConnect()->prepare("SELECT sum(total) as sum FROM expense WHERE branch='$branch' AND YEAR(created)= Year(CURRENT_DATE()) AND status !='Decline'");
$q3->execute();
$rr3=$q3->fetch();
$expense=$rr3['sum'];

//benefit YTD
$q4=  dbConnect()->prepare("SELECT sum(benefit) as sum FROM emp_pay WHERE branch='$branch' AND YEAR(created)= Year(CURRENT_DATE()) ");
$q4->execute();
$rr4=$q4->fetch();
$benefit=$rr4['sum'];
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
			<h2 class="hk-pg-title font-weight-600">Employees Management </h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                       <!-- <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="" class="btn btn-outline-secondary">Vendors</a>
                            <a href="" class="btn btn-outline-secondary">Expenses</a>
                            <a href="aemployee" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><span class="feather-icon"><i data-feather="user"></i></span> </span><span class="btn-text">Create New Employee</span></a>
                        </div>-->
                        
                        
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
                                                        <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Employee YTD</span>
                                                        <div class="d-flex align-items-center justify-content-between position-relative">
                                                                <div>
                                                                    <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($no); ?></span>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                        <div class="card card-sm">
                                                <div class="card-body">
                                                        <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Leave Request YTD</span>
                                                        <div class="d-flex align-items-center justify-content-between position-relative">
                                                                <div>
                                                                        <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><span class="counter-anim"><?php echo number_format($leave) ?></span></span>
                                                                        </span>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                        <div class="card card-sm">
                                                <div class="card-body">
                                                        <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Salary YTD</span>
                                                        <div class="d-flex align-items-end justify-content-between">
                                                                <div>
                                                                        <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark">₦ <?php echo number_format($sal) ?></span>
                                                                        </span>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                        <div class="card card-sm">
                                                <div class="card-body">
                                                        <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Expenses YTD</span>
                                                        <div class="d-flex align-items-end justify-content-between">
                                                                <div>
                                                                        <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark">₦ <?php echo number_format($expense); ?></span>
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
                                                        <h6>Employees Grades</h6>
                                                </div>
                                                <div class="card-body">

                                                        <div id="e_chart_a" class="echart" style="height:287px;"></div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                                <div class="card">
                                                <div class="card-header card-header-action">
                                                        <h6>Expense Management</h6>
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
                            <h4>Employees</h4>
                            <button class="btn btn-sm btn-link">view all</button>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                <div class="table-wrap"><br>
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                        <th></th>
                                                        <th width="25%">Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Specification</th>
                                                        <th>Grade</th>
                                                        <th class="w-10">Status</th>
                                                        <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $epp=  dbConnect()->prepare("SELECT * FROM employee WHERE status='Active' ORDER BY fname");
                                                    $counter=0;
                                                    $epp->execute();
                                                    while($ro=$epp->fetch()){
                                                        $st=$ro['status'];
                                                        $jb=$ro['job'];
                                                        $gr=$ro['grade'];
                                                        $id=$ro['userID'];
                                                        
                                                        $q=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$gr'");
                                                        $q->execute();
                                                        $rr=$q->fetch();
                                                        
                                                        $qq=  dbConnect()->prepare("SELECT job FROM job WHERE id='$jb'");
                                                        $qq->execute();
                                                        $rw=$qq->fetch();
                                                ?>
                                                    <tr>
                                                            <td><?php echo ++$counter;?></td>
                                                            <td><?php echo $ro['fname']." ".$ro['lname'];?></td>
                                                            <td><?php echo $ro['email'] ?></td>
                                                            <td><?php echo $ro['phone'] ?></td>
                                                            <td><span class="badge badge-primary"><?php echo $rw['job'] ?></span></td>
                                                            <td><?php echo $rr['grade'] ?></td>
                                                            <td>
                                                                <?php
                                                                if($st=='Active'){echo"<span class='badge badge-success'>$st</span>";}
                                                                else{echo"<span class='badge badge-danger'>$st</span>";}
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                                        <div role="menu" class="dropdown-menu">
                                                                            <a class="dropdown-item" href="emp_view?id=<?php echo $id; ?>">View Employee</a>
                                                                            <?php
                                                                            if($role=='HRAdmin'){ echo"
                                                                            <a class='dropdown-item' href='esalary?id= $id'>Set Salary Component</a>
                                                                            <a class='dropdown-item' href='dedC?id=$id'>Set Salary Deductions</a>
                                                                            <a class='dropdown-item' href='edit_emp?id=$id'>Edit Employee</a>
                                                                            <a class='dropdown-item' href='#'>Deactivate</a>";
                                                                            }        
                                                                           ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                    </tr>
                                                    <?php } ?>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Specification</th>
                                                    <th>Grade</th>
                                                    <th class="w-20">Status</th>
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
    <?php
    //Grade distribution
    
    $emp=  dbConnect()->prepare("SELECT distinct  grade.grade FROM employee, grade WHERE employee.grade=grade.id AND employee.branch='$branch'");
    $emp->execute();
    ?>
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
    <script src="../vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
    
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
	
	<!-- EChartJS JavaScript -->
    <script src="../vendors/echarts/dist/echarts-en.min.js"></script>
    <!-- Init JavaScript -->
    <script src="../dist/js/init.js"></script>
<!--	<script src="../dist/js/dashboard2-data.js"></script>-->
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
						
						{value:<?php echo $sal; ?>, name:'Salary'},
						{value:<?php echo $expense; ?>, name:'Expenses'},
                                                {value:<?php echo $benefit; ?>, name:'Benefit'}
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
                                            <?php 
                                            while($ro=$emp->fetch()){
                                            
                                            $grade=$ro['grade'];
                                            //getting grade ID
                                            $grd= dbConnect()->prepare("SELECT id FROM grade WHERE grade='$grade' ");
                                            $grd->execute();
                                            $gr=$grd->fetch();
                                            $grd_id=$gr['id'];
                                            
                                            //counting employees
                                            $empC= dbConnect()->prepare("SELECT count(userID) AS count from employee WHERE grade='$grd_id' ");
                                            $empC-> execute();
                                            $ry=$empC->fetch();
                                            $grad=$ry['count'];
                                            
                                            ?>
                                            {value:<?php echo $grad ?>, name:'<?php echo $grade ?>'},
                                              
                                            <?php } ?>
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
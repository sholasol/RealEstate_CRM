<!--Horizontal Nav-->
<?php 
include 'dash_nav.php';

$dd=date('m');
$dat= date('F');
$yr=date('Y');
                                        
$qq=  dbConnect()->prepare("SELECT distinct(month) AS month, year, count(userID) AS user, sum(basic) AS basic, sum(benefit) AS benefit, sum(deduction) AS deduction, sum(net) AS net FROM emp_pay WHERE branch='$branch' AND year='$yr' AND month='$dd' GROUP BY branch ORDER BY month DESC");
$qq->execute();
$ro=$qq->fetch();

//Sales Period for chart
            $t = " YEAR(created)= YEAR(CURRENT_DATE())" ;
            
             //Current month query
            $query= dbConnect()->prepare("SELECT sum(paid) AS amount, sum(balance) As balance, custID  AS cust, created, code, order_no FROM sorder WHERE branch='$branch' AND YEAR(created)= Year(CURRENT_DATE()) ");
            //Income
            $sq=$query;
            $sq->execute();
            $rb=$sq->fetch();
            $inc = $rb['amount'];
            $bal = $rb['balance'];

            //Purchases
            $pch= dbConnect()->prepare("SELECT sum(total) AS amount FROM porder WHERE branch='$branch' AND YEAR(created)= Year(CURRENT_DATE()) ");
            $pch->execute();
            $pr=$pch->fetch();
            $purchase = $pr['amount'];

            //expense
            $ss = dbConnect()->prepare("Select sum(total) as amount From expense Where branch='$branch' AND YEAR(created)= Year(CURRENT_DATE())");
            $exp=$ss;
            $exp->execute();
            $ra=$exp->fetch();
            $exep = $ra['amount'];

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
                <h2 class="hk-pg-title font-weight-600">Expenses</h2>
            </div>
            <div class="d-flex mb-0 flex-wrap">
               <!-- <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                    <a href="schedule" class="btn btn-outline-secondary">Payment Schedule</a>
                    <a href="emp_sal" class="btn btn-outline-secondary">Employee Salary </a>
                </div>-->
                <?php
                  echo"
                <a href='aexpense' class='btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15'><span class='icon-label'><span class='feather-icon'><i data-feather='plus'></i></span> </span><span class='btn-text'>Create Expense</span></a>";
                 
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
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Expenses</span>
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
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Total Value </span>
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
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Tax Value</span>
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
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">No of Items</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark"><?php echo number_format($ro['benefit']) ;?></span>
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
                                                        <h6>Expense Analysis</h6>
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
            <h4>Expenses  </h4>
    </div>
    <div class="card">
            <div class="card-body pa-0">
                <div class="table-wrap">
                            <div id="table-responsive">
                               <table id="datable_1" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Employee</th>
                                        <th>Item</th>
                                        <th>Type</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <!--<th width="10%">Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        
                                        
                                        //$q=  dbConnect()->prepare("SELECT * FROM emp_pay WHERE month='$dd' AND year='$yr' AND branch='$branch'");
                                        $q=  dbConnect()->prepare("SELECT * FROM expense WHERE branch='$branch'  GROUP BY code");
                                        $q->execute();
                                        $counter =0;
                                        while($ro=$q->fetch()){
                                            $u=$ro['createdby'];
                                            $e_id=$ro['id'];
                                            
                                            $empN = dbConnect()->prepare("SELECT * FROM users WHERE userID='$u'");
                                            $empN->execute();
                                            $x= $empN->fetch();
                                            $custName=$x['fname']." ".$x['lname'];
                                        ?>
                                        <tr>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo $custName; ?></td>
                                                <td> <?php echo $ro['item']; ?></td>
                                                <td> <?php echo $ro['type']; ?></td>
                                                <td><?php echo number_format($ro['qty']); ?></td>
                                                <td><?php echo number_format($ro['amount']); ?></td>
                                                <td><?php echo number_format($ro['total']); ?></td>
                                                <td><span class="badge badge-primary"><?php echo $ro['status']; ?></span></td>
                                                <td><?php echo $ro['created']; ?></td>
                                               <!-- <td>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                            <div role="menu" class="dropdown-menu">
                                                                <a class="dropdown-item" href="notify?pay=<?php echo $e_id; ?>">Approve for Payment </a>
                                                                <a class="dropdown-item" href="notify?id=<?php echo $e_id; ?>">Decline</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>-->
                                        </tr>
                                        <?php } ?>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Employee</th>
                                        <th>Item</th>
                                        <th>Type</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Date</th>
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
    <?php
    //Grade distribution
    
    //$emp=  dbConnect()->prepare("SELECT distinct  grade.grade FROM employee, grade WHERE employee.grade=grade.id AND employee.branch='$branch'");
    $product = dbConnect()->prepare("SELECT type, sum(amount) AS amt FROM `expense` group by type");
    $product->execute(); 
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
						{value:<?php echo $exep; ?>, name:'Expenses'},
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
					color: ['#7a5449', '#a58b84', '#bca9a4','#bc5656','#3f0808', '#666', '#b968c9', '#493df4', '#3bf770', '#0a776e'],
					data:[
                                            <?php 
                                            while($rx=$product->fetch()){
                                            
                                            $type= $rx['type'];
                                            
                                            
                                            $amt=$rx['amt'];
                                            if($amt<1){$amt =0;}
                                            ?>
                                            {value:<?php echo $amt ?>, name:'<?php echo $type ?>'},
                                              
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
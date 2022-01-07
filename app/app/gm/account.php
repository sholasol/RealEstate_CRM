<?php 
include 'dash_nav.php'; 

$qq=  dbConnect()->prepare("SELECT sum(obalance) AS bal, count(id) AS bank FROM bank ");
$qq->execute();
$r=$qq->fetch();
$no=$r['bank'];
$balance = $r['bal'];

/*
$query=  dbConnect()->prepare("SELECT sum(paid) AS amount, sum(balance) As balance FROM sorder WHERE YEAR(created)= Year(CURRENT_DATE()) ");
//Income
$sq=$query;
 $sq->execute();
 $rb=$sq->fetch();
 $inc = $rb['amount'];
 $bal = $rb['balance'];
 */
 
 //Sales Period for chart
            $t = " YEAR(created)= YEAR(CURRENT_DATE())" ;
            
             //Current month query
            $query= dbConnect()->prepare("SELECT sum(paid) AS amount, sum(balance) As balance, custID  AS cust, created, code, order_no FROM sorder WHERE  YEAR(created)= Year(CURRENT_DATE()) ");
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
                        <!--<div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="" class="btn btn-outline-secondary">company</a>
                            <a href="" class="btn btn-outline-secondary">New employee</a>
                        </div>-->
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
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Revenue</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($inc); ?></span>
                                                                            <small></small>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Outstanding </span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($bal); ?></span>
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
                                                        <h6>Product Performance</h6>
                                                </div>
                                                <div class="card-body">

                                                        <div id="e_chart_a" class="echart" style="height:287px;"></div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                                <div class="card">
                                                <div class="card-header card-header-action">
                                                        <h6>Bank Accounts</h6>
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
                            <h4>Accounts</h4>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                    <div class="table-wrap">
                                            <div class="table-responsive">
                                                    <table id="datable_1" class="table table-hover w-100 display pb-30">
                                                            <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>Bank</th>
                                                                        <th>Account No</th>
                                                                        <th>Amount</th>
                                                                        <th>Customer</th>
                                                                        <th>Transactions</th>
                                                                        <th>Date</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT bank.bank, sorder.paid, sorder.item, bank.account, sorder.created, customer.fname, customer.lname FROM bank, sorder, customer WHERE bank.account = sorder.bank AND sorder.custID = customer.custID ORDER BY sorder.id DESC");
                                                                $counter=0;
                                                                $q->execute();
                                                                while($ro=$q->fetch()){
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter;?></td>
                                                                            <td><?php echo $ro['bank']; ?></td>
                                                                            <td><span class="badge badge-light"><?php echo $ro['account']; ?></span></td>
                                                                            <td><span class="badge badge-primary"><?php echo number_format($ro['paid']); ?></span></td>
                                                                            <td><?php echo $ro['fname']." ".$ro['lname']; ?></td>
                                                                            <td><?php echo $ro['item']; ?></td>
                                                                            <td><span class="badge badge-light"><?php echo $ro['created']; ?></span></td>
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
    <?php
    //Grade distribution
    
    //$emp=  dbConnect()->prepare("SELECT distinct  grade.grade FROM employee, grade WHERE employee.grade=grade.id AND employee.branch='$branch'");
    $product = dbConnect()->prepare("SELECT * FROM project WHERE status='Active'");
    $product->execute(); 
    ?>
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
						
				<?php
                                    //Grade distribution

                                    //$emp=  dbConnect()->prepare("SELECT distinct  grade.grade FROM employee, grade WHERE employee.grade=grade.id AND employee.branch='$branch'");
                                    $db = dbConnect()->prepare("SELECT sum(paid) AS paid, bank FROM sorder WHERE YEAR(created)= YEAR(CURRENT_DATE()) GROUP BY bank");
                                    $db->execute(); 

                                    while($ry=$db->fetch()){

                                    $bank= $ry['bank'];
                                    $pad=$ry['paid'];
                                    if($pad<1){$pad =0;}

                                    $acc=  dbConnect()->prepare("SELECT bank FROM bank WHERE account = '$bank'");
                                    $acc->execute();
                                    $rc = $acc->fetch();
                                    $bnk=$rc['bank'];

                                    ?>
                                    {value:<?php echo $pad ?>, name:'<?php echo $bnk ?>'},

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
                                            
                                            $project= $rx['project'];
                                            
                                            $sale=  dbConnect()->prepare("SELECT sum(paid) AS paid, sum(balance) AS bal FROM sorder WHERE item = '$project' AND $t ");
                                            $sale->execute();
                                            $rw = $sale->fetch();
                                            $sl=$rw['paid'];
                                            if($sl<1){$sl =0;}
                                            ?>
                                            {value:<?php echo $sl ?>, name:'<?php echo $project ?>'},
                                              
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


    
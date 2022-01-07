
            
            
             <!--Horizontal Nav-->
<?php 
include 'dash_nav.php';
$d = "2019-06-06";
$dd=date('m');
$dat= date('F');
$yr=date('Y');
                                        
$qq=  dbConnect()->prepare("SELECT distinct(month) AS month, year, count(userID) AS user, sum(basic) AS basic, sum(benefit) AS benefit, sum(deduction) AS deduction, sum(net) AS net FROM emp_pay WHERE branch='$branch' AND year='$yr' AND month='$dd' GROUP BY branch ORDER BY month DESC");
$qq->execute();
$ro=$qq->fetch();

//This is for PHP 7.4 for iteration
//$usr = $ro['user']??="0";

  $usr  = $ro['user'];   
  $net  = $ro['net'];
  $dedc = $ro['deduction'];
  $benf = $ro['benefit'];
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
			<h2 class="hk-pg-title font-weight-600">Salary Grade</h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                        <a href="asalary" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="btn-text"><i class="fa fa-money"></i> New Salary</span></a>
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
                                                        <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($usr) ;?></span>
                                                    </div>
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
                                                                    <span class="display-5 font-weight-400 text-dark">=N=<span class="counter-anim"><?php echo number_format($net) ;?></span></span>
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
                                                                    <span class="display-5 font-weight-400 text-dark">=N= <?php echo number_format($dedc) ;?></span>
                                                                    
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
                                                                    <span class="display-5 font-weight-400 text-dark">=N= <?php echo number_format($benf) ;?></span>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>
            <div class="hk-row">
                    <div class="col-lg-12">
                            <div class="card card-refresh">
                                    <div class="refresh-container">
                                            <div class="loader-pendulums"></div>
                                    </div>
                                    <div class="card-header card-header-action">
                                            <h6>Payroll by Month in <?php echo date('Y')?></h6>
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
                                                            <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Basic Salary</span>
                                                    </div>
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-brown-light-5 rounded-circle d-inline-block"></span><span>Emp Benefit</span>
                                                    </div>
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>Deductions</span>
                                                    </div>
                                            </div>
                                            <div id="area_chart" class="echart" style="height: 194px;"></div>
                                    </div>
                            </div>
                    </div>
            </div>
        <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
            <h4>Recent Payroll</h4><small>Total Monthly Payment</small>
        </div>
    <div class="card">
            <div class="card-body pa-0">
                    <div class="table-wrap">
                            <div class="table-responsive">
                               <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                        <th></th>
                                                        <th width="25%">Employee Name</th>
                                                        <th>Gross Pay</th>
                                                        <th width="25%">Salary Components</th>
                                                        <th width="20%">Deductions</th>
                                                        <th width="20%">Grade</th>
                                                        <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $epp=  dbConnect()->prepare("SELECT userID, grade, job, sum(value) AS sum, count(component) as component FROM emp_salary GROUP BY userID");
                                                    $counter=0;
                                                    $epp->execute();
                                                    while($ro=$epp->fetch()){
                                                        $cm=$ro['component'];
                                                        $jub=$ro['job'];
                                                        $gr=$ro['grade'];
                                                        $id=$ro['userID'];
                                                        $sum=$ro['sum'];
                                                        
                                                        $q1=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$gr'");
                                                        $q1->execute();
                                                        $rr1=$q1->fetch();
                                                        $grad=$rr1['grade'];
                                                        
                                                        /*
                                                        $w=  dbConnect()->prepare("SELECT job FROM job WHERE id='$jub'");
                                                        $w->execute();
                                                        $ru=$w->execute();
                                                        $joob=$w['job'];
                                                        
                                                        */
                                                        
                                                        $q=  dbConnect()->prepare("SELECT fname, lname FROM users WHERE userID='$id'");
                                                        $q->execute();
                                                        $rr=$q->fetch();
                                                        
                                                        $u_name=$rr['fname']." ".$rr['lname'];
                                                ?>
                                                    <tr>
                                                            <td><?php echo ++$counter;?></td>
                                                            <td><?php echo $u_name;?></td>
                                                            <td><?php echo $sum ?></td>
                                                            <td>
                                                                <?php 
                                                                    $q1=  dbConnect()->prepare("SELECT  component FROM salaryComponent WHERE grade='$gr' AND job='$jub'");
                                                                    $q1->execute();
                                                                    while($rr=$q1->fetch()){
                                                                        $cp=$rr['component'];
                                                                        echo "<small>$cp</small>".", ";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    $q1=  dbConnect()->prepare("SELECT  deduction FROM emp_deduction WHERE grade='$gr'");
                                                                    $q1->execute();
                                                                    while($rr=$q1->fetch()){
                                                                        $cp=$rr['deduction'];
                                                                        echo "<small>$cp</small>".", ";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $grad; ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                                        <div role="menu" class="dropdown-menu">
                                                                            <a class="dropdown-item" href="emp_view?id=<?php echo $id; ?>">View Employee</a>
                                                                            <a class="dropdown-item" href="#paySlip?id=<?php echo $id;?>">Pay Slip</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                    </tr>
                                                    <?php } ?>
                                            <tfoot>
                                                <tr>
                                                        <th></th>
                                                        <th width="25%">Employee Name</th>
                                                        <th>Salary</th>
                                                        <th width="25%">Salary Components</th>
                                                        <th width="20%">Deductions</th>
                                                        <th width="20%">Grade</th>
                                                        <th width="5%">Action</th>
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
	
	<!-- EChartJS JavaScript -->
    <script src="../vendors/echarts/dist/echarts-en.min.js"></script>
    <!-- Init JavaScript -->
    <script src="../dist/js/init.js"></script>
    <script>
                    /*Dashboard3 Init*/

            "use strict"; 
            $(document).ready(function() {
                    /*Toaster Alert*/
                    /*
                    $.toast({
                            heading: 'Oh snap!',
                            text: '<p>Change a few things and try submitting again.</p>',
                            position: 'bottom-right',
                            loaderBg:'#7a5449',
                            class: 'jq-toast-danger',
                            hideAfter: 3500, 
                            stack: 6,
                            showHideTransition: 'fade'
                    });
                    */
                    
                   
                    if($('#area_chart').length > 0) {
                            var data=[
                                //Querying Employee Pay table
                                <?Php 
                                $b=  dbConnect()->prepare("SELECT month, sum(basic) AS basic, sum(benefit) AS benefit, sum(deduction) as ded FROM `emp_pay` WHERE YEAR(created)= YEAR(CURRENT_DATE()) group by month");
                                $b->execute();
                                while($rr=$b->fetch()){
                                    $basic =$rr['basic'];
                                    $benefit =$rr['benefit'];
                                    $deduction =$rr['ded'];
                                    $month =$rr['month'];
                                    if($month ==1){$month ="Jan";}
                                    elseif($month ==2){$month ="Feb";}
                                    elseif($month ==3){$month ="Mar";}
                                    elseif($month ==4){$month ="Apr";}
                                    elseif($month ==5){$month ="May";}
                                    elseif($month ==6){$month ="Jun";}
                                    elseif($month ==7){$month ="Jul";}
                                    elseif($month ==8){$month ="Aug";}
                                    elseif($month ==9){$month ="Sep";}
                                    elseif($month ==10){$month ="Oct";}
                                    elseif($month ==11){$month ="Nov";}
                                    elseif($month ==12){$month ="Dec";}
                                ?>
                                {
                                period: '<?php echo $month ?>',
                                basic: <?php echo $basic ?>,
                                benefit: <?php echo $benefit ?>,
                                deduction: <?php echo $deduction ?>
                                }, <?php } ?>
                            ];
                           

                            var lineChart = Morris.Area({
                    element: 'area_chart',
                    data: data ,
                    xkey: 'period',
                    ykeys: ['basic', 'benefit', 'deduction'],
                    labels: ['basic', 'benefit', 'deduction'],
                    pointSize: 2,
                    lineWidth:2,
                            fillOpacity: 0.1,
                            pointStrokeColors:['#7a5449', '#d7cbc8', '#a58b84'],
                            behaveLikeLine: true,
                            grid: false,
                            hideHover: 'auto',
                            lineColors: ['#7a5449', '#d7cbc8', '#a58b84'],
                            resize: true,
                            redraw: true,
                            smooth: true,
                            gridTextColor:'#878787',
                            gridTextFamily:"Poppins",
                    parseTime: false
                });
                    }
                    var data = [],
                    totalPoints = 300;

                    /*Getting Random Data*/
                    function getRandomData() {

                            if (data.length > 0)
                                    data = data.slice(1);

                            // Do a random walk

                            while (data.length < totalPoints) {

                                    var prev = data.length > 0 ? data[data.length - 1] : 50,
                                            y = prev + Math.random() * 10 - 5;

                                    if (y < 0) {
                                            y = 0;
                                    } else if (y > 100) {
                                            y = 100;
                                    }

                                    data.push(y);
                            }

                            // Zip the generated y values with the x values

                            var res = [];
                            for (var i = 0; i < data.length; ++i) {
                                    res.push([i, data[i]])
                            }

                            return res;
                    }

                    

                    
            });
            
            

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
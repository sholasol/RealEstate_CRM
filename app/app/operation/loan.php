

        <!--Horizontal Nav-->
        <?php
        include 'dash_nav.php'; 
        $app =  dbConnect()->prepare("SELECT sum(amount) AS amt FROM `loan` WHERE YEAR(created)= YEAR(CURRENT_DATE())  ");
        $app->execute();
        $ap =$app->fetch();
        $aply =$ap['amt'];
        if($aply < 1){$aply = 0;}
        
        $al =  dbConnect()->prepare("SELECT sum(amount) AS amt FROM `loan` WHERE YEAR(created)= YEAR(CURRENT_DATE()) AND status='Approved'  ");
        $al->execute();
        $ar =$al->fetch();
        $approve =$ar['amt'];
        if($approved < 1){$approved = 0;}

        $dl =  dbConnect()->prepare("SELECT sum(amount) AS amt FROM `loan` WHERE YEAR(created)= YEAR(CURRENT_DATE()) AND status='Declined' ");
        $dl->execute();
        $dr =$dl->fetch();
        $decline =$dr['amt'];
        if($decline < 1){$decline = 0;}
        
        //Not Paid
        $pd =  dbConnect()->prepare("SELECT count(id) AS count FROM `loan` WHERE YEAR(created)= YEAR(CURRENT_DATE()) AND status !='Paid' ");
        $pd->execute();
        $pr =$pd->fetch();
        $count = $pr['count'];
        if($count < 1){$count = 0;}
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
			<h2 class="hk-pg-title font-weight-600">Loans </h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                        <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="loanR" class="btn btn-outline-secondary">Request Loan</a>
                        </div>
                     <!--   <a href="aloan" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15">
                            <span class="icon-label"><span class="feather-icon">
                            <i data-feather="plus"></i></span> </span><span class="btn-text">Create Loan</span>
                        </a>-->
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
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">All Loans till Date</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($aply); ?></span>
                                                            </div>
                                                            
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <a href="aloan">  <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Existing Loan</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><span class="counter-anim"><?php echo number_format($approve); ?></span></span>
                                                                    </span>
                                                            </div>
                                                            
                                                    </div>
                                            </div>
                                    </div></a>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <a href="ploan">  <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Declined Loan</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><span class="counter-anim"><?php echo number_format($decline); ?></span></span>
                                                                    </span>
                                                            </div>
                                                            
                                                    </div>
                                            </div>
                                    </div></a>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <a href="ploan">   <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Outstanding Loan Payment</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($count); ?></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div></a>
                            </div>
                    </div>
                        
                     
                   <div class="hk-row">
                    <div class="col-lg-12">
                            <div class="card card-refresh">
                                    <div class="refresh-container">
                                            <div class="loader-pendulums"></div>
                                    </div>
                                    <div class="card-header card-header-action">
                                        <h6>Loan Record  in <?php echo date('Y')?></h6>
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
                                                            <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Applied</span>
                                                    </div>
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-brown-light-5 rounded-circle d-inline-block"></span><span>Approved</span>
                                                    </div>
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>Declined</span>
                                                    </div>
                                            </div>
                                            <div id="area_chart2" class="echart" style="height: 194px;"></div>
                                    </div>
                            </div>
                    </div>
            </div>
                        
                    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
                            <h4>Loan</h4>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Employee</th>
                                                    <th>Loan Amount</th>
                                                    <th>Tenor</th>
                                                    <th>Purpose</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $s=dbConnect()->prepare("SELECT * FROM loan WHERE userID='$user_id' ");
                                                $counter=0;
                                                $s->execute();
                                                while($r=$s->fetch()){
                                                    $id=$r['userID'];
                                                    $sts=$r['status'];
                                                    
                                                    $us = dbConnect()->prepare("SELECT * FROM users WHERE userID='$id'");
                                                    $us->execute();
                                                    $ur=$us->fetch();
                                                    $nm=$ur['fname']." ".$ur['lname'];
                                                ?>
                                                    <tr>
                                                            <td><?php echo ++$counter; ?></td>
                                                            <td><?php echo $nm ;?></td>
                                                            <td><span class="badge badge-primary"><?php echo number_format($r['amount']) ;?></span></td>
                                                            <td><?php echo $r['term']." month(s)" ;?></td>
                                                            <td><?php echo $r['purpose'] ;?></td>
                                                            <td>
                                                                <?php 
                                                                if($sts =="Active"){echo"<span class='badge badge-warning'>Pending</span>";}
                                                                elseif($sts =="Approved"){echo"<span class='badge badge-success'>Approved</span>";}
                                                                elseif($sts =="Declined"){echo"<span class='badge badge-danger'>Declined</span>";}
                                                                ?>
                                                            </td>
                                                            <td>
                                                                 <div class="btn-group">
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                                        <div role="menu" class="dropdown-menu">
                                                                            <a class="dropdown-item" href="emp_view?id=<?php echo $id; ?>">View Employee</a>
                                                                            <?php
                                                                            if($role=='Admin'){ echo"
                                                                            <a class='dropdown-item' href='#esalary?id= $id'>Approve</a>
                                                                            <a class='dropdown-item' href='#dedC?id=$id'>Declines</a>";
                                                                            }        
                                                                           ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                    </tr>
                                                <?php }?>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>Employee</th>
                                                    <th>Loan Amount</th>
                                                    <th>Tenor</th>
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
    <?php
    //Grade distribution
    
    //$emp=  dbConnect()->prepare("SELECT distinct  grade.grade FROM employee, grade WHERE employee.grade=grade.id AND employee.branch='$branch'");
    $product = dbConnect()->prepare("SELECT * FROM project WHERE status='Active'");
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
                    
                   
                    if($('#area_chart2').length > 0) {
                            var data=[
                                //Querying sorder table
                                <?Php 
                                $b=  dbConnect()->prepare("SELECT month, sum(amount) AS amt FROM `loan` WHERE YEAR(created)= YEAR(CURRENT_DATE())  GROUP BY month");
                                $b->execute();
                                while($rr=$b->fetch()){
                                    $month =$rr['month'];
                                    $apply =$rr['amt'];
                                    if($apply < 1){$apply = 0;}
                                    $b1 =  dbConnect()->prepare("SELECT sum(amount) AS amt FROM `loan` WHERE YEAR(created)= YEAR(CURRENT_DATE()) AND status='Approved' AND month='$month'  ");
                                    $b1->execute();
                                    $br =$b1->fetch();
                                    $approved =$br['amt'];
                                    if($approved < 1){$approved = 0;}
                                    
                                    $b2 =  dbConnect()->prepare("SELECT sum(amount) AS amt FROM `loan` WHERE YEAR(created)= YEAR(CURRENT_DATE()) AND status='Declined' AND month='$month'");
                                    $b2->execute();
                                    $bo =$b2->fetch();
                                    $declined =$bo['amt'];
                                    if($declined < 1){$declined = 0;}
                                    
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
                                Applied: <?php  echo $apply ?>,
                                Approved: <?php echo $approved ?>,
                                Declined: <?php echo $declined ?>
                                }, <?php } ?>
                            ];
                           

                            var lineChart = Morris.Area({
                    element: 'area_chart2',
                    data: data ,
                    xkey: 'period',
                    ykeys: ['Applied', 'Approved', 'Declined'],
                    labels: ['Applied', 'Approved', 'Declined'],
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
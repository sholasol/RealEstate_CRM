<!--Horizontal Nav-->
<?php 
include 'dash_nav.php';

$dd=date('m');
$dat= date('F');
$yr=date('Y');
                                        
$qq=  dbConnect()->prepare("SELECT sum(tax_value) AS tax, sum(total) AS tot, count(distinct(order_no)) AS po FROM porder GROUP by code");
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
                <h2 class="hk-pg-title font-weight-600">Purchase Order</h2>
            </div>
            <div class="d-flex mb-0 flex-wrap">
               <!-- <div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                    <a href="schedule" class="btn btn-outline-secondary">Payment Schedule</a>
                    <a href="emp_sal" class="btn btn-outline-secondary">Employee Salary </a>
                </div>-->
                <?php
                  echo"
                <a href='aporder' class='btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15'><span class='icon-label'><span class='feather-icon'><i data-feather='plus'></i></span> </span><span class='btn-text'>New Purchase Order</span></a>";
                 
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
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Purchase Order</span>
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                    <div>
                                                        <span class="d-block display-5 font-weight-400 text-dark"><?php echo $ro['po'] ;?></span>
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
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Tax Value</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark">=N= <?php echo number_format($ro['tax'], $decimal=2) ;?></span>
                                                                    
                                                            </span>
                                                    </div>
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
                                                                    <span class="display-5 font-weight-400 text-dark">=N=<span class="counter-anim"><?php echo number_format($ro['tot'], $decimal=2) ;?></span></span>
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
                                                                    <span class="display-5 font-weight-400 text-dark"><?php echo 1 ;?></span>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>
            
            <!--<div class="hk-row">
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
            </div>-->
    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
            <h4>Purchase Order</h4>
    </div>
    <div class="card">
            <div class="card-body pa-0">
                <div class="table-wrap">
                            <div id="table-responsive">
                               <table id="datable_1" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Vendor</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Created</th>
                                        <!--<th width="10%">Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        
                                        
                                        //$q=  dbConnect()->prepare("SELECT * FROM emp_pay WHERE month='$dd' AND year='$yr' AND branch='$branch'");
                                        $q=  dbConnect()->prepare("SELECT sum(amount) AS amount, sum(total) AS total, venID  AS cust, created, code, order_no FROM porder WHERE branch='$branch' GROUP BY code ORDER BY id DESC");
                                        $q->execute();
                                        $counter =0;
                                        while($ro=$q->fetch()){
                                            $u=$ro['cust'];
                                            $cd=$ro['code'];
                                            $order=$ro['order_no'];
                                            
                                            $empN = dbConnect()->prepare("SELECT * FROM vendor WHERE id='$u'");
                                            $empN->execute();
                                            $x= $empN->fetch();
                                            $custName=$x['fname']." ".$x['lname'];
                                        ?>
                                        <tr>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo $custName; ?></td>
                                                <td>
                                                    <?php 
                                                    $it=  dbConnect()->prepare("SELECT item FROM porder WHERE code ='$cd'");
                                                    $it->execute();
                                                    while($r=$it->fetch()){
                                                        $itm=$r['item'];
                                                        echo "<span class='badge badge-primary'>$itm</span> | ";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo number_format($ro['total'], $decimal=2); ?></td>
                                                <td><?php echo $ro['created']; ?></td>
                                                <!--<td>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="book"></i></span> <span class="caret"></span></button>
                                                            <div role="menu" class="dropdown-menu">
                                                                <a class="dropdown-item" href="porder_view?order=<?php echo $order; ?>">View Purchase Order</a>
                                                                <?php 
                                                                $ch=  dbConnect()->prepare("SELECT count(id) AS id FROM pinvoice WHERE order_no='$order'");
                                                                $ch->execute();
                                                                $rr = $ch->fetch();
                                                                $no=$rr['id'];
                                                                
                                                                if($no > 0){
                                                                    echo "<a class='dropdown-item' href='purInv_view?order=$order'>View Invoice</a>";
                                                                }else{
                                                                    echo "<a class='dropdown-item' href='purInv?order=$order'>Create Invoice</a>";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>-->
                                        </tr>
                                        <?php } ?>
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
    
</body>

</html>
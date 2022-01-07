<?php 
include 'nav.php';

$ord=$_GET['order'];

$q1=  dbConnect()->prepare("SELECT * FROM sorder WHERE order_no='$ord'");
$q1->execute();
$ro=$q1->fetch();

$itm=$ro['item'];
$qty = $ro['qty'];
$date = $ro['created'];
$cust=$ro['custID'];
$baln = $ro['balance'];
if($baln > 0){$stm="Part of Payment";}else{$stm="Full Payment";}


$q= dbConnect()->prepare("SELECT fname, lname, address, phone, state, gender FROM customer WHERE custID='$cust'");
$q->execute();
$r=$q->fetch();

$gnd=$r['gender'];
if($gnd=='Male'){$salute=" Mr"; $salu=" Sir";}else{$salute=" Mrs"; $salu=" Ma";}

$q2=  dbConnect()->prepare("SELECT * FROM company");
$q2->execute();
$rw=$q2->fetch();

$q3=  dbConnect()->prepare("SELECT * FROM project WHERE project='$itm'");
$q3->execute();
$row=$q3->fetch();

$projAddress = $row['address'];
$project = $row['project'];
$id = $row['id'];

$amot= $ro['paid'];




include 'num.php';
?>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="sorder">Sales Order</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Acknowledgement</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header mb-10">
                    <div>
                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="book"></i></span></span>Letter of Acknowledgement</h4>
                    </div>
		   <div class="d-flex">
                        <a href="#" onclick="printContent('print')" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="printer"></i></span></a>
                    </div>
                </div>
                <!-- /Title -->
                
                
                <!-- Row -->
                <div class="row" id="print">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            
                            <div class="invoice-details">
                                <div class="offset-col-md-4">
                                    <span class="float-right"><?php echo  $date; ?></span> <br><br>
                                    <span>CLIENT NAME: </span> <?php echo $salute." ". $r['fname']." ".$r['lname']; ?>	<br><br><br><br>
                                    

                                </div>
                                <div align="justify">
                                    <?php echo $salu;?>,<br><br>
                                    <span class="text-center">LETTER OF ACKNOWLEDGEMENT</span><br><br>

                                    This is to acknowledge the receipt of your payment of <?php echo number_format($ro['paid']); ?> (<?php echo $figure; ?> Naira Only) as <?php echo $stm;?> for 
                                        <?php echo $ro['qty']; ?> plot(s) of land measuring 600sqm per Plot 
                                    in <?php echo $ro['item']; ?>, situated at <?php echo $projAddress; ?>. This excludes fees of Deed of Assignment, Survey and Development levy.

                                    The breakdown of the amount paid as follows;<br><br>
                                    <div class="table-responsive">
                                        <table  class="table table-hover w-100 display pb-30">
                                            <tr>
                                                <td width="80%">*	The exact amount for <?php echo $ro['qty']; ?> Plot(s) of land (measuring 600sqm per Plot)</td>
                                                <td width="20%">₦<?php echo number_format($ro['amount']); ?></td>
                                            </tr>
                                            <tr>
                                                <td width="80%">*	Amount paid</td>
                                                <td width="20%">₦<?php echo number_format($ro['paid']); ?></td>
                                            </tr>
                                        </table>
                                    </div><br><br><br><br>
                                    
                                    
                                    
                                    <h4 align="center">STATUTORY FEES</h4><br>
                                    <div class="table-responsive">
                                      <table  class="table table-hover w-100 display pb-30">
                                        <?php 
                                        $q=  dbConnect()->prepare("SELECT statutorypay.product, statutorypay.amount, statutorypay.created, fees.fee FROM statutorypay, fees WHERE statutorypay.fee=fees.id AND statutorypay.custID=:cust AND statutorypay.product=:prd");
                                        $q->bindParam(':cust', $cust);
                                        $q->bindParam(':prd', $itm);
                                        $q->execute();
                                        $counter =0;
                                        while($rx=$q->fetch()){
                                            $gr=$rx['fee'];
                                        ?>
                                        
                                        <tr>
                                                <td width="80%"><?php echo $rx['fee']; ?></td>
                                                <td width="20%">₦<?php echo number_format($rx['amount']); ?></td>
                                        </tr>
                                        
                                        <?php } ?>
                                    </table>
                                    </div>
                                    <br>
                                    
                                    <p><span>*</span>Total payment for the property should be completed not later than 2 (two) months effective from initial payment date.</p> <br>          
                                    <p>Kindly ensure you go through the “frequently asked questions” for more details on this estate scheme, we would be in contact with you regarding progress report on the estate.</p><br>
                                    <p>Thank you for subscribing to Pinnacle Horizon Homes, a development by Prime Pinnacle Business Investment Limited.</p> <br>




                                    Best Regards<br><br> <br> <br> <br>


                                   
                                    DIRECTOR OF OPERATIONS
                                </div><br>
                            </div>
                        </section>
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
   <script src="../vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>

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
	
	<!-- EChartJS JavaScript -->
    <script src="../vendors/echarts/dist/echarts-en.min.js"></script>
    
	<!-- Sparkline JavaScript -->
    <script src="../vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Vector Maps JavaScript -->
    <script src="../vendors/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="../vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../dist/js/vectormap-data.js"></script>
    
    <!-- Form Wizard JavaScript -->
    <script src="../vendors/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="../dist/js/form-wizard-data.js"></script>
    <!-- Select2 JavaScript -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="../dist/js/select2-data.js"></script>
	<!-- Owl JavaScript -->
    <script src="../vendors/owl.carousel/dist/owl.carousel.min.js"></script>
    
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
	<!-- Toastr JS -->
<!--    <script src="vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>-->
    
    <!-- Init JavaScript -->
    <script src="../dist/js/init.js"></script>
    <script src="../dist/js/dashboard-data.js"></script>
    <script src="../dist/js/validation-data.js"></script>
    <!-- Daterangepicker JavaScript -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/daterangepicker/daterangepicker.js"></script>
    <script src="../dist/js/daterangepicker-data.js"></script>
    <script>
        function printContent(el){
                var restorepage = document.body.innerHTML;
                var printcontent = document.getElementById(el).innerHTML;
                document.body.innerHTML = printcontent;
                window.print();
                document.body.innerHTML = restorepage;
            }
</script>
</body>

</html>



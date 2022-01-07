<?php 
include 'nav.php';

$ord=$_GET['order'];

$q1=  dbConnect()->prepare("SELECT * FROM sorder WHERE order_no='$ord'");
$q1->execute();
$ro=$q1->fetch();
$item = $ro['item'];
$amount_due = $ro['amount'];
$balance_due = $ro['balance'];

$cus =$ro['custID'];
$q= dbConnect()->prepare("SELECT fname, lname, address, phone, state FROM customer WHERE custID='$cus'");
$q->execute();
$r=$q->fetch();

$qq=  dbConnect()->prepare("SELECT * FROM company");
$qq->execute();
$rr=$qq->fetch();
?>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="sorder">Sale Orders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Receipt</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header mb-10">
                    <div>
                        <a href="saleInv?order=<?php echo $ord; ?>" title="View Contact of Sale"> <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="book"></i></span></span>View Contract of Sale</h4></a>
                    </div>
		   <div class="d-flex">
                        <a href="#" class="text-secondary mr-15" id="print" onclick="printContent('dvContents');"><span class="feather-icon"><i data-feather="printer"></i></span></a>
                    </div>
                </div>
                <!-- /Title -->
                
                
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12" id="dvContents">
                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            <div class="invoice-from-wrap">
                                <div class="row">
                                    <div class="col-md-7 mb-20">
                                        <img class="img-fluid invoice-brand-img d-block mb-20" src="<?php echo $rr['logo']; ?>" alt="brand" />
                                        <h6 class="mb-5">Silver Pacific Homes</h6>
                                        <address>
                                                <span class="d-block">1st Floor Alpha Hydrocarbon</span>
                                                <span class="d-block">Fuel Station, Abijo Lekki Lagos.</span>
                                                <span class="d-block">info@silverpacifichomes.com</span>
                                        </address>
                                    </div>
                                    <div class="col-md-5 mb-20">
<!--                                        <h4 class="mb-35 font-weight-600">Invoice / Receipt</h4>-->
                                        <span class="d-block">Transaction Date:<span class="pl-10 text-dark"><?php echo $ro['created']; ?></span></span>
                                        <span class="d-block">Invoice:<span class="pl-10 text-dark"><?php echo $ord; ?></span></span>
                                        <span class="d-block">Customer:<span class="pl-10 text-dark"><?php echo $r['fname']." ".$r['lname']; ?></span></span>
                                        <span class="d-block">Phone:<span class="pl-10 text-dark"><?php echo $r['phone']; ?></span></span>
                                        <span class="d-block">Address:<span class="pl-10 text-dark"><?php echo $r['address']; ?></span></span>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <h5>Sales Information</h5>
                            <hr>
                            <div class="invoice-details">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-border mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="w-50">Product</th>
                                                    <th class="text-right">Plots</th>
                                                    <th class="text-right" width='15%'>Date</th>
                                                    <th class="text-right"> Due</th>
                                                    <th class="text-right">Paid</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                   $py = 0;
                                                   $qx=  dbConnect()->prepare("SELECT * FROM payment WHERE custID='$cus' AND order_no='$ord'"); 
                                                   $qx->execute();
                                                   while($rx=$qx->fetch()){
                                                   $py += $rx['amount'];   
                                                   //$bal = $amt - $py;
                                                ?>
                                                <tr>
                                                    <td class="w-70"><?php echo $ro['item']; ?></td>
                                                    <td class="text-right"><?php echo $ro['qty']; ?></td>
                                                    <td class="text-right"><?php echo $rx['datepaid']; ?></td>
                                                    <td class="text-right"><?php echo number_format($amount_due); ?></td>
                                                    <td class="text-right"><?php echo number_format($rx['amount']); ?></td>
                                                </tr>
                                                 <?php } ?>
                                                
                                                <tr class="bg-transparent">
                                                    <td colspan="4" class="text-right text-light">Subtotals</td>
                                                    <td class="text-right"><?php echo number_format($ro['amount']); ?></td>
                                                </tr>
                                                <tr class="bg-transparent">
                                                    <td colspan="4" class="text-right text-light border-top-0">Paid</td>
                                                    <td class="text-right border-top-0"><?php echo number_format($ro['paid']); ?></td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="border-bottom border-1">
                                                <tr>
                                                    <?php 
                                                    $bal =$ro['balance'];  
                                                    ?>
                                                    <th colspan="4" class="text-right font-weight-600">Balance</th>
                                                    <th class="text-right font-weight-600"><?php echo number_format($bal); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    
                                    <br><br>
                                        <label class="btn btn-block" style="background-color: #21b7f2;"><span style="color:#fff;">Statutory Fees</span></label>
                                        <table class="table table-striped table-border mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="w-40"></th>
                                                    <th class="w-30">Amount</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $stat = dbConnect()->prepare("SELECT * FROM statutorypay WHERE custID='$cus' AND product='$item' AND fee=1 ");
                                            $stat->execute();
                                            $st = $stat->fetch();
                                            $fee = $st['fee'];
                                            $statutoryFee = $st['amount'];
                                            
                                            $stats = dbConnect()->prepare("SELECT * FROM statutorypay WHERE custID='$cus' AND product='$item' AND fee=2 ");
                                            $stats->execute();
                                            $sts = $stats->fetch();
                                            $fees = $sts['fee'];
                                            $statutoryFees = $sts['amount'];
                                            
                                            
                                            $statx = dbConnect()->prepare("SELECT * FROM statutorypay WHERE custID='$cus' AND product='$item' AND fee=3 ");
                                            $statx->execute();
                                            $stx = $statx->fetch();
                                            $feex = $stx['fee'];
                                            $statutoryFeex = $stx['amount'];
                                            ?>
                                            <tbody>
                                                <tr>
                                                    <td>Development Fee</td>
                                                    <td><?php echo number_format($statutoryFeex); ?></td>
                                                    <td><?php echo $stx['created'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Deed of Assignment</td>
                                                    <td><?php echo number_format($statutoryFee); ?></td>
                                                    <td><?php echo $st['created'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Survey Fee</td>
                                                    <td><?php echo number_format($statutoryFees); ?></td>
                                                    <td><?php echo $sts['created'];?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                                <div class="invoice-sign-wrap text-right py-60">
                                    <img class="img-fluid d-inline-block" src="dist/img/signature.png" alt="sign" />
                                    <span class="d-block text-light font-14">MD Silver Pacific Homes</span>
                                </div>
                            </div>
                            <hr>
                            <ul class="invoice-terms-wrap font-14 list-ul">
                                <li>A buyer must settle his or her account within 30 days of the date listed on the invoice.</li>
                                <li>The conditions under which a seller will complete a sale. Typically, these terms specify the period allowed to a buyer to pay off the amount due.</li>
                            </ul>
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
   <script src="vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>

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
	
	<!-- EChartJS JavaScript -->
    <script src="vendors/echarts/dist/echarts-en.min.js"></script>
    
	<!-- Sparkline JavaScript -->
    <script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Vector Maps JavaScript -->
    <script src="vendors/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/vectormap-data.js"></script>
    
    <!-- Form Wizard JavaScript -->
    <script src="vendors/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="dist/js/form-wizard-data.js"></script>
    <!-- Select2 JavaScript -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="dist/js/select2-data.js"></script>
	<!-- Owl JavaScript -->
    <script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>
    
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
	<!-- Toastr JS -->
<!--    <script src="vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>-->
    
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
    <script src="dist/js/dashboard-data.js"></script>
    <script src="dist/js/validation-data.js"></script>
    <!-- Daterangepicker JavaScript -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/daterangepicker/daterangepicker.js"></script>
    <script src="dist/js/daterangepicker-data.js"></script>
    <script>
        function printContent(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
        }
        </script>
    <script>
            //Add Input Fields
            $(document).ready(function() {
                var max_fields = 50; //Maximum allowed input fields 
                var cont    = $(".cont"); //Input fields wrapper
                var add_button = $(".add_fields"); //Add button class or ID
                var x = 1; //Initial input field is set to 1
                var y =max_fields + 1;

                    //When user click on add input button
                    $(add_button).click(function(e){
                    e.preventDefault();
                    //Check maximum allowed input fields
                    if(x < max_fields){ 
                        x++; //input field increment
                                     //add input field
                        $(cont).append('<div class="cont"><br>\n\
                           <div class="row"> \n\
                                <div class="col-md-3"><select type="text" name="item[]" class="form-control select2" name="item[]"><option value="">Select Property</option> <?php $jb=  dbConnect()->prepare("SELECT * FROM project"); $jb->execute(); while($r=$jb->fetch()){ $N=$r['project']; echo "<option>$N</option>";} ?> </select></div> &nbsp;&nbsp;&nbsp; \n\
                                <input type="number" name="qty[]" class="form-control col-md-2" placeholder="No. of Plots" />&nbsp;&nbsp;&nbsp; \n\
                                <input type="number" name="cost[]" class="form-control col-md-2" placeholder="Unit Cost"/>&nbsp;&nbsp;&nbsp;\n\
                                <input type="number" name="tax[]" class="form-control col-md-2" placeholder="7.5% VAT"/>&nbsp;&nbsp;&nbsp;\n\
                                <input type="number" name="total[]" class="form-control col-md-2" autofocus=" " placeholder="Total" />\n\
                           </div><a href="javascript:void(0);" class="remove_field pull-right" style="color: red;"><i class="icon-trash"> Remove</i></a> \n\
                            \n\
                        </div>');
    
    
                    }
                    
                });

                //when user click on remove button
                $(cont).on("click",".remove_field", function(e){ 
                    e.preventDefault();
                            $(this).parent('div').remove(); //remove inout field
                            x--; //inout field decrement
                })
            });
            </script>
            <script type="text/javascript">
            $(document).ready(function(){

            $("#customer").change(function(){
                var custid = $(this).val();

                $.ajax({
                    url: 'getAddress.php',
                    type: 'post',
                    data: {cust:custid},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $("#address").empty();
                        for( var i = 0; i<len; i++){
                            var address = response[i]['address'];
                            $("#address").val(address);

                           // $("#address").append("<option value='"+id+"'>"+address+"</option>");

                        }
                    }
                });
            });

        });
    </script>
    <script>
      $('#mytable').on('input', function (event) {
        var elem = $(event.target);
        var parent = elem.parent(); // <-- <tr>
        var qtty = parent.find('input[name="qty[]"]');
        var uprice = parent.find('input[name="cost[]"]');
        var tax = parent.find('input[name="tax[]"]');
        if(tax.val() ===''){
           tax = 0; 
        }
        var price = parent.find('input[name="total[]"]');

        // leaving validation out for brevity
        price.val(parseFloat(qtty.val()) * parseFloat(uprice.val()));
      });
   </script>
   <script>
       /*
      $('#mytable').on('input', function (event) {
        var elem = $(event.target);
        var parent = elem.parent(); // <-- <tr>
        var qtty = parent.find('input[name="qty[]"]');
        var uprice = parent.find('input[name="cost[]"]');
        var tax = parent.find('input[name="tax[]"]');
        if(tax.val() ===''){
           tax = 0; 
        }
        var price = parent.find('input[name="total[]"]');

        // leaving validation out for brevity
        
        if(qtty.val() !=='' && uprice.val() !=='' && uprice.val() !=='' && tax.val() !==''){
            price.val((parseFloat(qtty.val()) * parseFloat(uprice.val())) + parseFloat(tax.val())); 
        }
        if(qtty.val() !=='' && uprice.val() !=='' && uprice.val() !=='' && tax.val() ===0){
            price.val((parseFloat(qtty.val()) * parseFloat(uprice.val())) + parseFloat(tax.val())); 
        }
      });
      
      */
   </script>
</body>

</html>



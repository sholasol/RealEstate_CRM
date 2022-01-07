<?php 
include 'nav.php'; 
if(isset($_GET['order'])){
    $order = $_GET['order'];
}

$jb=  dbConnect()->prepare("SELECT * FROM sorder WHERE order_no='$order'");
$jb->execute();
$jj=$jb->fetch();
$cid = $jj['custID'];
$slp = $jj['salesperson'];
$created = $jj['created'];

$j=  dbConnect()->prepare("SELECT * FROM customer WHERE custID='$cid'");
$j->execute();
$jr=$j->fetch();
$custo = $jr['fname']." ".$jr['lname'];
$addr = $jr['address'];


$p=  dbConnect()->prepare("SELECT fname, lname FROM users WHERE userID='$slp'");
$p->execute();
$pr=$p->fetch();
$saleP = $pr['fname']." ".$pr['lname'];
?>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="sreceipt">Sale Receipt</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Receipt</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header mb-10">
                    <div>
                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="book"></i></span></span>Sales Receipt</h4>
                    </div>
		   <div class="d-flex">
                        <a href="#" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="printer"></i></span></a>
                        <a href="#" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="download"></i></span></a>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            <div class="invoice-from-wrap">
                                <div class="row">
                                    <div class="col-md-4 mb-20">
                                        <div class="col-md-12 mb-10">
                                            <label for="validationCustom01">Customer </label>
                                            <select class="form-control select2" name="customer" id="customer" disabled>
                                                <option><?php echo $custo ?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-10">
                                            <textarea class="form-control" name="address" disabled><?php echo $addr; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-20"></div>
                                    <div class="col-md-4 mb-20"><br>
                                        <div class="col-md-12 mb-10">
                                            <input type="text" class="form-control" id="validationCustom01" name="invoice" value="<?php echo $order; ?>" disabled>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                        <div class="col-md-12 mb-10">
                                            <input type="date" class="form-control" id="validationCustom02" value="<?php echo $created; ?>" name="date"  disabled>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                       <div class="col-md-12 mb-10">
                                            <select class="form-control select2" name="person" disabled>
                                                <option><?php echo $saleP; ?></option>
                                            </select>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br/><br/><br/>
                              
                            <h5>Items</h5>
                            <hr>
                            <div class="invoice-details">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-border mb-0">
                                            <thead>
                                                <tr>
                                                    <th width="5%">S/N</th>
                                                    <th class="">Items</th>
                                                    <th class="text-right">Qty</th>
                                                    <th class="text-right">Unit Cost</th>
                                                    <th class="text-right">Amount</th>
                                                    <th class="text-right">Tax</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $tt =0;
                                                    $ta = 0;
                                                    $am = 0;
                                                    $jbb=  dbConnect()->prepare("SELECT * FROM sinvoice WHERE order_no='$order'");
                                                    $counter = 0;
                                                    $jbb->execute();
                                                    while($b=$jbb->fetch()){
                                                        $amt =$b['amount'];
                                                        $t=$b['total'];
                                                        $txv=$b['tax_value'];
                                                        $tt +=$t;
                                                        $ta +=$txv;
                                                        $am +=$amt;
                                                ?>
                                                <tr>
                                                    <td class="text-right"><?php echo ++$counter; ?></td>
                                                    <td class="w-30"><?php echo $b['item']; ?></td>
                                                    <td class="text-right"><?php echo $b['qty']; ?></td>
                                                    <td class="text-right"><?php echo number_format($b['price']); ?></td>
                                                    <td class="text-right"><?php echo number_format($b['amount']); ?></td>
                                                    <td class="text-right"><?php echo number_format($b['tax_value'], $decimal = 2); ?></td>
                                                    <td class="text-right"><?php echo number_format($b['total'], $decimal = 2); ?></td>
                                                </tr>
                                                    <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                         <table class="table table-striped table-border mb-0">
                                            <tbody>
                                                <tr class="bg-transparent">
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right text-light">Subtotals</td>
                                                    <td class="text-right">=N= <?php echo number_format($am); ?></td>
                                                </tr>
                                                <tr class="bg-transparent">
                                                    <td colspan="4" class="text-right text-light border-top-0">Tax</td>
                                                    <td class="text-right border-top-0">=N= <?php echo number_format($ta, $decimal = 2); ?></td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="border-bottom border-1">
                                                <tr>
                                                    <th colspan="4" class="text-right font-weight-600">total</th>
                                                    <th class="text-right font-weight-600">=N= <?php echo number_format($tt, $decimal = 2); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table><br/>
                                    </div>
                                </div>
                            </div><br/><br/>
                        </section>
                    </div>
                </div>
                <!-- /Row -->
                <!-- /Form -->
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
            //Add Input Fields
            $(document).ready(function() {
                var max_fields = 50; //Maximum allowed input fields 
                var wrapper    = $(".wrapper"); //Input fields wrapper
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
                        $(wrapper).append('<div><br>\n\
                           <div class="wrapper"> \n\
                           <div class="row"> \n\
                           <div class="col-md-3 mb-10 text-right"> <input type="text" class="form-control" id="validationCustom01" name="item[]" placeholder="Item name" required>  <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>  </div> \n\
                            <div class="col-md-3 mb-10 text-right"> <input type="text" class="form-control q" id="validationCustom01" name="qty[]" placeholder="Quantity" required>  <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>  </div>\n\
                            <div class="col-md-3 mb-10 text-right"> <input type="text" class="form-control c" id="validationCustom01" name="cost[]" placeholder="Unit Cost" required>  <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>  </div>\n\
                            <div class="col-md-3 mb-10 text-right"> <input type="text" class="form-control tot" id="validationCustom01" name="total[]" placeholder="Total" required>  <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>  </div>\n\
                            </div></div><a href="javascript:void(0);" class="remove_field pull-right" style="color: red;"><i class="icon-trash"> Remove</i></a> \n\
\n\
                        </div>');
    
                    }
                    
                });

                //when user click on remove button
                $(wrapper).on("click",".remove_field", function(e){ 
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
        
        $('.q,.c').keyup(function(){
            var textValue1 =$(this).parent().find('.q').val();
            var textValue2 = $(this).parent().find('.c').val();

            $(this).parent().find('.tot').val(textValue1 * textValue2); 
            
            var sum = 0;
            $(".tot").each(function() {
              sum += +$(this).val();
            });

             $("#sum").val(sum);
          });
        
        /*
        function calculateTotal() {
            var qty = $('input[name=qty]').val(),
                cost = $('input[name=cost]').val(),
                calcTotal = ( (qty * cost) ),
                total = calcTotal.toFixed(2);
            $('input[name=\'total\']').val(total);
        }
        */
   </script>
</body>

</html>
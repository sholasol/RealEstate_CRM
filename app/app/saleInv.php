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
$code= $jj['code'];


$j=  dbConnect()->prepare("SELECT * FROM customer WHERE custID='$cid'");
$j->execute();
$jr=$j->fetch();
$custo = $jr['fname']." ".$jr['lname'];
$addr = $jr['address'];


$p=  dbConnect()->prepare("SELECT fname, lname FROM users WHERE userID='$slp'");
$p->execute();
$pr=$p->fetch();
$saleP = $pr['fname']." ".$pr['lname'];
if(isset($_POST['save'])){
        if(empty($_POST['item'])){
        $e="Item name is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['qty'])){
        $e="Quantity is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['cost'])){
        $e="Unit Cost is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['total'])){
        $e="Total Amount is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['customer'])){
        $e="Please select a customer!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['address'])){
        $e="Customer address is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['invoice'])){
        $e="Invoice number is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['date'])){
        $e="Please select a transaction date!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['person'])){
        $e="Please select a sales person!"; 
        echo  " <script>alert('$e'); ";
	}
        
        else{
           $cust = check_input($_POST["customer"]);
           $invoice = check_input($_POST["invoice"]);
           $dt = check_input($_POST["date"]);
           $add = check_input($_POST["address"]);
           $person = check_input($_POST["person"]);
           
            $by = $uid;
            $bran= $branch;
           
           foreach ($_POST['item'] as $item => $value){
               $itmm= $_POST['item'][$item];
               $qty= $_POST['qty'][$item];
               $cost= $_POST['cost'][$item];
               $total= $_POST['total'][$item];
               $tax= $_POST['tax'][$item];
               $tx = ($tax/100) * $total;
               
               $ttot = $total + $tx;
               
               $pr= dbConnect()->prepare("INSERT INTO sinvoice SET custID=:cust, order_no=:inv, item=:item, qty=:qty, price=:pr, amount=:amt, total=:tot, tax=:tax, tax_value=:val, salesperson=:sl, code=:code, created=:dt, createdby=:by, branch=:brn");
               $pr->bindParam(':cust', $cust);
               $pr->bindParam(':inv', $invoice);
               $pr->bindParam(':item', $itmm);
               $pr->bindParam(':qty', $qty);
               $pr->bindParam(':pr', $cost);
               $pr->bindParam(':amt', $total);
               $pr->bindParam(':tot', $ttot);
               $pr->bindParam(':val', $tx);
               $pr->bindParam(':sl', $person);
               $pr->bindParam(':code', $code);
               $pr->bindParam(':dt', $dt);
               $pr->bindParam(':by', $by);
               $pr->bindParam(':brn', $bran);
               $pr->bindParam(':tax', $tax);
               $pr->execute();
           }
           
           if($pr){
               
               $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of sales invoice with invoice number $invoice by userID with ID of $uid', created=now()");
                    $inx->execute();
                    
                    echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='2;url=saleInv_view?order=$invoice'>
                            <span class='itext' style='color: blueviolet;'>Processing. Please Wait...</span>
                    </div><br><br><br><br><br><br><br><br>";
               
           }else{
            $e="Processing error."; 
            echo  " <script>alert('$e');</script>";
            }
           
            
           }
}




function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="sinvoice">Sale Invoice</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header mb-10">
                    <div>
                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="book"></i></span></span>Sales invoice</h4>
                    </div>
		   <div class="d-flex">
                        <a href="#" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="printer"></i></span></a>
                        <a href="#" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="download"></i></span></a>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <form class="needs-validation" method="post" novalidate>
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            <div class="invoice-from-wrap">
                                <div class="row">
                                    <div class="col-md-4 mb-20">
                                        <div class="col-md-12 mb-10">
                                            <label for="validationCustom01">Customer <small><a href="addContact">Add</a></small></label>
                                            <select class="form-control select2" name="customer" id="customer" required>
                                                    <?php
                                                    $jb=  dbConnect()->prepare("SELECT * FROM customer WHERE custID='$cid'");
                                                    $jb->execute();
                                                    while($r=$jb->fetch()){
                                                        $compn=$r['company'];
                                                    ?>
                                                    <option value="<?php echo $r['custID'];?>">
                                                        <?php 
                                                        if($compn !==''){echo $r['company'];}
                                                        else{echo $r['fname']." ".$r['lname'];}
                                                        ?>
                                                    </option>
                                                    <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-10">
                                            <textarea class="form-control" name="address" id="address"><?php echo $addr; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-20"></div>
                                    <div class="col-md-4 mb-20"><br>
                                        <div class="col-md-12 mb-10">
                                            <input type="text" class="form-control" id="validationCustom01" name="invoice" value="<?php echo $order; ?>" required>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                        <div class="col-md-12 mb-10">
                                            <input type="date" class="form-control" id="validationCustom02" value="<?php echo $created; ?>" name="date"  required>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                       <div class="col-md-12 mb-10">
                                            <select class="form-control select2" name="person" required>
                                                   <?php
                                                    $jb=  dbConnect()->prepare("SELECT * FROM users WHERE userID='$slp'");
                                                    $jb->execute();
                                                    while($r=$jb->fetch()){
                                                    ?>
                                                    <option value="<?php echo $r['userID'];?>">
                                                        <?php echo $r['fname']." ".$r['lname'] ?>
                                                    </option>
                                                    <?php } ?> 
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
                                  <table id="mytable" width="100%">
                                    <tr>
                                      <td>
                                         <div class="cont">
                                             <div class="row">
                                                 <input type="text" name="item[]" class="form-control col-md-3" placeholder="Item Name" /> &nbsp;&nbsp;&nbsp;
                                                 <input type="number" name="qty[]" class="form-control col-md-2" placeholder="Quantity" />&nbsp;&nbsp;&nbsp;
                                                 <input type="number" name="cost[]" class="form-control col-md-2" placeholder="Unit Cost" /> &nbsp;&nbsp;&nbsp;
                                                 <input type="number" name="tax[]" step="0.1" class="form-control col-md-2" placeholder="% Tax" /> &nbsp;&nbsp;&nbsp;
                                                 <input type="number" name="total[]" class="form-control col-md-2" autofocus=" " placeholder="Total Cost" />
                                          </div>
                                        </div>
                                         <a href="" class="add_fields pull-right"><i class="icon icon-plus"></i> Add New</a>
                                      </td>
                                    </tr>
                                  </table>
                                </div><br/><hr/>
                                <div class="table-wrap">
                                   <button type="submit" name="save" class="btn btn-primary btn-sm pull-right">Process Invoice</button>
                                </div>
                            </div><br/>
                        </section>
                    </div>
                </div>
                <!-- /Row -->
                </form>
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
                                <input type="text" name="item[]" class="form-control col-md-3" placeholder="Item Name" />&nbsp;&nbsp;&nbsp; \n\
                                <input type="number" name="qty[]" class="form-control col-md-2" placeholder="Quantity" />&nbsp;&nbsp;&nbsp; \n\
                                <input type="number" name="cost[]" class="form-control col-md-2" placeholder="Unit Cost"/>&nbsp;&nbsp;&nbsp;\n\
                                <input type="number" name="tax[]" class="form-control col-md-2" step="0.1" placeholder="% Tax"/>&nbsp;&nbsp;&nbsp;\n\
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




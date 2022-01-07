<?php 
include 'nav.php'; 

if(isset($_GET['order'])){
    $order = $_GET['order'];
}


$j=  dbConnect()->prepare("SELECT * FROM subscribers WHERE subscriberId='$order'");
$j->execute();
$jr=$j->fetch();
$custo = $jr['firstname']." ".$jr['lastname'];
$addr = $jr['address'];
$amount_agreed = $jr['amount_agreed'];
$item = $jr['which_estate'];
$qty = $jr['quantity'];
$due = ($amount_agreed * $qty);


$tot_paid =  dbConnect()->prepare("SELECT sum(amount) AS amount FROM payment WHERE custID='$order'");
$tot_paid->execute();
$ry=$tot_paid->fetch();
$tot = $ry['amount'];

$bal = ($amount_agreed - $tot);

$dd=date('m');
$dat= date('F');
$yr=date('Y');
//Transaction Code



if(isset($_POST['save'])){
    
        if(empty($_POST['paid'])){
        $e="Amount Paid is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['bank'])){
        $e="Please select a bank account credited!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['date'])){
        $e="Payment date is required!"; 
        echo  " <script>alert('$e'); ";
	}
        
        else{
            
           $pay = check_input($_POST["paid"]); // Amount paid by customer
           $bank = check_input($_POST["bank"]);
           $dt = check_input($_POST["date"]);
           $rmk = check_input($_POST["remark"]);
           
           
           $by = $uid;
           $bran = $branch;
           
           $balance = ($bal - $pay);
           $tot_pay = $paid + $pay;
           
                if($pay > $bal){
                     $e="Amount Paid is more than balance due."; 
                      echo  " <script>alert('$e');</script>";
                }else{
                        
                    $upd = dbConnect()->prepare("UPDATE sorder SET paid='$tot_pay' , balance='$balance' WHERE order_no='$order' ");
           if($upd->execute()){
               
                $pym= dbConnect()->prepare("INSERT INTO payment SET order_no='$order', custID='$cid', amount='$pay', datepaid='$dt', bank='$bank', confirmation='Yes', staff='$by', remark='$rmk' ");
                if($pym->execute()){
                            //Logging activity report
                           $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='$custo paid $pay from balance of $bal', created=now()");
                           $inx->execute();

                       if($balance > 0){
                           echo"
                            <br><br><br><br><br><br><br><br><br>
                            <div style='width:100%;text-align:center;vertical-align:bottom'>
                                    <div class='loader'></div>
                                    <br>
                                    <meta http-equiv='refresh' content='2;url=sorder'>
                                    <span class='itext' style='color: blueviolet;'>Processing Sale. Balance due is $balance...</span>
                            </div><br><br><br><br><br><br><br><br>";
                       }elseif($balance <= 0){
                           echo"
                            <br><br><br><br><br><br><br><br><br>
                            <div style='width:100%;text-align:center;vertical-align:bottom'>
                                    <div class='loader'></div>
                                    <br>
                                    <meta http-equiv='refresh' content='2;url=sorder'>
                                    <span class='itext' style='color: blueviolet;'>Thank you for completeing your payment</span>
                            </div><br><br><br><br><br><br><br><br>";
                       }
                }
               
               
               }else{
                 $e="Unable to Process payment."; 
                 echo  " <script>alert('$e');</script>";
                 
               }
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
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
           <!--     <div class="hk-pg-header align-items-top">
                    <div>
                        <h3>
                            <span class="wizard-icon-wrap"><i class="ion ion-ios-person"></i></span>
                            <span class="wizard-head-text-wrap">
                                    <span class="step-head">Employee Information</span>
                            </span>	
                        </h3>
                    </div>
                </div>-->
                <!-- /Title -->
                

                <!-- Container -->
            <div class="container">
                <!-- Row -->
                <div class="col-sm">
                    <form class="needs-validation" method="POST" novalidate>
                        <div class="col-xl-12 mb-20">
                               <h3>
                                    <span class="wizard-icon-wrap"><i class="ion ion-ios-person"></i></span>
                                    <span class="wizard-head-text-wrap">
                                        <span class="step-head"><?php echo $custo."'s Purchase Balance of #". number_format($bal) ?></span>
                                    </span>	
                                </h3>
                            <hr/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="grade">Customer</label>
                                        <input type="text" value="<?php echo $custo; ?>" class="form-control" disabled>
                                    </div>
                                </div>
                        </div>

                        <h3>
                            <span class="wizard-icon-wrap"><i class="ion ion-ios-person"></i></span>
                            <span class="wizard-head-text-wrap">
                                    <span class="step-head">Land Information</span>
                            </span>	
                        </h3><hr/>
                        <div class="col-xl-12 mb-20">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="land">Product</label>
                                        <input type="text" value="<?php echo $item; ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job">Plots</label>
                                        <input type="text" value="<?php echo $qty." Plot(s)"; ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job">Unit Price</label>
                                        <input type="text" value="<?php echo number_format($amount_agreed); ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job">Amount Due</label>
                                        <input type="text" value="<?php echo number_format($due); ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job">Amount Paid</label>
                                        <input type="text" value="<?php echo number_format($tot); ?>" class="form-control" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="job">Balance Due</label>
                                        <input type="text" value="<?php echo number_format($bal); ?>" class="form-control" disabled>
                                    </div>
                                </div>
                        </div>
                        <h3>
                            <span class="wizard-icon-wrap"><i class="ion icon-credit-card"></i></span>
                            <span class="wizard-head-text-wrap">
                                    <span class="step-head">Account Credited</span>
                            </span>	
                        </h3><hr/>
                        
                        <div class="col-xl-12 mb-20">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="land">Bank Credited</label>
                                        <select name="bank" class="form-control select2 d-block w-100" id="bank" required>
                                            <option value="">Select Bank...</option>
                                            <?php
                                            $jb=  dbConnect()->prepare("SELECT * FROM bank");
                                            $jb->execute();
                                            while($r=$jb->fetch()){
                                            ?>
                                            <option value="<?php echo $r['account'];?>"><?php echo $r['bank'];?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="land">Amount Paid</label>
                                        <input type="number" name="paid" class="form-control" placeholder="Amount Paid"/>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="land">Payment Date</label>
                                        <input type="date" name="date" class="form-control" placeholder="Payment Date" required/>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="remark">Remarks</label>
                                        <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="icon icon-note"></i></span>
                                                </div>
                                                <input class="form-control" id="address" name="remark" placeholder="Remarks" type="text">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                        
                        
                        <button class="btn btn-primary" type="submit" name="save">Add Payment</button>
                    </form>
                </div>
                
                
                
                
                
                
                
            </div>
            <!-- /Container -->
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
        
        <!-- Modal -->
                <div class="modal fade" id="exampleModalLarge01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge01" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="needs-validation" method="post" novalidate>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="firstName"> First Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="fname" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="firstName"> Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="lname" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 mb-10">
                                        <label for="phone">Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-phone"></i></span>
                                            </div>
                                        <input class="form-control" name="phone" type="text" required />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="occ">Occupation</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-wrench"></i></span>
                                            </div>
                                            <input class="form-control" name="occupation" type="text"  />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                           <label for="email">Email</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-envelope"></i></span>
                                               </div>
                                               <input class="form-control" id="email" name="email"  type="email" >
                                           </div>
                                           <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                       </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="origin">State of Origin</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-phone"></i></span>
                                            </div>
                                        <input class="form-control" name="state" type="text" required />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    
                                </div>
                                    <div class="row">
                                       
                                    <div class="col-md-4 mb-10">
                                        <label for="marital">Marital Status</label>
                                        <select name="marital" class="form-control" >
                                                <option value="">Please Select</option>
                                                <option>Divorced</option>
                                                <option>Married</option>
                                                <option>Single</option>
                                                <option>Widow</option>
                                                <option>Widower</option>
                                            </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                        
                                        <div class="col-md-4 mb-10">
                                            <label for="religion">Religion</label>
                                            <select name="religion" class="form-control" >
                                                    <option value="">Please Select</option>
                                                    <option>Christianity</option>
                                                    <option>Islam</option>
                                                    <option>Others</option>
                                                </select>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-10">
                                            <label for="gender">Gender</label>
                                            <select name="gender" class="form-control" >
                                                    <option value="">Please Select</option>
                                                    <option>Female</option>
                                                    <option>Male</option>
                                                </select>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                       <div class="form-group col-md-12">
                                           <label for="address">Address</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-location-pin"></i></span>
                                               </div>
                                               <input class="form-control" name="address" id="address"  type="text" required>
                                           </div>
                                           <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                       </div>
                                   </div>        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="cust" class="btn btn-primary">Save Details</button>
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
                </div>
                <!-- Modal -->
                
                
               
                
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModalLarge00" tabindex="-1" role="dialog" aria-labelledby="exampleModalLarge00" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Consultant</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form class="needs-validation" method="post" novalidate>
                            <div class="modal-body">
                               <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="firstName"> First Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="fname" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="firstName"> Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="lname" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 mb-10">
                                        <label for="phone">Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-phone"></i></span>
                                            </div>
                                        <input class="form-control" name="phone" type="text" required />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                       <label for="email">Email</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-envelope"></i></span>
                                               </div>
                                               <input class="form-control" id="email" name="email"  type="email" required>
                                           </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                    <div class="row">
                                       <div class="form-group col-lg-12">
                                           <label for="address">Address</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-location-pin"></i></span>
                                               </div>
                                               <input class="form-control" name="address" id="address"  type="text" required>
                                           </div>
                                           <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                       </div>
                                   </div> 
                             <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="consult" class="btn btn-primary">Save Consultant</button>
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
                </div>
                <!-- Modal -->

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


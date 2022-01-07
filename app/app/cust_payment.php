<?php 
include 'nav.php'; 

//getting the order number from the sales invoice
if(isset($_GET['order'])){
    $order = $_GET['order'];
}

//getting details of the order
$jb=  dbConnect()->prepare("SELECT * FROM sorder WHERE order_no='$order'");
$jb->execute();
$jj=$jb->fetch();
$cid = $jj['custID'];
$slp = $jj['salesperson'];
$created = $jj['created'];
$tot = $jj['total']; //total amount due
$tax = $jj['tax_value']; //total tax due
$amount = $jj['amount']; //actual amount due

//getting customers detail
$j=  dbConnect()->prepare("SELECT * FROM customer WHERE custID='$cid'");
$j->execute();
$jr=$j->fetch();
$custo = $jr['fname']." ".$jr['lname'];
$addr = $jr['address'];

//getting details of the sales person 
$p=  dbConnect()->prepare("SELECT fname, lname FROM users WHERE userID='$slp'");
$p->execute();
$pr=$p->fetch();
$saleP = $pr['fname']." ".$pr['lname'];




$dd=date('m');
$yr=date('Y');
//Getting Transaction Code
function random_num($size) {
    $length = $size;
    $key = '';
    $keys = range(0, 5);

        for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
        }
        return  $key;
}
$code= random_num(5);

if(isset($_POST['save'])){
    //Processing transaction form
    if(empty($_POST['bnk'])){
        $e="Please enter bank name"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['amount'])){
        $e="Please fill in the amount"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['cheque'])){
        $e="Please fill Cheque / Teller number"; 
        echo  " <script>alert('$e'); </script>"; 
    }
     
    else{  
        $bb = check_input($_POST["bnk"]);
        $amt = check_input($_POST["amount"]);
        $acc = check_input($_POST["acct"]);
        $note = check_input($_POST["note"]);
        $cheq = check_input($_POST["cheque"]);
        $dep = check_input($_POST["dep"]);
        $dt= date('Y-m-d');
        $user = $uid;
        $brn = $branch;
        
        $act=dbConnect()->prepare("SELECT account FROM bank WHERE id='$bb'");
        $act->execute();
        $rr=$act->fetch();
        $acNo=$rr['account'];
        
        $q=  dbConnect()->prepare("INSERT INTO deposit SET cheque=:che, bank=:bnk, account=:acc, amount=:amt,depositor=:dep,received=:by, note=:note, created=:dt,code=:code, branch=:brn, month=:mnt, year=:yr");
        $q->bindParam(':bnk', $bb);
        $q->bindParam(':che', $cheq);
        $q->bindParam(':acc', $acNo);
        $q->bindParam(':amt', $amt);
        $q->bindParam(':dep', $dep);
        $q->bindParam(':note', $note);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        $q->bindParam(':brn', $branch);
        $q->bindParam(':mnt', $dd);
        $q->bindParam(':yr', $yr);
        $q->bindParam(':code', $code);
        if($q->execute()){
            //recording users' activities
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Deposit of $amt by depositor $dep into $bb ($acNo)', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=adeposit'>
                            <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
            
        }else{
            $e="Operation Failed"; 
            echo  " <script>alert('$e'); </script>";
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
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h4 class="hk-pg-title font-weight-600 mb-10">New Payment</h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <label>Amount Due</label>
                                    <input type="number" class="form-control" id="validationCustom01" name="amount" value="<?php echo $amount; ?>"  disabled>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>VAT</label>
                                    <input type="number" class="form-control" id="validationCustom01" name="tax" value="<?php echo $tax; ?>"  disabled>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Total Due</label>
                                    <input type="number" class="form-control" id="validationCustom01" name="total" value="<?php echo $tot; ?>"  disabled>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="number" class="form-control" id="validationCustom01" name="paid" placeholder="Amount Paid"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> This field is required </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <select name="mtd" class="form-control custom-select d-block w-100" id="mtd" required>
                                        <option value="">Payment Method</option>
                                        <option>Cash</option>
                                        <option>Cheque</option>
                                        <option>Cash Transfer</option>
                                        <option>Bank Deposit</option>
                                        <option>POS</option>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Select a value </div>
                                </div>
                               <div class="col-md-12 mb-20">
                                    <select name="bnk" class="form-control custom-select d-block w-100" id="mtd" required>
                                        <option value="">Bank</option>
                                        <?php
                                        $bk= dbConnect()->prepare("SELECT bank,account From bank");
                                        $bk->execute();
                                        while($rz = $bk->fetch()){
                                            ?>
                                            <option><?php echo $rz['bank'];?></option>
                                        <?php }  ?>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Select a value </div>
                                </div>
                               <div class="col-md-12 mb-20">
                                   <input type="text" class="form-control" id="validationCustom01" name="cheque" placeholder="Cheque No"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> This field is required </div>
                                </div>
                                
                                <div class="col-md-12 mb-20">
                                    <label for="validationCustom02">Description</label>
                                    <textarea class="form-control" id="validationCustom02" name="note"> </textarea>
                                </div>
                            <button class="btn btn-primary btn-block" type="submit" name="save">Process Payment</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-9">
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
                                                    $jbb=  dbConnect()->prepare("SELECT * FROM sorder WHERE order_no='$order'");
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
    <script type="text/javascript">
            $(document).ready(function(){

            $("#bank").change(function(){
                var bankid = $(this).val();

                $.ajax({
                    url: 'getAccount.php',
                    type: 'post',
                    data: {bnk:bankid},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;

                        $("#acct").empty();
                        for( var i = 0; i<len; i++){
                            var account = response[i]['account'];
                            $("#acct").val(account);

                           // $("#address").append("<option value='"+id+"'>"+address+"</option>");

                        }
                    }
                });
            });

        });
    </script>
</body>

</html>
<?php 
include 'nav.php'; 
$dd=date('m');
$dat= date('F');
$yr=date('Y');
//Transaction Code
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

function random_num2($size) {
    $length = $size;
    $key = '';
    $keys = range(0, 5);

        for ($i = 0; $i < $length; $i++) {
                $key .= $keys[array_rand($keys)];
        }
        return  $key;
}
$invoice= random_num2(5);

if(isset($_POST['save'])){
        if(empty($_POST['land'])){
        $e="Item name is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['plot'])){
        $e="Quantity is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['agreed'])){
        $e="Agreed Selling Amount is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['paid'])){
        $e="Amount Paid is mandatory!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['customer'])){
        $e="Please select a customer!"; 
        echo  " <script>alert('$e'); ";
	}
        elseif(empty($_POST['bank'])){
        $e="Please select a bank account credited!"; 
        echo  " <script>alert('$e'); ";
	}
        
        else{
           $cust = check_input($_POST["customer"]);
           //$dt = check_input($_POST["date"]);
           //$add = check_input($_POST["address"]);
           $consul = check_input($_POST["consultant"]); //consultant name
           $item = check_input($_POST["land"]); //product name
           $qty = check_input($_POST["plot"]); //number of plots
           $cost = check_input($_POST["agreed"]); //agree amount
           $paid = check_input($_POST["paid"]); // Amount paid by customer
           $agrCons = check_input($_POST["agreedc"]); // Amount agree to pay consultant
           $remark = check_input($_POST["remark"]);
           $type = check_input($_POST["type"]);
           $bank = check_input($_POST["bank"]);
           
           $kfn =  check_input($_POST['kfn']);
            $kln =  check_input($_POST['kln']);
            $kph =  check_input($_POST['kphone']);
            $kem =  check_input($_POST['kemail']);
            $kadd =  check_input($_POST['kaddress']);
            $rel =  check_input($_POST['rel']);
           
           $total = $qty * $cost;
           $tax = 7.5;
           $tx = ($tax/100) * $total;
           $ttot = $total + $tx;
           $by = $uid;
           $bran = $branch;
           $dt= date('Y-m-d');
           
           $bal = ($qty * $cost) - ($paid);
           
           //Checking amount paid against amount agreed
           
           if($paid > ($qty*$cost)){
                $e="Amont Paid is more than cost of the plots."; 
                 echo  " <script>alert('$e');</script>";
           }else{
               //Processing sales
            
            $pr = dbConnect()->prepare("INSERT INTO sorder SET custID=:cust,bank=:bnk, order_no=:inv, item=:item, qty=:qty, unit_price=:pr, amount=:amt, paid=:pd, balance=:bal, tax=:tax, tax_value=:tx, total=:tot, consultant=:sl, consultAmt=:agrC, type=:tp, code=:code, created=:dt, note=:note, createdby=:by, branch=:brn, kfn=:kfn, kln=:kln, kphone=:kpn, kemail=:kem, kaddress=:kadd, month=:mn, year=:yr, relationship=:rel");
               $pr->bindParam(':cust', $cust);
               $pr->bindParam(':inv', $invoice);
               $pr->bindParam(':item', $item);
               $pr->bindParam(':qty', $qty); 
               $pr->bindParam(':pr', $cost);
               $pr->bindParam(':amt', $total);
               $pr->bindParam(':pd', $paid);
               $pr->bindParam(':bal', $bal);
               $pr->bindParam(':tax', $tax);
               $pr->bindParam(':tx', $tx);
               $pr->bindParam(':tot', $ttot);
               $pr->bindParam(':sl', $consul);
               $pr->bindParam(':agrC', $agrCons);
               $pr->bindParam(':code', $code);
               $pr->bindParam(':note', $remark);
               $pr->bindParam(':tp', $type);
               $pr->bindParam(':dt', $dt);
               $pr->bindParam(':by', $by);
               $pr->bindParam(':brn', $bran);
               //Next of Kin Information
               $pr->bindParam(':kfn', $kfn);
               //Bank Information
               $pr->bindParam(':bnk', $bank);
               $pr->bindParam(':kln', $kln);
               $pr->bindParam(':kpn', $kph);
               $pr->bindParam(':kem', $kem);
               $pr->bindParam(':kadd', $kadd);
               $pr->bindParam(':rel', $rel);
               $pr->bindParam(':mn', $dd);
               $pr->bindParam(':yr', $yr);
               $pr->execute();
            
            if($pr){
                //Processing payment
                $trn=" Payment for purchase of ".$qty." Plots at ".$item;
               $bk= dbConnect()->prepare("INSERT INTO transactions SET account=:acc, credit=:cr, transaction=:tr, createdby=:by, branch=:bn, created=:dt ");
               $bk->bindParam(':acc', $bank);
               $bk->bindParam(':cr', $paid);
               $bk->bindParam(':tr', $trn);
               $bk->bindParam(':by', $by);
               $bk->bindParam(':bn', $bran);
               $bk->bindParam(':dt', $dt);
               if($bk->execute()){
                   //Processing consultant commission
                   $cns=  dbConnect()->prepare("INSERT INTO consultantC SET consultant=:con, order_id=:ord, amount=:amt, created=:dt, createdby=:by");
                   $cns->bindParam(':con', $consul);
                   $cns->bindParam(':ord', $invoice);
                   $cns->bindParam(':amt', $agrCons);
                   $cns->bindParam(':dt', $dt);
                   $cns->bindParam(':by', $by);
                   $cns->execute();
                   
                   //Logging activity report
                   $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of sales order with invoice number $invoice by userID with ID of $uid', created=now()");
                   $inx->execute();
                    
                    echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='2;url=sorder'>
                            <span class='itext' style='color: blueviolet;'>Processing Sale. Balance due is $bal...</span>
                    </div><br><br><br><br><br><br><br><br>";
               }else{
                 $e="Unable to Process payment."; 
                 echo  " <script>alert('$e');</script>";
                 
               }
               
                }else{
                 $e="Unable to Process sale."; 
                 echo  " <script>alert('$e');</script>";
                 }
           }
           
           }
}





if(isset($_POST['cust'])){
    
    if(empty($_POST['fname'])){
        $e="Please fill in key contact's first name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['lname'])){
        $e="Please fill in key contact's last name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['phone'])){
        $e="Please fill in the phone number"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['address'])){
        $e="Please fill in  address"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    else{
        $fn=  check_input($_POST['fname']);
        $ln=  check_input($_POST['lname']);
        $ph=  check_input($_POST['phone']);
        $em=  check_input($_POST['email']);
        $occ=  check_input($_POST['occupation']);
        $state=  check_input($_POST['state']);
        $rel=  check_input($_POST['religion']);
        $ad=  check_input($_POST['address']);
        $marital=  check_input($_POST['marital']);
        $gender=  check_input($_POST['gender']);
        $dt= date('Y-m-d');
        $user = $uid;
        $bran= $branch;
        
        $q1=  dbConnect()->prepare("SELECT count(custID) AS no FROM customer WHERE email='$em'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
            $in=dbConnect()->prepare("INSERT INTO customer SET  fname=:fn, lname=:ln, phone=:ph, email=:em,  occupation=:occ, state=:state, religion=:rel, marital=:mrd, gender=:gnd, address=:add, created=:dt, createdby=:by, branch=:brn ");
            $in->bindParam(':fn', $fn);
            $in->bindParam(':ln', $ln);
            $in->bindParam(':em', $em);
            $in->bindParam(':ph', $ph);
            $in->bindParam(':state', $state);
            $in->bindParam(':occ', $occ);
            $in->bindParam(':add', $ad);
            $in->bindParam(':dt', $dt);
            $in->bindParam(':by', $user);
            $in->bindParam(':rel', $rel);
            $in->bindParam(':brn', $bran);
            $in->bindParam(':mrd', $marital);
            $in->bindParam(':gnd', $gender);
            if($in->execute()){
                
                $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of new customer profile $fn, $ln  by userID with ID of $uid', created=now()");
                    $inx->execute();
                    
                    $e="customer has been successfully created"; 
                    echo  " <script>alert('$e'); </script>";
                    
            }
            
        }
        else{
            $e="This customer already exists"; 
            echo  " <script>alert('$e'); </script>";
            
        }
    }
}

if(isset($_POST['consult'])){
    
    
    if(empty($_POST['fname'])){
        $e="Please fill in key contact's first name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['lname'])){
        $e="Please fill in key contact's last name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['phone'])){
        $e="Please fill in the phone number"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    else{
        $fn=  check_input($_POST['fname']);
        $ln=  check_input($_POST['lname']);
        $ph=  check_input($_POST['phone']);
        $em=  check_input($_POST['email']);
        $add=  check_input($_POST['address']);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM consultants WHERE email='$em' and phone='$ph'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
            $inn=dbConnect()->prepare("INSERT INTO consultants SET  fname=:fn, lname=:ln, phone=:ph, email=:em, address=:add, created=:dt, createdby=:by ");
            $inn->bindParam(':fn', $fn);
            $inn->bindParam(':ln', $ln);
            $inn->bindParam(':em', $em);
            $inn->bindParam(':add', $add);
            $inn->bindParam(':ph', $ph);
            $inn->bindParam(':dt', $dt);
            $inn->bindParam(':by', $user);
            if($inn->execute()){
                
                    $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of new consultant profile $fn, $ln  by userID with ID of $uid', created=now()");
                    $inx->execute();
                    
                    $e="Consultant has been successfully created"; 
                    echo  " <script>alert('$e'); </script>";
                
            }
            
            
        }
        else{
            $e="This Consultant already exists"; 
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
                                            <span class="step-head">Buyer's Information</span>
                                            <span class="col-md-4 btn btn-gradient-success"><small><a data-toggle="modal" data-target="#exampleModalLarge01"> Create  New Customer <i class="icon-user-follow"></i></a></small></span>
                                            <span class="col-md-4 btn btn-blue"><small><a data-toggle="modal" data-target="#exampleModalLarge00"> Create New Consultant <i class="icon-user-follow"></i></a></small></span>
                                    </span>	
                                </h3>
                            <hr/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="grade">Customer</label>
                                        <select name="customer" class="form-control select2" id="customer" required>
                                            <option value="">Select Customer...</option>
                                            <?php
                                            $gb=  dbConnect()->prepare("SELECT * FROM customer");
                                            $gb->execute();
                                            while($r1=$gb->fetch()){
                                            ?>
                                            <option value="<?php echo $r1['custID'];?>"><?php echo $r1['fname']." ".$r1['lname'];?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="grade">Consultant</label>
                                        <select name="consultant" class="form-control select2 d-block w-100" id="consultant" required>
                                            <option value="">Select Consultant...</option>
                                            <?php
                                            $gb=  dbConnect()->prepare("SELECT * FROM consultants");
                                            $gb->execute();
                                            while($r1=$gb->fetch()){
                                            ?>
                                            <option value="<?php echo $r1['id'];?>"><?php echo $r1['fname']." ".$r1['lname'];?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
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
                                    <div class="form-group col-md-6">
                                        <label for="land">Product</label>
                                        <select name="land" class="form-control select2 d-block w-100" id="land" required>
                                            <option value="">Select Project...</option>
                                            <?php
                                            $jb=  dbConnect()->prepare("SELECT * FROM project");
                                            $jb->execute();
                                            while($r=$jb->fetch()){
                                            ?>
                                            <option><?php echo $r['project'];?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="job">Plots</label>
                                        <select name="plot" class="form-control select2 d-block w-100" id="plot" required>
                                            <option value="">Choose...</option>
                                            <?php
                                                for($x=1; $x < 100; $x++){
                                                    echo"<option value='$x'> $x Plots</option>";
                                                }
                                            ?>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="typ">Type</label>
                                    <select name="type" class="form-control select2 d-block w-100" id="type" required>
                                            <option value="">Choose Type...</option>
                                            <option>Commercial</option>
                                            <option>Corner Piece</option>
                                            <option>Residential</option>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="amt">Amount Agreed (Sell)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon icon-credit-card"></i></span>
                                        </div>
                                        <input class="form-control" id="agreed" name="agreed" type="number">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pad">Amount Paid (Sell)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon icon-credit-card"></i></span>
                                        </div>
                                        <input class="form-control" id="paid" name="paid" type="number">
                                    </div>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label for="const">Amount Agreed (Consultant)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-book-open"></i></span>
                                        </div>
                                        <input class="form-control" id="agreec" name="agreedc" type="number">
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="remark">Remarks</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-note"></i></span>
                                            </div>
                                            <input class="form-control" id="address" name="remark" placeholder="Remarks" type="text">
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
                                    <div class="form-group col-md-12">
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
                                </div>
                        </div>
                        
                        
                        <h3>
                            <span class="wizard-icon-wrap"><i class="ion ion-ios-person"></i></span>
                            <span class="wizard-head-text-wrap">
                                    <span class="step-head">Next of Kin Information</span>
                            </span>	
                        </h3><hr/>
                        <div class="col-xl-12 mb-20">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="firstName">First name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                        <input class="form-control" id="firstName" name="kfn" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="lastName">Last name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="lastName" name="kln" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="username">Phone</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon icon-phone"></i></span>
                                        </div>
                                        <input class="form-control" id="username" name="kphone" type="text">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon icon-envelope"></i></span>
                                        </div>
                                        <input class="form-control" id="username" name="kemail" type="email">
                                    </div>
                                </div>
                                 <div class="form-group col-md-6">
                                    <label for="rel">Relationship</label>
                                    <select name="rel" class="form-control select2 d-block w-100" id="type" required>
                                            <option value="">Choose Relationship...</option>
                                            <option>Brother</option>
                                            <option>Daughter</option>
                                            <option>Husband</option>
                                            <option>Father</option>
                                            <option>Mother</option>
                                            <option>Wife</option>
                                            <option>Son</option>
                                            <option>Sister</option>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="form-group col-md-6">
                                       <label for="address">Address</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-location-pin"></i></span>
                                            </div>
                                            <input class="form-control" id="address" name="kaddress" placeholder="Address" type="text">
                                    </div> 
                                    </div>
                                </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="save">Create Sale</button>
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


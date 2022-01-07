<?php 
include 'nav.php'; 
if(isset($_GET['id'])){
    $cust = $_GET['id'];
}

$q2=  dbConnect()->prepare("SELECT * FROM customer WHERE custID='$cust'");
$q2->execute();
$rw=$q2->fetch();


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
        
        $in=dbConnect()->prepare("UPDATE customer SET  fname=:fn, lname=:ln, phone=:ph, email=:em,  occupation=:occ, state=:state, religion=:rel, marital=:mrd, gender=:gnd, address=:add, created=:dt, createdby=:by, branch=:brn WHERE custID=:cust ");
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
            $in->bindParam(':cust', $cust);
            if($in->execute()){
                
                $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Updating customer profile $fn, $ln  by userID with ID of $uid', created=now()");
                    $inx->execute();
                    
                    echo"
                        <br><br><br><br><br><br><br><br><br>
                        <div style='width:100%;text-align:center;vertical-align:bottom'>
                                <div class='loader'></div>
                                <br>
                                <meta http-equiv='refresh' content='1;url=cust_edit?id=$cust'>
                                <span class='itext' style='color: blueviolet;'>Updating. Please Wait!...</span>
                        </div><br><br><br><br><br><br><br><br>";
                    
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
                        <h2 class="hk-pg-title font-weight-600 mb-10">New Customer</h2>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form class="needs-validation" method="post" novalidate>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="firstName"> First Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="fname" value="<?php echo $rw['fname']; ?>" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="lname"> Last Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-user"></i></span>
                                            </div>
                                            <input class="form-control" id="lName" name="lname" value="<?php echo $rw['lname']; ?>" type="text" required>
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
                                            <input class="form-control" name="phone" id="phone" value="<?php echo $rw['phone']; ?>" type="text" required />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="occ">Occupation</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-wrench"></i></span>
                                            </div>
                                            <input class="form-control" id="occu" name="occupation" value="<?php echo $rw['occupation']; ?>" type="text"  />
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
                                               <input class="form-control" id="email" name="email" value="<?php echo $rw['email']; ?>"  type="email" >
                                           </div>
                                           <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                       </div>
                                    <div class="col-md-6 mb-10">
                                        <label for="origin">State of Origin</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-phone"></i></span>
                                            </div>
                                            <input class="form-control" name="state" id="state" value="<?php echo $rw['state']; ?>" type="text" required />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    
                                </div>
                                    <div class="row">
                                       
                                    <div class="col-md-4 mb-10">
                                        <label for="marital">Marital Status</label>
                                        <select name="marital"  class="form-control" >
                                                <option><?php echo $rw['marital']; ?></option>
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
                                                    <option><?php echo $rw['religion']; ?></option>
                                                    <option>Christianity</option>
                                                    <option>Islam</option>
                                                    <option>Others</option>
                                                </select>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                        
                                        <div class="col-md-4 mb-10">
                                            <label for="gender">Gender</label>
                                            <select name="gender" class="form-control" >
                                                    <option><?php echo $rw['gender']; ?></option>
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
                                               <input class="form-control" name="address" value="<?php echo $rw['address']; ?>" id="address"  type="text" required>
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
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
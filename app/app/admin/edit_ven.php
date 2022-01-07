<?php 
include 'nav.php'; 
if(isset($_GET['id'])){
    $cust = $_GET['id'];
}

$q2=  dbConnect()->prepare("SELECT * FROM vendor WHERE id='$cust'");
$q2->execute();
$rw=$q2->fetch();

if(isset($_POST['save'])){
    
    if(empty($_POST['fname'])){
        $e="Please fill in key contact's first name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['lname'])){
        $e="Please fill in key contact's last name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['email'])){
        $e="Please fill in  email"; 
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
    elseif(empty($_POST['type'])){
        $e="Please select customer type"; 
        echo  " <script>alert('$e'); </script>";
    }
    else{
        $fn=  check_input($_POST['fname']);
        $ln=  check_input($_POST['lname']);
        $ph=  check_input($_POST['phone']);
        $em=  check_input($_POST['email']);
        $company=  check_input($_POST['comp']);
        $web=  check_input($_POST['web']);
        $typ=  check_input($_POST['type']);
        $ad=  check_input($_POST['address']);
        
        $dt= date('Y-m-d');
        $user = $uid;
        
            $in=dbConnect()->prepare("UPDATE vendor SET type=:typ, fname=:fn, lname=:ln, phone=:ph, email=:em, web=:web, company=:comp, address=:add, modified=:dt, modifyby=:by WHERE id=:cust ");
            $in->bindParam(':fn', $fn);
            $in->bindParam(':ln', $ln);
            $in->bindParam(':em', $em);
            $in->bindParam(':ph', $ph);
            $in->bindParam(':web', $web);
            $in->bindParam(':comp', $company);
            $in->bindParam(':add', $ad);
            $in->bindParam(':dt', $dt);
            $in->bindParam(':by', $user);
            $in->bindParam(':typ', $typ);
            $in->bindParam(':cust', $cust);
            if($in->execute()){
                
                $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Modification of vendor profile $fn, $ln  by userID with ID of $uid', created=now()");
                    $inx->execute();
                    
                    echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=vendor'>
                            <span class='itext' style='color: blueviolet;'>Updating Vendor. Please Wait...</span>
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
                        <h2 class="hk-pg-title font-weight-600 mb-10">Vendor</h2>
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
                                         <div class="col-xl-12 mb-20">
                                                    <h3>
                                                         <span class="wizard-icon-wrap"><i class="ion ion-ios-person"></i></span>
                                                         <span class="wizard-head-text-wrap">
                                                                 <span class="step-head">Vendor Information</span>
                                                         </span>	
                                                     </h3><hr/>
                                                     <div class="row">
                                                         <div class="col-md-6 form-group">
                                                             <label for="firstName">Contact First Name</label>
                                                             <div class="input-group">
                                                                 <div class="input-group-prepend">
                                                                     <span class="input-group-text"><i class="icon icon-user"></i></span>
                                                                 </div>
                                                                 <input class="form-control" id="firstName" name="fname" type="text" value="<?php echo $rw['fname']; ?>" required>
                                                             </div>
                                                             <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                         </div>
                                                         <div class="col-md-6 form-group">
                                                             <label for="firstName">Contact Last Name</label>
                                                             <div class="input-group">
                                                                 <div class="input-group-prepend">
                                                                     <span class="input-group-text"><i class="icon icon-user"></i></span>
                                                                 </div>
                                                                 <input class="form-control" id="firstName" name="lname" value="<?php echo $rw['lname']; ?>" type="text" required>
                                                             </div>
                                                             <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                         </div>
                                                     </div>
                                                     <div class="row">
                                                         <div class="col-md-3 mb-10">
                                                             <label for="gender">Type</label>
                                                             <select name="type" class="form-control custom-select d-block w-100" id="country" required>
                                                                 <option><?php echo $rw['type']; ?></option>
                                                                 <option>Corporate</option>
                                                                 <option>Individual</option>
                                                             </select>
                                                             <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                         </div>
                                                         <div class="col-md-3 mb-10">
                                                             <label for="phone">Phone</label>
                                                             <div class="input-group">
                                                                 <div class="input-group-prepend">
                                                                     <span class="input-group-text"><i class="icon icon-phone"></i></span>
                                                                 </div>
                                                             <input class="form-control" name="phone" value="<?php echo $rw['phone']; ?>" type="text" required />
                                                             </div>
                                                             <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                         </div>
                                                         <div class="col-md-6 mb-10">
                                                             <label for="phone">Company Name</label>
                                                             <div class="input-group">
                                                                 <div class="input-group-prepend">
                                                                     <span class="input-group-text"><i class="icon icon-home"></i></span>
                                                                 </div>
                                                                 <input class="form-control" name="comp" value="<?php echo $rw['company']; ?>" type="text"  />
                                                             </div>
                                                             <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                         </div>
                                                     </div>
                                                         <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <label for="email">Email</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="icon icon-envelope"></i></span>
                                                                    </div>
                                                                    <input class="form-control" id="email" name="email"  value="<?php echo $rw['email']; ?>" type="email" required>
                                                                </div>
                                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                            </div>
                                                            <div class="form-group col-lg-6">
                                                                <label for="email">Website</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="icon icon-globe"></i></span>
                                                                    </div>
                                                                    <input class="form-control" id="email" name="web" value="<?php echo $rw['web']; ?>"  type="text" >
                                                                </div>
                                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                            </div>
                                                            <div class="form-group col-lg-12">
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
                                                         
                                                     
                                                     
                                             </div>
                                        <button class="btn btn-primary" type="submit" name="save">Save Vendor</button>
                                    </form>
                                </div>
                            </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
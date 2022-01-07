<?php 
include 'nav.php'; 

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
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
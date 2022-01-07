<?php 
include 'nav.php'; 
if(isset($_GET['id'])){
    $cust = $_GET['id'];
}

$q2=  dbConnect()->prepare("SELECT * FROM consultants WHERE id='$cust'");
$q2->execute();
$rw=$q2->fetch();

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
        
        $inn=dbConnect()->prepare("UPDATE consultants SET  fname=:fn, lname=:ln, phone=:ph, email=:em, address=:add, created=:dt, createdby=:by WHERE id=:id");
            $inn->bindParam(':fn', $fn);
            $inn->bindParam(':ln', $ln);
            $inn->bindParam(':em', $em);
            $inn->bindParam(':add', $add);
            $inn->bindParam(':ph', $ph);
            $inn->bindParam(':dt', $dt);
            $inn->bindParam(':by', $user);
            $inn->bindParam(':id', $cust);
            if($inn->execute()){
                
                    $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Updating consultant profile $fn, $ln  by userID with ID of $uid', created=now()");
                    $inx->execute();
                    
                    echo"
                        <br><br><br><br><br><br><br><br><br>
                        <div style='width:100%;text-align:center;vertical-align:bottom'>
                                <div class='loader'></div>
                                <br>
                                <meta http-equiv='refresh' content='1;url=cview?id=$cust'>
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
                        <h2 class="hk-pg-title font-weight-600 mb-10"> <?php echo $rw['fname']." ".$rw['lname']; ?></h2>
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
                                        <label for="firstName"> Last Name</label>
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

                                    <div class="col-md-6 mb-10">
                                        <label for="phone">Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-phone"></i></span>
                                            </div>
                                        <input class="form-control" name="phone" type="text" value="<?php echo $rw['phone']; ?>" required />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 mb-10">
                                       <label for="email">Email</label>
                                           <div class="input-group">
                                               <div class="input-group-prepend">
                                                   <span class="input-group-text"><i class="icon icon-envelope"></i></span>
                                               </div>
                                               <input class="form-control" id="email" name="email"  value="<?php echo $rw['email']; ?>" type="email" required>
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
                                               <input class="form-control" name="address" id="address" value="<?php echo $rw['address']; ?>"  type="text" required>
                                           </div>
                                           <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                       </div>
                                   </div> 
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" name="consult" class="btn btn-primary">Save Changes</button>
                                   </div>    
                                         </div>
                                        <!--<button class="btn btn-primary" type="submit" name="save">Save Contact</button>-->
                                    </form>
                                </div>
                            </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
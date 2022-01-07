<?php 
include 'nav.php'; 

$q1=  dbConnect()->prepare("SELECT * FROM company");
$q1->execute();
$r=$q1->fetch();

$lg=$r['logo'];

if(isset($_POST['save'])){
    
    if(empty($_POST['company'])){
        $e="Please fill in key company's name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['address'])){
        $e="Please fill in company's contact address"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['phone'])){
        $e="Please fill in the phone number"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    
    else{
        
        echo"
                                <br><br><br><br><br><br><br><br><br>
                                <div style='width:100%;text-align:center;vertical-align:bottom'>
                                        <div class='loader'></div>
                                        <br>
                                        <meta http-equiv='refresh' content='1;url=company'>
                                        <span class='itext' style='color: blueviolet;'>Updating. Please Wait...</span>
                                </div><br><br><br><br><br><br><br><br>";
        
        
        //Upload media File
        $imgFile2 = $_FILES['logo']['name'];
        $tmp_dir2 = $_FILES['logo']['tmp_name'];
        $imgSize2 = $_FILES['logo']['size'];
        
        $name=  check_input($_POST['company']);
        $ad=  check_input($_POST['address']);
        $ph=  check_input($_POST['phone']);
        $em=  check_input($_POST['email']);
        $state=  check_input($_POST['state']);
        $zip=  check_input($_POST['zip']);
        
        {
        $upload_dir2 = 'upload/'; // upload directory

        $imgExt2 = strtolower(pathinfo($imgFile2,PATHINFO_EXTENSION)); // get image extension

        // valid image extensions
        $valid_extensions2 = array('jpeg', 'jpg', 'png', 'pdf', 'doc', 'docx', 'gif', "mp3", "mp4", "mp4","avi","3gp","mov","mpeg"); // valid extensions

        // rename uploading image
        $proImage2 = rand(1000,1000000).".".$imgExt2;
        
        $media_file="upload/".$proImage2;

        // allow valid image file formats
        if(in_array($imgExt2, $valid_extensions2)){			
                // Check file size '500MB'
                if($imgSize2 < 500000000){
                    unlink($lg);
                    if(move_uploaded_file($tmp_dir2,$upload_dir2.$proImage2)){
                        
                        $in=dbConnect()->prepare("UPDATE company SET  name=:nm, address=:add, phone=:ph, email=:em, state=:st, zip=:zip, logo=:logo");
                        $in->bindParam(':nm', $name);
                        $in->bindParam(':add', $ad);
                        $in->bindParam(':em', $em);
                        $in->bindParam(':ph', $ph);
                        $in->bindParam(':st', $state);
                        $in->bindParam(':zip', $zip);
                        $in->bindParam(':logo', $media_file);
                        if($in->execute()){

                            $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Modification of Company profile $name,  by userID with ID of $uid', created=now()");
                             $inx->execute();

                           echo"
                                <br><br><br><br><br><br><br><br><br>
                                <div style='width:100%;text-align:center;vertical-align:bottom'>
                                        <div class='loader'></div>
                                        <br>
                                        <meta http-equiv='refresh' content='1;url=company'>
                                        <span class='itext' style='color: blueviolet;'>Updating. Please Wait...</span>
                                </div><br><br><br><br><br><br><br><br>";

                        }
                    }
                    
                    
                    
                }
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
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h2 class="hk-pg-title font-weight-600 mb-10">Update Company Information</h2>
                        <p><h5 class="hk-sec-title">Basic Company Information</h5> </p>
                    </div>
                    <div class="d-flex w-500p"></div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <div class="row">
                                <div class="col-sm">
                                    <form class="needs-validation" method="post" novalidate enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-10">
                                                <label for="validationCustom01">Company Name</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="company" value="<?php echo $r['name']; ?>"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Company Email</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="email" value="<?php echo $r['email']; ?>"  pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}"  title="email (format: username@email.xx or username@email.xxx )" required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Invalid email format </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom01">Company Phone</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="phone" value="<?php echo $r['phone']; ?>"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            
                                            <div class="col-md-12 mb-10">
                                                <label for="validationCustom01">Company Address</label>
                                                <input type="text" class="form-control" id="validationCustom01" name="address" value="<?php echo $r['address']; ?>"  required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom04">State</label>
                                                <input type="text" class="form-control" id="validationCustom04" name="state" value="<?php echo $r['state']; ?>" >
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-6 mb-10">
                                                <label for="validationCustom05">Zip</label>
                                                <input type="text" class="form-control" id="validationCustom05" name="zip" value="<?php echo $r['zip']; ?>" required>
                                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                            </div>
                                            <div class="col-md-12 mb-10">
                                                <label for="validationCustom05">Click browse to change</label>
                                                <div class="col-md-6 mb-10"><img src="<?php echo $lg; ?>"></div>
                                                <div class="col-md-6 mb-10"><input type="file" class="form-control" id="validationCustom06" name="logo"  ></div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit" name="save">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
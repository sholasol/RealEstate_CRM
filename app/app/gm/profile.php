<?php 
include 'nav.php';

    $id =$user_id;

//$d=$id;

$epp=  dbConnect()->prepare("SELECT * FROM employee WHERE userID='$id' ");
$epp->execute();
$rw=$epp->fetch();

$phone=$rw['phone'];
$email=$rw['email'];
$nam=$rw['fname']." ".$rw['lname']." ".$rw['oname'];
$grd=$rw['grade'];
$job=$rw['job'];
$join=$rw['created'];

$q=  dbConnect()->prepare("SELECT job FROM job WHERE id='$job'");
$q->execute();
$w=$q->fetch();
$jb=$w['job'];

$qq=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$grd'");
$qq->execute();
$x=$qq->fetch();
$grade=$x['grade'];

$sl=dbConnect()->prepare("SELECT component, value FROM salaryComponent WHERE grade='$grd' AND job='$job'");
$sl->execute();
$rx=$sl->fetch();
$scomp= $rx['component'];
if($scomp =='Basic Salary'){
    $sala= $rx['value'];
}else{
    $sala= $rx['value'];
}


if(isset($_POST['save'])){
    
    
    if(empty($_POST['old'])){
        $e="Please Enter Current Password"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['new'])){
        $e="Please Enter New Password"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['confirm'])){
        $e="Please Confirm Password"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif($_POST['new'] !== $_POST['confirm']){
        $e="Password Mismatch"; 
        echo  " <script>alert('$e'); </script>";
    }else{
        
        $old=  check_input($_POST['old']);
        $new=  check_input($_POST['new']);
        $confirm=  check_input($_POST['confirm']);
               
        //Getting the user details
        $q1=  dbConnect()->prepare("SELECT * FROM users WHERE email='$email'");
        if($q1->execute()){
            
            $rr=$q1->fetch();
            $phash=$rr['password'];
            $password = password_verify($old, $phash);
            //If password is verified
            if($password){
                
                
            //Password Encryption
            $pas= $new;
            $options = [
                'cost' => 12,
            ];
            $hash= password_hash($pas, PASSWORD_BCRYPT, $options); 
            
            
            //Updating Password
            $in=dbConnect()->prepare("UPDATE users SET password=:pw WHERE email=:email ");
            $in->bindParam(':pw', $hash);
            $in->bindParam(':email', $email);
                    if($in->execute()){
                     //Recording the activity
                    $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$id', activity='Change of personal password ', created=now()");
                        $inx->execute();

                        echo"
                        <br><br><br><br><br><br><br><br><br>
                        <div style='width:100%;text-align:center;vertical-align:bottom'>
                                <div class='loader'></div>
                                <br>
                                <meta http-equiv='refresh' content='1;url=../logout'>
                                <span class='itext' style='color: blueviolet;'>Processing. Please Wait...</span>
                        </div><br><br><br><br><br><br><br><br>";
                     
                    }else{

                    $e="Unable to process your request. Something went wrong";    
                    echo  " <script>alert('$e'); </script>";
                    }
            
            }else{
                $e="The password entered does not match our record";    
            echo  " <script>alert('$e'); </script>";
            }
        }else{
            $e="This user doe not exist";    
            echo  " <script>alert('$e'); </script>";
        }
        
            /*
            //Veryfing the password
            $password = password_verify($old, $phash);
            
            if($password){
                
                //Password Encryption
                $pas= $new;
                $options = [
                    'cost' => 12,
                ];
                $hash= password_hash($pas, PASSWORD_BCRYPT, $options);
                
                $e="Old Password: $old"." New password: $pas"; 
                echo  " <script>alert('$e'); </script>";
                
                
                //Updating Password
                $in=dbConnect()->prepare("UPDATE users SET  password=:pw WHERE userID=:usr ");
                $in->bindParam(':pw', $hash);
                $in->bindParam(':usr', $id);
                if($in->execute()){

                        $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$id', activity='Change of personal password ', created=now()");
                        $inx->execute();

                        echo"
                        <br><br><br><br><br><br><br><br><br>
                        <div style='width:100%;text-align:center;vertical-align:bottom'>
                                <div class='loader'></div>
                                <br>
                                <meta http-equiv='refresh' content='1;url=profile'>
                                <span class='itext' style='color: blueviolet;'>Processing. Please Wait...</span>
                        </div><br><br><br><br><br><br><br><br>";
                    }else{
                        $e="Something went wrong"; 
                        echo  " <script>alert('$e'); </script>";
                    } 
            }else{
                $e="You have entered wrong current password"; 
                echo  " <script>alert('$e'); </script>";
            }
            */
        }
        
        
        
       
    //}
    
    
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
                
                
                
                
                
                
                <div class="profile-cover-wrap overlay-wrap">
                     <div class="profile-cover-img" style="background-image:url('../dist/img/trans-bg.jpg')"></div>
                        <div class="bg-overlay bg-trans-dark-60"></div>
                        <div class="container profile-cover-content py-50">
                                <div class="hk-row"> 
                                        <div class="col-lg-6">
                                                <div class="media align-items-center">
                                                        <div class="media-img-wrap  d-flex">
                                                                <div class="avatar">
                                                                        <img src="../dist/img/avatar12.jpg" alt="user" class="avatar-img rounded-circle">
                                                                </div>
                                                        </div>
                                                        <div class="media-body">
                                                                <div class="text-white text-capitalize display-6 mb-5 font-weight-400"><?php echo $nam; ?></div>
                                                                <div class="font-14 text-white"><span class="mr-5"><span class="font-weight-500 pr-5">Joined</span><span class="mr-5"><?php echo $join; ?></span></span><span></span></div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="button-list">
                                                        <a href="#" class="btn btn-dark btn-wth-icon icon-wthot-bg btn-rounded"><span class="btn-text"><?php echo $phone; ?></span><span class="icon-label"><i class="icon icon-phone"></i> </span></a>
                                                       <!-- <a href="#" class="btn btn-icon btn-icon-circle btn-indigo btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                                                        <a href="#" class="btn btn-icon btn-icon-circle btn-sky btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                                                        <a href="#" class="btn btn-icon btn-icon-circle btn-purple btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-instagram"></i></span></a>-->
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div><hr/>
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h4 class="hk-pg-title font-weight-600 mb-10">Summary</h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                        <section class="hk-sec-wrapper">
                            Employee's Information<hr/>
                            <label>Change Password</label>
                            <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <input type="password" class="form-control" id="validationCustom01" name="old" placeholder="Enter Current Paasword"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="password" class="form-control" id="validationCustom01" name="new" placeholder="Enter New Password"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="password" class="form-control" id="validationCustom01" name="confirm" placeholder="Confirm Password"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                            <button class="btn btn-primary btn-block" type="submit" name="save">Change</button>
                            </div>
                        </form>
                        </section>
                    </div>
                    <div class="col-xl-9">
                        <section class="hk-sec-wrapper">
                                 <div class="table-wrap">
                                            <div class="table-responsive">
                                                <label class="btn btn-primary">Employee Salary Components</label><hr/>
                                                    <table class="table table-sm table-hover mb-0">
                                                            <thead>
                                                                    <tr>
                                                                            <th>S/N</th>
                                                                            <th>Salary Component</th>
                                                                            <th>Value</th>
                                                                            <th width="20%">Action</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $qx=  dbConnect()->prepare("SELECT * FROM emp_salary WHERE userID='$id'");
                                                                $qx->execute();
                                                                $counter =0;
                                                                while($ro=$qx->fetch()){
                                                                    $gr=$ro['id'];
                                                                    $cid=$ro['component'];
                                                                    
                                                                    $q2=  dbConnect()->prepare("SELECT component FROM salaryComponent WHERE id='$cid' ");
                                                                    $q2->execute();
                                                                    $u=$q2->fetch();
                                                                    
                                                                    $compp=$u['component'];
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $compp; ?></td>
                                                                            <td><?php echo $ro['value']; ?></td>
                                                                            <td>
                                                                                <a class="btn btn-danger" style="color: white;" title="Delete"><i class="icon icon-trash"></i></a>
                                                                            </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                    </table>
                                            </div>
                                    </div>
                                    <div class="table-responsive"><br/>
                                        <label class="btn btn-primary">Employee Deductions</label><hr/>
                                        <table class="table table-sm table-hover mb-0">
                                                <thead>
                                                        <tr>
                                                                <th>S/N</th>
                                                                <th>Salary Deduction</th>
                                                                <th>Rate</th>
                                                                <th>Value</th>
                                                                <th width="20%">Action</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $qx=  dbConnect()->prepare("SELECT * FROM dedComponent WHERE userID='$id'");
                                                    $qx->execute();
                                                    $counter =0;
                                                    while($ro=$qx->fetch()){
                                                        $gr=$ro['id'];
                                                        $sded=$ro['deduction'];
                                                        $rate = $ro['value'];
                                                        $amt = $ro['amount'];
                                                        $rValue =($rate/100) * $sala;

                                                        /*
                                                        $y=  dbConnect()->prepare("SELECT component FROM salaryComponent WHERE id='$cid' ");
                                                        $y->execute();
                                                        $v=$q2->fetch();

                                                        $compp=$u['component'];  */
                                                    ?>
                                                        <tr>
                                                                <td><?php echo ++$counter; ?></td>
                                                                <td><?php  echo $sded; ?></td>
                                                                <td><?php echo $ro['value']."%"; ?></td>
                                                                <td><?php  echo $rValue; ?></td>
                                                                <td>
                                                                    <a class="btn btn-danger" style="color: white;" title="Delete"><i class="icon icon-trash"></i></a>
                                                                </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                        </table>
                                    </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
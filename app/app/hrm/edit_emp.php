<?php 
include 'nav.php'; 

if(isset($_GET['id'])){
    $id =$_GET['id'];
}
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

if(isset($_POST['save'])){
    
    if(empty($_POST['fname'])){
        $e="Please fill in employee's first name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['lname'])){
        $e="Please fill in employee's last name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['email'])){
        $e="Please fill in employee's email"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['phone'])){
        $e="Please fill in employee's phone number"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['address'])){
        $e="Please fill in employee's contact address"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['dob'])){
        $e="Please fill in employee's date of birth"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['job'])){
        $e="Please select employee's job specification"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['grade'])){
        $e="Please fill in employee's grade level"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    else{
        $fn=  check_input($_POST['fname']);
        $ln=  check_input($_POST['lname']);
        $on=  check_input($_POST['oname']);
        $ph=  check_input($_POST['phone']);
        $em=  check_input($_POST['email']);
        $gr=  check_input($_POST['grade']);
        $jb=  check_input($_POST['job']);
        $dob=  check_input($_POST['dob']);
        $ad=  check_input($_POST['address']);
        $gn=  check_input($_POST['gender']);
        $mr=  check_input($_POST['marital']);
        
        /*
        //Next of kin
        $nfn=  check_input($_POST['nfname']);
        $nln=  check_input($_POST['nlname']);
        $nad=  check_input($_POST['naddress']);
        $nph=  check_input($_POST['nphone']);
        $nem=  check_input($_POST['nemail']);
        
        */
        
        $dt= date('Y-m-d');
        $user = $uid;
        
        
        
        
        $in=dbConnect()->prepare("UPDATE users SET fname=:fn, lname=:ln, email=:em WHERE userID=:usr ");
        $in->bindParam(':fn', $fn);
        $in->bindParam(':ln', $ln);
        $in->bindParam(':em', $em);
        $in->bindParam(':usr', $id);
        //$in->bindParam(':pw', $hash);
        //$in->bindParam(':rol', $role);
        //$in->bindParam(':dt', $dt);
        //$in->bindParam(':by', $user);
        if($in->execute()){

            $inn=dbConnect()->prepare("UPDATE employee SET dob=:dob, fname=:fn, lname=:ln, email=:em, oname=:on, phone=:ph, gender=:gn, marital=:mr, job=:jb, grade=:gr, address=:ad WHERE userID=:usr");
            $inn->bindParam(':usr', $id);
            $inn->bindParam(':fn', $fn);
            $inn->bindParam(':ln', $ln);
            $inn->bindParam(':em', $em);
            $inn->bindParam(':on', $on);
            $inn->bindParam(':ph', $ph);
            $inn->bindParam(':jb', $jb);
            $inn->bindParam(':mr', $mr);
            $inn->bindParam(':dob', $dob);
            $inn->bindParam(':gr', $gr);
            $inn->bindParam(':ad', $ad);
            $inn->bindParam(':gn', $gn);
           // $inn->bindParam(':dt', $dt);
           // $inn->bindParam(':by', $user);
            
            $up=dbConnect()->prepare("UPDATE emp_salary SET grade='$gr' WHERE userID='$id'");
            $up->execute();
            
            $up1=dbConnect()->prepare("UPDATE dedComponent SET grade='$gr' WHERE userID='$id'");
            $up1->execute();

        if($inn->execute()){

            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Modification of employee record $fn, $ln  by userID $uid', created=now() ");
            $in->execute();


            echo"
                <br><br><br><br><br><br><br><br><br>
                <div style='width:100%;text-align:center;vertical-align:bottom'>
                        <div class='loader'></div>
                        <br>
                        <meta http-equiv='refresh' content='1;url=employee'>
                        <span class='itext' style='color: blueviolet;'>Processing. Please Wait...</span>
                </div><br><br><br><br><br><br><br><br>";


        }
        else{
            $e="Could not process Employee Record"; 
            echo  " <script>alert('$e'); </script>";
            }

        }
        else{
            $e="Could not create employee profile"; 
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

        <!-- Container -->
    <div class="container">
        <!-- Row -->
        <div class="col-sm">
            <form class="needs-validation" method="POST" novalidate>
                <div class="col-xl-12 mb-20">
                       <h3>
                            <span class="wizard-icon-wrap"><i class="ion ion-ios-person"></i></span>
                            <span class="wizard-head-text-wrap">
                                    <span class="step-head">Update Employee Information</span>
                            </span>	
                        </h3><hr/>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="firstName">First name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon icon-user"></i></span>
                                    </div>
                                    <input class="form-control" id="firstName" name="fname" value="<?php echo $rw['fname']; ?>" type="text" required>
                                </div>
                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lastName">Last name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon icon-user"></i></span>
                                    </div>
                                    <input class="form-control" id="lastName" name="lname" value="<?php echo $rw['lname']; ?>" type="text" required>
                                </div>
                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="OtherName">Other name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon icon-user"></i></span>
                                    </div>
                                    <input class="form-control" id="otherName" name="oname" value="<?php echo $rw['oname']; ?>" type="text" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-10">
                                <label for="phone">Phone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon icon-phone"></i></span>
                                    </div>
                                    <input class="form-control" name="phone" value="<?php echo $rw['phone']; ?>" type="text" required />
                                </div>
                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                            </div>
                            <div class="col-md-4 mb-10">
                                <label for="dob">Date of Birth</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon icon-calender"></i></span>
                                    </div>
                                    <input class="form-control" name="dob" value="<?php echo $rw['dob']; ?>" type="date" required>
                                </div>
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                            </div>

                            <div class="col-md-4 mb-10">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control custom-select d-block w-100" id="country" required>
                                    <option><?php echo $rw['gender']; ?></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                            </div>
                            <div class="col-md-4 mb-10">
                                <label for="marital">Marital Status</label>
                                <select name="marital" class="form-control custom-select d-block w-100" id="state" required>
                                    <option><?php echo $rw['marital']; ?></option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Divorced</option>
                                    <option>Widow</option>
                                    <option>Widower</option>
                                </select>
                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                            </div>
                            <div class="col-md-4 mb-10">
                                <label for="job">Job Title</label>
                                <select name="job" class="form-control custom-select d-block w-100" id="job" required>
                                    <option value="<?php echo $rw['job']; ?>"><?php echo $jb; ?></option>
                                    <?php
                                    $jb=  dbConnect()->prepare("SELECT * FROM job");
                                    $jb->execute();
                                    while($r=$jb->fetch()){
                                    ?>
                                    <option value="<?php echo $r['id'];?>"><?php echo $r['job'];?></option>
                                    <?php } ?>
                                </select>
                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                            </div>
                            <div class="col-md-4 mb-10">
                                <label for="grade">Pay Grade</label>
                                <select name="grade" class="form-control custom-select d-block w-100" id="state" required>
                                    <option value="<?php echo $grd; ?>"><?php echo $grade; ?></option>
                                    <?php
                                    $gb=  dbConnect()->prepare("SELECT * FROM grade");
                                    $gb->execute();
                                    while($r1=$gb->fetch()){
                                    ?>
                                    <option value="<?php echo $r1['id'];?>"><?php echo $r1['grade'];?></option>
                                    <?php } ?>
                                </select>
                                <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon icon-envelope"></i></span>
                                </div>
                                <input class="form-control" id="email" name="email" value="<?php echo $rw['email']; ?>" type="email" required>
                            </div>
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon icon-location-pin"></i></span>
                                </div>
                                <input class="form-control" name="address" id="address" value="<?php echo $rw['address']; ?>"  type="text" required>
                            </div>
                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                        </div>
                </div><br/>
                <!--
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
                                <input class="form-control" id="firstName" name="nfname" type="text">
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="lastName">Last name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon icon-user"></i></span>
                                    </div>
                                    <input class="form-control" id="lastName" name="nlname" type="text">
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
                                <input class="form-control" id="username" name="nphone" type="text">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon icon-envelope"></i></span>
                                </div>
                                <input class="form-control" id="username" name="nemail" type="email">
                            </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon icon-location-pin"></i></span>
                                    </div>
                                    <input class="form-control" id="address" name="naddress" placeholder="Address" type="text">
                            </div>
                        </div>
                </div>-->
                <button class="btn btn-primary" type="submit" name="save">update Employee</button>
            </form>
        </div>            
</div>
<!-- /Container -->
<!-- /Container -->
<?php include 'foot.php';?>
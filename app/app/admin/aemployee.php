<?php 
include 'nav.php'; 
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
    elseif(empty($_POST['branch'])){
        $e="Please select a branch"; 
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
        $brn=  check_input($_POST['branch']);
        
        //Next of kin
        $nfn=  check_input($_POST['nfname']);
        $nln=  check_input($_POST['nlname']);
        $nad=  check_input($_POST['naddress']);
        $nph=  check_input($_POST['nphone']);
        $nem=  check_input($_POST['nemail']);
        
        
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(userID) AS no FROM employee WHERE email='$em'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
            //Password Encryption
            $pas= "pass";
            $options = [
                'cost' => 12,
            ];
            $hash= password_hash($pas, PASSWORD_BCRYPT, $options);
            
            //Geting the job specification for creating user role
            $jbd =   dbConnect()->prepare("SELECT * FROM job WHERE id='$jb' ");
            $jbd->execute();
            $jo=$jbd->fetch();
            $role=$jo['job'];
            
            $in=dbConnect()->prepare("INSERT INTO users SET fname=:fn, lname=:ln, email=:em, password=:pw, role=:rol, created=:dt, createdby=:by, branch=:brn ");
            $in->bindParam(':fn', $fn);
            $in->bindParam(':ln', $ln);
            $in->bindParam(':em', $em);
            $in->bindParam(':pw', $hash);
            $in->bindParam(':rol', $role);
            $in->bindParam(':dt', $dt);
            $in->bindParam(':by', $user);
            $in->bindParam(':brn', $brn);
            if($in->execute()){
                
                $q=  dbConnect()->prepare("SELECT userID FROM users WHERE email='$em'");
                $q->execute();
                $r=$q->fetch();
                $usr_id = $r['userID'];
                
                $inn=dbConnect()->prepare("INSERT INTO employee SET userID=:usr, dob=:dob, fname=:fn, lname=:ln, email=:em, oname=:on, phone=:ph, gender=:gn, marital=:mr, job=:jb, grade=:gr, address=:ad, branch=:brn, created=:dt, createdby=:by ");
                $inn->bindParam(':usr', $usr_id);
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
                $inn->bindParam(':dt', $dt);
                $inn->bindParam(':by', $user);
                $inn->bindParam(':brn', $brn);
            
            if($inn->execute()){
                
                $nn=dbConnect()->prepare("INSERT INTO next_kin SET fname=:fn, lname=:ln, email=:em, employee=:emp, phone=:ph, address=:ad");
                $nn->bindParam(':fn', $nfn);
                $nn->bindParam(':ln', $nfn);
                $nn->bindParam(':em', $nem);
                $nn->bindParam(':emp', $usr_id);
                $nn->bindParam(':ph', $nph);
                $nn->bindParam(':ad', $nad);
                if($nn->execute()){
                    
                    $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of Employee profile $fn, $ln  by userID $uid', created=now()");
                    $inx->execute();
                    
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
                    $e="Could not process Next of Kin Record"; 
                    echo  " <script>alert('$e'); </script>";
                }
            }
        
                
            }
        else{
        $e="Could not process Employee Record"; 
        echo  " <script>alert('$e'); </script>";
        }
            
        }else{
            $e="Employee Record already exists"; 
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
                                            <span class="step-head">Employee Information</span>
                                    </span>	
                                </h3><hr/>
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="firstName">First name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="fname" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="lastName">Last name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                            </div>
                                            <input class="form-control" id="lastName" name="lname" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="OtherName">Other name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                            </div>
                                        <input class="form-control" id="otherName" name="oname" type="text" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-10">
                                        <label for="phone">Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="phone"></i></span>
                                            </div>
                                        <input class="form-control" name="phone" type="text" required />
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-4 mb-10">
                                        <label for="dob">Date of Birth</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="calendar"></i></span>
                                            </div>
                                        <input class="form-control" name="dob" type="date" required>
                                        </div>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-10">
                                        <label for="gender">Gender</label>
                                        <select name="gender" class="form-control custom-select d-block w-100" id="country" required>
                                            <option value="">Choose...</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-4 mb-10">
                                        <label for="marital">Marital Status</label>
                                        <select name="marital" class="form-control custom-select d-block w-100" id="state" required>
                                            <option value="">Choose...</option>
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
                                            <option value="">Choose...</option>
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
                                            <option value="">Choose...</option>
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
                                <div class="row">
                                <div class="form-group col-lg-8">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="file"></i></span>
                                        </div>
                                        <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                                    </div>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-4 mb-10">
                                        <label for="job">Branch</label>
                                        <select name="branch" class="form-control custom-select d-block w-100" id="job" required>
                                            <option value="">Choose...</option>
                                            <?php
                                            $jb=  dbConnect()->prepare("SELECT * FROM branch");
                                            $jb->execute();
                                            while($r=$jb->fetch()){
                                            ?>
                                            <option value="<?php echo $r['id'];?>"><?php echo $r['branch'];?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="map"></i></span>
                                        </div>
                                        <input class="form-control" name="address" id="address" placeholder="1234 Main St"  type="text" required>
                                    </div>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                        </div><br/>

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
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                            </div>
                                        <input class="form-control" id="firstName" name="nfname" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="lastName">Last name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
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
                                            <span class="input-group-text"><i data-feather="phone"></i></span>
                                        </div>
                                        <input class="form-control" id="username" name="nphone" type="text">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">Email</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="file"></i></span>
                                        </div>
                                        <input class="form-control" id="username" name="nemail" type="email">
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i data-feather="map"></i></span>
                                            </div>
                                            <input class="form-control" id="address" name="naddress" placeholder="Address" type="text">
                                    </div>
                                </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="save">Create Employee</button>
                    </form>
                </div>
                
                
                
                
                
                
                
            </div>
            <!-- /Container -->
            <!-- /Container -->
            <?php include 'foot.php'; ?>
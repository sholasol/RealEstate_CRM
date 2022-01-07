<?php 
include 'nav.php'; 
$date = date('d-m-Y');
$mont=date('m');
$yar=date('Y');
if(isset($_POST['save'])){
    
    if(empty($_POST['loan'])){
        $e="Please fill in employee's first name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['term'])){
        $e="Please fill in employee's last name"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['type'])){
        $e="Select Loan Type "; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['purpose'])){
        $e="Please fill in employee's phone number"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['mode'])){
        $e="Please fill in employee's contact address"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    
    else{
        $amt=  check_input($_POST['loan']);
        $term=  check_input($_POST['term']);
        $type=  check_input($_POST['type']);
        $purp=  check_input($_POST['purpose']);
        $mode=  check_input($_POST['mode']);
        
        
        
        $dt= date('Y-m-d');
        $user = $uid;
        
        
        
        $in=dbConnect()->prepare("INSERT INTO loan SET userID=:usr, amount=:amt, term=:tm, type=:type, repay=:rep, purpose=:pur, created=:dt, branch=:bran, month=:mn, year=:yr ");
        $in->bindParam(':amt', $amt);
        $in->bindParam(':usr', $user);
        $in->bindParam(':tm', $term);
        $in->bindParam(':rep', $mode);
        $in->bindParam(':type', $type);
        $in->bindParam(':pur', $purp);
        $in->bindParam(':dt', $dt);
        $in->bindParam(':mn', $mont);
        $in->bindParam(':yr', $yar);
        $in->bindParam(':bran', $branch);
        if($in->execute()){
            
            $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Application for Loan  by userID $uid', created=now()");
            $inx->execute();

            echo"
            <br><br><br><br><br><br><br><br><br>
            <div style='width:100%;text-align:center;vertical-align:bottom'>
                    <div class='loader'></div>
                    <br>
                    <meta http-equiv='refresh' content='1;url=loan'>
                    <span class='itext' style='color: blueviolet;'>Processing. Please Wait...</span>
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
                                    <span class="wizard-icon-wrap"><i class="ion ion-ios-cash"></i></span>
                                    <span class="wizard-head-text-wrap">
                                            <span class="step-head">Loan Request</span>
                                    </span>	
                                </h3><hr/>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="loamAmount">Loan Amount</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-dollar"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="loan" type="number" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                     <div class="col-md-6 form-group">
                                        <label for="OtherName">Loan Term</label>
                                        <select name="term" class="form-control custom-select d-block w-100" id="state" required>
                                            <option value="">Choose...</option>
                                            <?php
                                                for($x=1; $x < 48; $x++){
                                                    echo"<option value='$x'> $x month(s)</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="grade">Type (<small>Loan Type</small>)</label>
                                        <select name="type" class="form-control custom-select d-block w-100" id="state" required>
                                            <option value="">Choose...</option>
                                            <?php
                                            $ty=  dbConnect()->prepare("SELECT * FROM loan_type");
                                            $ty->execute();
                                            while($r=$ty->fetch()){
                                                $lt=$r['type'];
                                                $lid=$r['id'];
                                                echo"<option value='$lid'> $lt</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="grade">Repayment Mode</label>
                                        <select name="mode" class="form-control custom-select d-block w-100" id="state" required>
                                            <option value="">Choose...</option>
                                            <option>Weekly</option>
                                            <option>Monthly</option>
                                            <option>Yearly</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="grade">Loan Purpose</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="purpose" placeholder="Loan Purpose" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                
                        <button class="btn btn-primary" type="submit" name="save">Request Loan</button>
                        </div>
                    </form>
                </div>
                
                
                
                
                
                
                
            </div>
            <!-- /Container -->
            <!-- /Container -->
            <?php include 'foot.php'; ?>
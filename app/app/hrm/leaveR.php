<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    if(empty($_POST['purpose'])){
        $e="Please state the reason for the leave"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['start'])){
        $e="Please fill in start date"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['end'])){
        $e="Please fill in return date"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['type'])){
        $e="Please select leave type"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    else{
        $purp=  check_input($_POST['purpose']);
        $stat=  check_input($_POST['start']);
        $end=  check_input($_POST['end']);
        $type=  check_input($_POST['type']);
        
        $dt= date('Y-m-d');
        $user = $uid;
        $brn = $branch;
        
        
        
        $in=dbConnect()->prepare("INSERT INTO leaves SET userID=:usr, purpose=:purp, type=:type, start=:start, end=:end, created=:dt, branch=:brn ");
        
        $in->bindParam(':purp', $purp);
        $in->bindParam(':type', $type);
        $in->bindParam(':start', $stat);
        $in->bindParam(':end', $end);
        $in->bindParam(':usr', $user);
        $in->bindParam(':dt', $dt);
        $in->bindParam(':brn', $brn);
        if($in->execute()){
            
            $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Leave application  by userID $uid', created=now()");
            $inx->execute();

            echo"
            <br><br><br><br><br><br><br><br><br>
            <div style='width:100%;text-align:center;vertical-align:bottom'>
                    <div class='loader'></div>
                    <br>
                    <meta http-equiv='refresh' content='1;url=leave'>
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
                                    <span class="wizard-icon-wrap"><i class="ion ion-ios-create"></i></span>
                                    <span class="wizard-head-text-wrap">
                                            <span class="step-head">Leave Request</span>
                                    </span>	
                                </h3><hr/>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="grade">Travel Purpose</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="purpose" placeholder="Leave Purpose/Reason" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="loamAmount">Start Date </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-calender"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="start" type="date" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="loamAmount">End Date </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-calender"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="end" type="date" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                     <div class="col-md-4 form-group">
                                        <label for="OtherName">Leave Type</label>
                                        <select name="type" class="form-control custom-select d-block w-100" id="state" required>
                                            <option value="">Choose...</option>
                                            <?php
                                                $md=dbConnect()->prepare("SELECT * FROM leave_type");
                                                $md->execute();
                                                while($x=$md->fetch()){
                                                    $ty=$x['id']; 
                                                   $typ=$x['type'];  
                                                    echo"<option value='$ty'>  $typ </option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                        <button class="btn btn-primary" type="submit" name="save">Send Request</button>
                        </div>
                    </form>
                </div>
                
                
                
                
                
                
                
            </div>
            <!-- /Container -->
            <!-- /Container -->
            <?php include 'foot.php'; ?>
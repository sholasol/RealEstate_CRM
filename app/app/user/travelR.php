<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    if(empty($_POST['purpose'])){
        $e="Please travel purpose"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['from'])){
        $e="Please fill in travel start location"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['to'])){
        $e="Please fill in travel destination";
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['start'])){
        $e="Please fill in travel date"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['end'])){
        $e="Please fill in return date"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['mode'])){
        $e="Please select mode of transportation"; 
        echo  " <script>alert('$e'); </script>";
    }
    elseif(empty($_POST['amt'])){
        $e="Please fill in total travel expense"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    else{
        $purp=  check_input($_POST['purpose']);
        $from=  check_input($_POST['from']);
        $to=  check_input($_POST['to']);
        $stat=  check_input($_POST['start']);
        $end=  check_input($_POST['end']);
        $amt=  check_input($_POST['amt']);
        $mode=  check_input($_POST['mode']);
        
        $dt= date('Y-m-d');
        $user = $uid;
        $brn = $branch;
        
        
        
        $in=dbConnect()->prepare("INSERT INTO travel SET userID=:usr, fund=:amt, purpose=:pup, transportation=:tran, location=:loc, destination=:dest, travel_date=:start, return_date=:end, created=:dt, branch=:brn ");
        $in->bindParam(':amt', $amt);
        $in->bindParam(':pup', $purp);
        $in->bindParam(':tran', $mode);
        $in->bindParam(':loc', $from);
        $in->bindParam(':dest', $to);
        $in->bindParam(':start', $stat);
        $in->bindParam(':end', $end);
        $in->bindParam(':usr', $user);
        $in->bindParam(':dt', $dt);
        $in->bindParam(':brn', $brn);
        if($in->execute()){
            
            $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Application for travel request  by userID $uid', created=now()");
            $inx->execute();

            echo"
            <br><br><br><br><br><br><br><br><br>
            <div style='width:100%;text-align:center;vertical-align:bottom'>
                    <div class='loader'></div>
                    <br>
                    <meta http-equiv='refresh' content='1;url=travel'>
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
                                    <span class="wizard-icon-wrap"><i class="ion ion-ios-airplane"></i></span>
                                    <span class="wizard-head-text-wrap">
                                            <span class="step-head">Travel Request</span>
                                    </span>	
                                </h3><hr/>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="grade">Travel Purpose</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="purpose" placeholder="Travel Purpose" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="loamAmount">Travel From </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-location-pin"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="from" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="loamAmount">Travel to </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-location-pin"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="to" type="text" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="loamAmount">Travel Date </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-calender"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="start" type="date" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="loamAmount">Return Date </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-calender"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="end" type="date" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                     <div class="col-md-6 form-group">
                                        <label for="OtherName">Mode of Transportation</label>
                                        <select name="mode" class="form-control custom-select d-block w-100" id="state" required>
                                            <option value="">Choose...</option>
                                            <?php
                                                $md=dbConnect()->prepare("SELECT * FROM mode_of_transportation");
                                                $md->execute();
                                                while($r= $md->fetch()){
                                                    $id=$r['id']; 
                                                   $mode=$r['mode'];  
                                                    echo "<option value='$id'> $mode </option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="loamAmount">Total Fund Proposed </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-location-pin"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="amt" type="number" step="0.1" required>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
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
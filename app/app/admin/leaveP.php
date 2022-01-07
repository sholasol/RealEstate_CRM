<?php 
include 'nav.php'; 
if(isset($_GET['id'])){
    $lid=$_GET['id'];
}

$tr=  dbConnect()->prepare("SELECT * FROM leaves WHERE id='$lid'");
$counter=0;
$tr->execute();
$r=$tr->fetch();
$typ =$r['type'];


if(isset($_POST['decline'])){
    
    if(empty($_POST['reason'])){
        $e="Please state the reason for declining"; 
        echo  " <script>alert('$e'); </script>";
    }
    
    else{
        $reason=  check_input($_POST['reason']);
        
        $dt= date('Y-m-d');
        $user = $uid;
        $brn = $branch;
        
        
        
        $in=dbConnect()->prepare("UPDATE leaves SET status='Decline', reason='$reason' WHERE id='$lid' ");
        if($in->execute()){
            
            $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Leave application decline by userID $uid', created=now()");
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

if(isset($_POST['save'])){
        
        $in=dbConnect()->prepare("UPDATE leaves SET status='Approved' WHERE id='$lid' ");
        if($in->execute()){
            
            $inx= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Leave application approved by userID $uid', created=now()");
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
                                            <span class="step-head">Processing Leave Request</span>
                                    </span>	
                                </h3><hr/>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="grade">Travel Purpose</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="purpose" value="<?php echo $r['purpose'] ?>" type="text" disabled>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="loamAmount">Start Date </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-calender"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="start" type="date" value="<?php echo $r['start'] ?>" disabled>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="loamAmount">End Date </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="icon icon-calender"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="end" type="date" value="<?php echo $r['end'] ?>" disabled>
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                     <div class="col-md-4 form-group">
                                        <label for="OtherName">Leave Type</label>
                                        <select name="type" class="form-control custom-select d-block w-100" id="state" disabled>
                                            <?php
                                                $md=dbConnect()->prepare("SELECT * FROM leave_type WHERE id='$typ'");
                                                $md->execute();
                                                while($x=$md->fetch()){
                                                    $ty=$x['id']; 
                                                   $typ=$x['type'];  
                                                    echo"<option value='$ty'>  $typ </option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="grade">Reason for Declining</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-list-alt"></i></span>
                                            </div>
                                            <input class="form-control" id="firstName" name="reason" placeholder="Reason for Declining " type="text">
                                        </div>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                </div>
                                
                        <button class="btn btn-danger" type="submit" name="decline">Decline Request</button>
                        <button class="btn btn-success" type="submit" name="save">Approve Request</button>
                        </div>
                    </form>
                </div>
                
                
                
                
                
                
                
            </div>
            <!-- /Container -->
            <!-- /Container -->
            <?php include 'foot.php'; ?>
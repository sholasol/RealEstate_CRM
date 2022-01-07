<?php 
include 'nav.php'; 

$yr= date('Y');

if(isset($_POST['save'])){
    
    if(empty($_POST['start'])){
        $e="Please enter a start date "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['end'])){
        $e="Please enter an end date "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $st = check_input($_POST["start"]);
        $en = check_input($_POST["end"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM fyear WHERE year='$yr'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
        $q=  dbConnect()->prepare("INSERT INTO fyear SET start=:st, end=:en, year=:yr, created=:dt, createdby=:by ");
        $q->bindParam(':st', $st);
        $q->bindParam(':en', $en);
        $q->bindParam(':yr', $yr);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of financial year ($yr) by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=fyear'>
                            <span class='itext' style='color: blueviolet;'>Creating Financial Year. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
            
        }else{
            $e="Operation Failed"; 
            echo  " <script>alert('$e'); </script>";
        }
            
        }else{
            $e="Financial year already exists"; 
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
            <?php 
            $fy=dbConnect()->prepare("SELECT * FROM fyear WHERE year='$yr'");
            $fy->execute();
            $n =$fy->rowCount();
            $ro=$fy->fetch();
            ?>
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h4 class="hk-pg-title font-weight-600 mb-10">Financial Year</h4>
                        <small><?php if($n < 1){ echo 'Financial Year for the year ('.$yr.') has not been set';} ?></small>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                        
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <span class="btn btn-blue btn-block">Start: <?php echo $ro['start']; ?></span>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <span class="btn btn-warning btn-block">End: <?php echo $ro['end']; ?></span>
                                </div>
                                <button class="btn btn-gradient-info btn-block" > Current Financial Year</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-9">
                        <section class="hk-sec-wrapper">
                           <div class="row">
                                <div class="col-sm">
                                    <form class="needs-validation" method="post" novalidate>
                                         <div class="col-xl-12 mb-20">
                                                    <h3>
                                                         <span class="wizard-icon-wrap"><i class="ion ion-ios-calendar"></i></span>
                                                         <span class="wizard-head-text-wrap">
                                                                 <span class="step-head">Financial Year</span>
                                                         </span>	
                                                     </h3><hr/>
                                                     <div class="row">
                                                         <div class="col-md-6 form-group">
                                                             <label for="firstName">Fiscal Year Start</label>
                                                             <div class="input-group">
                                                                 <div class="input-group-prepend">
                                                                     <span class="input-group-text"><i class="icon icon-calender"></i></span>
                                                                 </div>
                                                                 <input class="form-control" type="date" name="start" placeholder="YYYY-MM-DD" required />
                                                             </div>
                                                             <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                         </div>
                                                         <div class="col-md-6 form-group">
                                                             <label for="firstName">Fiscal Year End</label>
                                                             <div class="input-group">
                                                                 <div class="input-group-prepend">
                                                                     <span class="input-group-text"><i class="icon icon-calender"></i></span>
                                                                 </div>
                                                                 <input class="form-control" type="date" name="end" placeholder="YYYY-MM-DD" required />
                                                             </div>
                                                             <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                                         </div>
                                                     </div>  
                                                     
                                             </div>
                                        <button class="btn btn-primary" type="submit" name="save">Create Financial Year</button>
                                    </form>
                                </div>
                            </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>

            
            
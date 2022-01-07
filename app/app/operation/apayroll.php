<?php 
include 'nav.php'; 
$dd=date('m');
$dat= date('F');
$yr=date('Y');


if(isset($_POST['save'])){
    
    if(empty($_POST['month'])){
        $e="Please select a month"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $mnt = check_input($_POST["month"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        
     $mp=  dbConnect()->prepare("SELECT * FROM employee WHERE status='Active'"); 
     $mp->execute();
     while($r=$mp->fetch()){
         $gg=$r['grade'];
         $jj=$r['job'];
         $usr=$r['userID'];
         
        $basicSal=0;
        //Getting employee basic salary
        $sl=dbConnect()->prepare("SELECT component, value FROM salaryComponent WHERE grade='$gg' AND job='$jj'");
        $sl->execute();
        $rx=$sl->fetch();
        $scomp= $rx['component'];
        if($scomp =='Basic Salary'){
            $sala= $rx['value'];
            $basicSal +=$sala;
        }
        
        $slCm=dbConnect()->prepare("SELECT sum(value) AS value FROM emp_salary WHERE userID='$usr' AND grade='$gg' AND job='$jj'");
        $slCm->execute() ;
        $ru=$slCm->fetch();
        
        $totSal = $ru['value'];
        
        $ben= $totSal - $basicSal;
        
        $totDed = 0;
        $slDed=dbConnect()->prepare("SELECT deduction, value FROM dedComponent WHERE userID='$usr'");
        $slDed->execute() ;
        while($rc=$slDed->fetch()){
        $rate=$rc['value'];
        $rValue =($rate/100) * $sala;
        $totDed +=$rValue;
        }
        
        $netSal = $totSal - $totDed;
        
        
        /*
        //Checking if the salary for the month had been set earlier
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM emp_pay WHERE month='$dd' AND year='$yr' ");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
        }
        else{
            $e="Salary for the month of $dat already exists"; 
            echo  " <script>alert('$e'); </script>";
        }
        */
        //Populating Emp_pay (Employee payroll table)
        
        $q=  dbConnect()->prepare("INSERT INTO emp_pay SET userID=:usr, gross=:gross, basic=:bs, benefit=:ben, deduction=:ded,net=:net, month=:mn, year=:yr,  grade=:grade,  job=:jb,  created=:dt, createdby=:by, branch=:bran ");
        $q->bindParam(':usr', $usr);
        $q->bindParam(':gross', $totSal);
        $q->bindParam(':net', $netSal);
        $q->bindParam(':bs', $sala);
        $q->bindParam(':ben', $ben);
        $q->bindParam(':ded', $totDed);
        $q->bindParam(':mn', $dd);
        $q->bindParam(':yr', $yr);
        $q->bindParam(':grade', $gg);
        $q->bindParam(':jb', $jj);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        $q->bindParam(':bran', $branch);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of Salary Schedule for month of $dat by user with userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=apayroll'>
                            <span class='itext' style='color: blueviolet;'>Please Wait! Processing Schedule. ...</span>
                    </div><br><br><br><br><br><br><br><br>";
            
        }
        else{
            $e="Operation failed. Could not process monthly salary schedule"; 
            echo  " <script>alert('$e'); </script>";
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
                        <h4 class="hk-pg-title font-weight-600 mb-10"><i class="fa fa-calendar"></i>  Monthly Payroll Schedule </h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <select name="month" class="form-control custom-select d-block w-100" id="country" required>
                                        <option value="<?php echo $dd; ?>"><?php echo $dat; ?></option>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <?php
                                $chk=  dbConnect()->prepare("SELECT count(id) AS count FROM emp_pay WHERE month='$dd'");
                                $chk->execute();
                                $f=$chk->fetch();
                                $cc=$f['count'];
                                if($cc > 1){
                                    echo "   <button class='btn btn-primary btn-block' type='submit' name='save' disabled><i class='icon icon-refresh'></i> Generate Schedule</button>";
                                }else{
                                 echo "   <button class='btn btn-primary btn-block' type='submit' name='save' ><i class='icon icon-refresh'></i> Generate Schedule</button>";
                                }
                                ?>
                                
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-9">
                        <section class="hk-sec-wrapper">
                                 <div class="table-wrap">
                                            <div class="table-responsive">
                                                    <table class="table table-sm table-hover mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>S/N</th>
                                                                    <th>Employee</th>
                                                                    <th>Gross Salary</th>
                                                                    <th>Benefits</th>
                                                                    <th>Deductions</th>
                                                                    <th>Net</th>
                                                                    <th width="10%">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM emp_pay WHERE month='$dd'");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $gr=$ro['grade'];
                                                                    $jbl=$ro['job'];
                                                                    $u=$ro['userID'];
                                                                    
                                                                    $empN = dbConnect()->prepare("SELECT * FROM users WHERE userID='$u'");
                                                                    $empN->execute();
                                                                    $x= $empN->fetch();
                                                                    $empName=$x['fname']." ".$x['lname'];
                                                                    
                                                                    
                                                                    $gg=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$gr' ");
                                                                    $gg->execute();
                                                                    $rr=$gg->fetch();
                                                                    $grade =$rr['grade'];
                                                                    
                                                                    $gg1=  dbConnect()->prepare("SELECT job FROM job WHERE id='$jbl' ");
                                                                    $gg1->execute();
                                                                    $rr1=$gg1->fetch();
                                                                    $spec =$rr1['job'];
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $empName; ?></td>
                                                                            <td><?php echo $ro['gross']; ?></td>
                                                                            <td><?php echo $ro['benefit']; ?></td>
                                                                            <td><?php echo $ro['deduction']; ?></td>
                                                                            <td><?php echo $ro['net']; ?></td>
                                                                            <td>
                                                                                <a class="btn btn-danger" style="color: white;" title="Delete"><i class="icon icon-trash"></i></a>
                                                                            </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                    </table>
                                            </div>
                                    </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
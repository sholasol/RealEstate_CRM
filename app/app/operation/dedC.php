<?php 
include 'nav.php';

if(isset($_GET['id'])){
    $id =$_GET['id'];
}
//$d=$id;

$epp=  dbConnect()->prepare("SELECT * FROM employee WHERE userID='$id' ");
$epp->execute();
$rw=$epp->fetch();

$nam=$rw['fname']." ".$rw['lname']." ".$rw['oname'];
$grd=$rw['grade'];
$job=$rw['job'];

$q=  dbConnect()->prepare("SELECT job FROM job WHERE id='$job'");
$q->execute();
$w=$q->fetch();
$jb=$w['job'];

$qq=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$grd'");
$qq->execute();
$x=$qq->fetch();
$grade=$x['grade'];

if(isset($_POST['save'])){
    
    if(empty($_POST['ded'])){
        $e="Please select salary deductions"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $ded = check_input($_POST["ded"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $gg=  dbConnect()->prepare("SELECT rate, deduction FROM emp_deduction WHERE id='$ded' ");
        $gg->execute();
        $rr=$gg->fetch();
        $vlu =$rr['rate'];
        $deduct =$rr['deduction'];
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM dedComponent WHERE userID='$id' AND deduction='$deduct'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
        $q=  dbConnect()->prepare("INSERT INTO dedComponent SET userID=:usr, grade=:grade, deduction=:ded, value=:vlu, job=:jb,  created=:dt, createdby=:by ");
        $q->bindParam(':grade', $grd);
        $q->bindParam(':ded', $deduct);
        $q->bindParam(':vlu', $vlu);
        $q->bindParam(':jb', $job);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':usr', $id);
        $q->bindParam(':by', $user);
            if($q->execute()){
                $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of Salary deduction $deduct for employee ($id) by userID with ID $uid', created=now()");
                $in->execute();

                echo"
                        <br><br><br><br><br><br><br><br><br>
                        <div style='width:100%;text-align:center;vertical-align:bottom'>
                                <div class='loader'></div>
                                <br>
                                <meta http-equiv='refresh' content='1;url=dedC?id=$id'>
                                <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                        </div><br><br><br><br><br><br><br><br>";

            }else{
                $e="Operation Failed"; 
                echo  " <script>alert('$e'); </script>";
            }
            
        }else{
            $e="The salary deduction you entered already exists"; 
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
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h4 class="hk-pg-title font-weight-600 mb-10"><?php echo $nam; ?></h4>
                        <label>Employee's Salary Deductions</label>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <select name="nam" class="form-control custom-select d-block w-100" id="country" disabled>
                                        <option value><?php echo $nam; ?></option>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <select name="grade" class="form-control custom-select d-block w-100" id="country" disabled>
                                        <option value><?php echo $grade; ?></option>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <select name="job" class="form-control custom-select d-block w-100" id="country" disabled>
                                        <option value><?php echo $jb; ?></option>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <select name="ded" class="form-control custom-select d-block w-100" id="country" required>
                                        <option value="">Select Component </option>
                                        <?php
                                        $gd=  dbConnect()->prepare("SELECT * FROM emp_deduction WHERE grade='$grd' ");
                                        $gd->execute();
                                        while($r=$gd->fetch()){
                                        ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['deduction']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                              <!--  <div class="col-md-12 mb-20">
                                    <input type="number" class="form-control" id="validationCustom01" name="value" placeholder="Component Value"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>-->
                            <button class="btn btn-primary btn-block" type="submit" name="save">Add</button>
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
                                                                            <th>Salary Deduction</th>
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
                                                                    
                                                                    /*
                                                                    $q2=  dbConnect()->prepare("SELECT component FROM salaryComponent WHERE id='$cid' ");
                                                                    $q2->execute();
                                                                    $u=$q2->fetch();
                                                                    
                                                                    $compp=$u['component'];  */
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php  echo $sded; ?></td>
                                                                            <td><?php echo $ro['value']."%"; ?></td>
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
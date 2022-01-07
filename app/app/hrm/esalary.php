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
    
    if(empty($_POST['comp'])){
        $e="Please select salary component"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $comp = check_input($_POST["comp"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $gg=  dbConnect()->prepare("SELECT value FROM salaryComponent WHERE id='$comp' ");
        $gg->execute();
        $rr=$gg->fetch();
        $vlu =$rr['value'];
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM emp_salary WHERE userID='$id' AND component='$comp'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
        $q=  dbConnect()->prepare("INSERT INTO emp_salary SET userID=:usr, grade=:grade, component=:cmp, value=:vlu, job=:jb,  created=:dt, createdby=:by ");
        $q->bindParam(':grade', $grd);
        $q->bindParam(':cmp', $comp);
        $q->bindParam(':vlu', $vlu);
        $q->bindParam(':jb', $job);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':usr', $id);
        $q->bindParam(':by', $user);
            if($q->execute()){
                $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of employee Salary  $comp for employee ($id) by userID with ID $uid', created=now()");
                $in->execute();

                echo"
                        <br><br><br><br><br><br><br><br><br>
                        <div style='width:100%;text-align:center;vertical-align:bottom'>
                                <div class='loader'></div>
                                <br>
                                <meta http-equiv='refresh' content='1;url=esalary?id=$id'>
                                <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                        </div><br><br><br><br><br><br><br><br>";

            }else{
                $e="Operation Failed"; 
                echo  " <script>alert('$e'); </script>";
            }
            
        }else{
            $e="Employee Salary you added already exists"; 
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
                        <label>Set Employee's Salary</label>
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
                                    <select name="comp" class="form-control custom-select d-block w-100" id="country" required>
                                        <option value="">Select Component </option>
                                        <?php
                                        $gd=  dbConnect()->prepare("SELECT * FROM salaryComponent WHERE grade='$grd' AND job='$job'");
                                        $gd->execute();
                                        while($r=$gd->fetch()){
                                        ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['component']; ?></option>
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
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
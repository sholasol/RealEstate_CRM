<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    if(empty($_POST['ded'])){
        $e="Please enter deduction"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['rate'])){
        $e="Please fill in tax rate"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['grade'])){
        $e="Please select employee grade"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $ded = check_input($_POST["ded"]);
        $grade = check_input($_POST["grade"]);
        $rate = check_input($_POST["rate"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM emp_deduction WHERE deduction='$ded' AND grade='$grade'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
        $q=  dbConnect()->prepare("INSERT INTO emp_deduction SET deduction=:ded, grade=:grade, rate=:rate, created=:dt, createdby=:by ");
        $q->bindParam(':ded', $ded);
        $q->bindParam(':grade', $grade);
        $q->bindParam(':rate', $rate);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of employee deduction ($ded) by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=deductionS'>
                            <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
            
        }else{
            $e="Operation Failed"; 
            echo  " <script>alert('$e'); </script>";
        }
            
        }else{
            $e="Employee deduction already exists"; 
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">Deductions</h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <select name="grade" class="form-control custom-select d-block w-100" id="country" required>
                                        <option value="">Select Grade...</option>
                                        <?php
                                        $gd=  dbConnect()->prepare("SELECT * FROM grade");
                                        $gd->execute();
                                        while($r=$gd->fetch()){
                                        ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['grade']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom01" name="ded" placeholder="Deductions"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <!--<label for="validationCustom02">Rate</label>-->
                                    <input type="number" class="form-control" id="validationCustom02" min="0" step="0.1" name="rate" placeholder="Tax Rate" required/>
                                </div>
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
                                                                            <th></th>
                                                                            <th>Grade</th>
                                                                            <th>Deductions</th>
                                                                            <th>Rate</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM emp_deduction");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $gr=$ro['grade'];
                                                                    
                                                                    $gg=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$gr' ");
                                                                    $gg->execute();
                                                                    $rr=$gg->fetch();
                                                                    $grade =$rr['grade'];
                                                                    
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $grade; ?></td>
                                                                            <td><?php echo $ro['deduction']; ?></td>
                                                                            <td><label class="badge badge-primary"><?php echo $ro['rate']."%"; ?></label></td>
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


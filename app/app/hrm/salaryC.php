<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    if(empty($_POST['grade'])){
        $e="Please enter a name for Grade"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['cmp'])){
        $e="Please enter component name "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['value'])){
        $e="Please enter component Value "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['job'])){
        $e="Please select Job Specification "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $grd = check_input($_POST["grade"]);
        $cmp = check_input($_POST["cmp"]);
        $vlu = check_input($_POST["value"]);
        $jb = check_input($_POST["job"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM salaryComponent WHERE component='$cmp' AND job='$jb' AND grade='$grd'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
        $q=  dbConnect()->prepare("INSERT INTO salaryComponent SET grade=:grade, component=:cmp, value=:vlu, job=:jb,  created=:dt, createdby=:by ");
        $q->bindParam(':grade', $grd);
        $q->bindParam(':cmp', $cmp);
        $q->bindParam(':vlu', $vlu);
        $q->bindParam(':jb', $jb);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of Salary Component $cmp for grade ($grd) by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=salaryC'>
                            <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
            
        }else{
            $e="Operation Failed"; 
            echo  " <script>alert('$e'); </script>";
        }
            
        }else{
            $e="Employee Grade already exists"; 
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">Salary Component</h4>
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
                                    <select name="job" class="form-control custom-select d-block w-100" id="country" required>
                                        <option value="">Job Specification </option>
                                        <?php
                                        $gd=  dbConnect()->prepare("SELECT * FROM job");
                                        $gd->execute();
                                        while($r=$gd->fetch()){
                                        ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['job']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom01" name="cmp" placeholder="Component"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="number" class="form-control" id="validationCustom01" name="value" placeholder="Component Value"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                            <button class="btn btn-primary btn-block" type="submit" name="save">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-9">
                        <section class="hk-sec-wrapper">
                                 <div class="table-wrap">
                                            <div class="table-responsive">
                                                    <table id="datable_1" class="table table-hover w-100 display pb-30">
                                                            <thead>
                                                                    <tr>
                                                                            <th>S/N</th>
                                                                            <th>Grade</th>
                                                                            <th>Specification</th>
                                                                            <th>Component</th>
                                                                            <th>Value</th>
                                                                            <th width="10%">Action</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM salaryComponent");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $gr=$ro['grade'];
                                                                    $jbl=$ro['job'];
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
                                                                            <td><?php echo $grade; ?></td>
                                                                            <td><?php echo $spec; ?></td>
                                                                            <td><?php echo $ro['component']; ?></td>
                                                                            <td><?php echo number_format($ro['value']); ?></td>
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
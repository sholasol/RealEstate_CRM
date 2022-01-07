<?php 
include 'nav.php'; 

$fm=$_GET['id'];

$q3=  dbConnect()->prepare("SELECT * FROM project WHERE id='$fm'");
$q3->execute();
$row=$q3->fetch();

if(isset($_POST['save'])){
    
    if(empty($_POST['family'])){
        $e="Please enter family name "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['head'])){
        $e="Please enter family head name "; 
        echo  " <script>alert('$e'); </script>"; 
    }elseif(empty($_POST['bale'])){
        $e="Please enter Baale's name "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $fam = check_input($_POST["family"]);
        $head = check_input($_POST["head"]); 
        $bale = check_input($_POST["bale"]);
        $sec = check_input($_POST["sec"]);
        $mem1 = check_input($_POST["mem1"]);
        $mem2 = check_input($_POST["mem2"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $qq=  dbConnect()->prepare("SELECT * FROM family WHERE family='$fam'");
        $qq->execute();
        $rw=$qq->fetch();
        $nub =$qq->rowCount();
        
        if($nub > 0){
            $in=  dbConnect()->prepare("INSERT INTO family SET project=:proj, family=:fm, head=:hd, baale=:bal, secretary=:sec, member1=:mem1, member2=:mem2, createdby=:by, created=:dt ");
        $in->bindParam(':proj', $fm);
        $in->bindParam(':fm', $fam);
        $in->bindParam(':hd', $head);
        $in->bindParam(':bal', $bale);
        $in->bindParam(':sec', $sec);
        $in->bindParam(':mem1', $mem1);
        $in->bindParam(':mem2', $mem2);
        $in->bindParam(':dt', $dt);
        $in->bindParam(':by', $user);
            if($in->execute()){

                $q= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of new family ($fam) by userID $uid', created=now()");
                $q->execute();

                echo"
                        <br><br><br><br><br><br><br><br><br>
                        <div style='width:100%;text-align:center;vertical-align:bottom'>
                                <div class='loader'></div>
                                <br>
                                <meta http-equiv='refresh' content='1;url=afamily'>
                                <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                        </div><br><br><br><br><br><br><br><br>";

            }else{
                $e="Operation Failed"; 
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">Family Information</h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <select class="form-control">
                                        <option><?php echo $row['project']; ?></option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom02" name="family" placeholder="Family Name"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom03" name="head" placeholder="Family Head"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom04" name="bale" placeholder="Balae's Name"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom05" name="sec" placeholder="Family Secretary"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom06" name="mem" placeholder="Member"  >
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom07" name="mem2" placeholder="Member" >
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                
                                <button class="btn btn-primary btn-block" type="submit" name="save"> Save Family</button>
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
                                                                            <th>Project</th>
                                                                            <th>Name</th>
                                                                            <th>Baale</th>
                                                                            <th>Family Head</th>
                                                                            <th>Other Members</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM family WHERE project='$fm'");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $id=$row['project'];

                                                                    
                                                                    
                                                                    
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><span class="badge badge-info"><?php echo $row['project']; ?></span></td>
                                                                            <td><small><span class="badge badge-light"><?php echo $ro['family']; ?></span></small></td>
                                                                            <td><small><?php echo $ro['baale']; ?></small></td>
                                                                            <td><small><?php echo $ro['head']; ?></small></td>
                                                                            <td>
                                                                                <small><span class="badge badge-light"><?php echo $ro['secretary']." (Secretary)"; ?></span></small><br>
                                                                                <small><span class="badge badge-light"><?php echo $ro['member1']?></span></small><br>
                                                                                <small><span class="badge badge-light"><?php echo $ro['member2']?></span></small><br>
                                                                                <small><span class="badge badge-light"><?php echo $ro['member3']?></span></small>
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
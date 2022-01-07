<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    if(empty($_POST['ben'])){
        $e="Please enter a name for benefit"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['grade'])){
        $e="Please select a grade"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $ben = check_input($_POST["ben"]);
        $grd = check_input($_POST["grade"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM travelB WHERE benefit='$ben' AND grade='$grd'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
        $q=  dbConnect()->prepare("INSERT INTO travelB SET benefit=:ben, grade=:grade,  created=:dt, createdby=:by ");
        $q->bindParam(':grade', $grd);
        $q->bindParam(':ben', $ben);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of employee Travel benefit ($ben) by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=atravel'>
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">Travel Request Benefit</h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                    <div class="col-md-12 mb-20">
                                        <label for="marital">Employee Grade</label>
                                        <select name="grade" class="form-control custom-select d-block w-100" required/>
                                            <option value="">Employee Grade...</option>
                                            <?php
                                            $gr=  dbConnect()->prepare("SELECT * FROM grade");
                                            $gr->execute();
                                            while($r=$gr->fetch()){
                                            ?>
                                            <option><?php echo $r['grade']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                    </div>
                                <div class="col-md-12 mb-20">
                                    <input type="text" class="form-control" id="validationCustom01" name="ben" placeholder="Benefit"  required>
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
                                                    <table class="table table-sm table-hover mb-0">
                                                            <thead>
                                                                    <tr>
                                                                            <th>S/N</th>
                                                                            <th>Benefit</th>
                                                                            <th>Grade</th>
                                                                            <th width="20%">Action</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM travelB");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $ro['benefit']; ?></td>
                                                                            <td><?php echo $ro['grade']; ?></td>
                                                                            <td>
                                                                                <a class="btn btn-info" style="color: white;" title="View"><i class="fa fa-eye"></i></a>
                                                                                <a class="btn btn-info" style="color: white;" title="Edit"><i class="fa fa-edit"></i></a>
                                                                                <?php // echo $ro['rate']; ?>
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
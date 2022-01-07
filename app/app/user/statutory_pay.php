<?php 
include 'nav.php'; 
$id = $_GET['id'];
$y=  dbConnect()->prepare("SELECT * FROM project WHERE id=:id ");
$y->bindParam(':id', $id);
$y->execute();
$ra=$y->fetch();
$project = $ra['project'];

if(isset($_POST['save'])){
    
    if(empty($_POST['fee'])){
        $e="Please select statutory fee"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['amt'])){
        $e="Please enter fee amount "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $fee = check_input($_POST["fee"]);
        $amt = check_input($_POST["amt"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM statutory WHERE fees=:fee AND project=:proj");
        $q1->bindParam(':fee', $fee);
        $q1->bindParam(':proj', $id);
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
        $q=  dbConnect()->prepare("INSERT INTO statutory SET fees=:fee, project=:proj, amount=:amt,  created=:dt, createdby=:by ");
        $q->bindParam(':fee', $fee);
        $q->bindParam(':proj', $id);
        $q->bindParam(':amt', $amt);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of Statutory Fee Amount $amt for project ($project) by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=statutory_pay?id=$id'>
                            <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
            
        }else{
            $e="Operation Failed"; 
            echo  " <script>alert('$e'); </script>";
        }
            
        }else{
            $e="Statutory fee already exists"; 
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">Statutory Payment</h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <!--<div class="col-xl-3">
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <select name="project" class="form-control custom-select d-block w-100" id="country">
                                        <option value="<?php echo $id; ?>"><?php echo $ra['project']; ?></option>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <select name="fee" class="form-control custom-select d-block w-100" id="country" required>
                                        <option value="">Select Statutory Fee </option>
                                        <?php
                                        $gd=  dbConnect()->prepare("SELECT * FROM fees");
                                        $gd->execute();
                                        while($r=$gd->fetch()){
                                        ?>
                                        <option value="<?php echo $r['id']; ?>"><?php echo $r['fee']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <input type="number" class="form-control" id="validationCustom01" name="amt" placeholder="Amount"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                            <button class="btn btn-primary btn-block" type="submit" name="save">Add</button>
                            </div>
                        </form>
                    </div>-->
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                                 <div class="table-wrap">
                                            <div class="table-responsive">
                                                    <table id="datable_1" class="table table-hover w-100 display pb-30">
                                                            <thead>
                                                                    <tr>
                                                                            <th>S/N</th>
                                                                            <th>Project</th>
                                                                            <th>Fee</th>
                                                                            <th>Amount</th>
                                                                            <!--<th width="10%">Action</th>-->
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM statutory WHERE project=:proj");
                                                                $q->bindParam(':proj', $id);
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $gr=$ro['fees'];
                                                                    $gg=  dbConnect()->prepare("SELECT fee FROM fees WHERE id='$gr' ");
                                                                    $gg->execute();
                                                                    $rr=$gg->fetch();
                                                                    $fees=$rr['fee'];
                                                                    
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $project; ?></td>
                                                                            <td><span class="badge badge-primary"><?php echo $fees; ?></span></td>
                                                                            <td><span class="badge badge-info"><?php echo number_format($ro['amount']); ?></span></td>
<!--                                                                            <td>
                                                                                <a href="statutory_edit?id=<?php echo $id; ?>" class="btn btn-success" style="color: white;" title="Edit"><i class="icon icon-pencil"></i></a>
                                                                            </td>-->
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
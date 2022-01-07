<?php 
include 'nav.php'; 
if(isset($_POST['save'])){
    
    if(empty($_POST['tax'])){
        $e="Please enter a name for tax"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['rate'])){
        $e="Please fill in tax rate"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $tax = check_input($_POST["tax"]);
        $rate = check_input($_POST["rate"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q1=  dbConnect()->prepare("SELECT count(id) AS no FROM emp_tax WHERE tax='$tax'");
        $q1->execute();
        $rr=$q1->fetch();
        $no=$rr['no'];
        
        if($no < 1){
            
        $q=  dbConnect()->prepare("INSERT INTO emp_tax SET tax=:tax, rate=:rate, created=:dt, createdby=:by ");
        $q->bindParam(':tax', $tax);
        $q->bindParam(':rate', $rate);
        $q->bindParam(':dt', $dt);
        $q->bindParam(':by', $user);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of employee tax ($tax) by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=etax'>
                            <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                    </div><br><br><br><br><br><br><br><br>";
            
        }else{
            $e="Operation Failed"; 
            echo  " <script>alert('$e'); </script>";
        }
            
        }else{
            $e="Employee Tax already exists"; 
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">Employee Taxes</h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                       <form class="needs-validation" method="post" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-20">
                                    <!--<label for="validationCustom01">Tax</label>-->
                                    <input type="text" class="form-control" id="validationCustom01" name="tax" placeholder="Tax Name"  required>
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
                                                                            <th>Tax</th>
                                                                            <th>Rate</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM emp_tax");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $ro['tax']; ?></td>
                                                                            <td><?php echo $ro['rate']; ?></td>
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
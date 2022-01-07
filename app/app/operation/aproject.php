<?php 
include 'nav.php'; 



if(isset($_POST['save'])){
    
    if(empty($_POST['name'])){
        $e="Please enter project name "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $proj = check_input($_POST["name"]);
        $unit = check_input($_POST["unit"]); 
        $cost = check_input($_POST["cost"]);
        $st = check_input($_POST["st"]);
        $desc = check_input($_POST["desc"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $in=  dbConnect()->prepare("INSERT INTO project SET project=:pro, start=:st, unit=:unit, cost=:cost, description=:desc, createdby=:by, created=:dt ");
        $in->bindParam(':pro', $proj);
        $in->bindParam(':st', $st);
        $in->bindParam(':unit', $unit);
        $in->bindParam(':cost', $cost);
        $in->bindParam(':dt', $dt);
        $in->bindParam(':by', $user);
        $in->bindParam(':desc', $desc);
            if($in->execute()){

                $q= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Creation of new project ($proj) by userID $uid', created=now()");
                $q->execute();

                echo"
                        <br><br><br><br><br><br><br><br><br>
                        <div style='width:100%;text-align:center;vertical-align:bottom'>
                                <div class='loader'></div>
                                <br>
                                <meta http-equiv='refresh' content='1;url=project'>
                                <span class='itext' style='color: blueviolet;'>Processing. Please Wait!...</span>
                        </div><br><br><br><br><br><br><br><br>";

            }else{
                $e="Operation Failed"; 
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">New Project Setup</h4>
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
                                    <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Project Name"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <!--<label for="validationCustom01">Tax</label>-->
                                    <input type="number" class="form-control" id="validationCustom02" name="cost" placeholder="Total Cost"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <!--<label for="validationCustom01">Tax</label>-->
                                    <input type="number" class="form-control" id="validationCustom03" name="unit" placeholder="Unit Price"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <!--<label for="validationCustom01">Tax</label>-->
                                    <input type="date" class="form-control" id="validationCustom04" name="st" placeholder="Start Date"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <!--<label for="validationCustom01">Tax</label>-->
                                    <textarea class="form-control" name="desc"></textarea>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
<!--                                <div class="col-md-12 mb-20">
                                    <select name="admin" class="form-control select2 d-block w-100" id="country" required>
                                        <option value="">Select User ... </option>
                                        <?php
                                        $gd=  dbConnect()->prepare("SELECT * FROM employee");
                                        $gd->execute();
                                        while($r=$gd->fetch()){
                                        ?>
                                        <option value="<?php echo $r['userID']; ?>"><?php echo $r['fname']." ".$r['lname'].$r['oname']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>-->
                                
                                <button class="btn btn-primary btn-block" type="submit" name="save"> Save Project</button>
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
                                                                            <th>Total Cost</th>
                                                                            <th>Cost per Plot</th>
                                                                            <th width="23%">Action</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM project");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $id=$ro['id'];
                                                                    
                                                                    
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $ro['project']; ?></td>
                                                                            <td><?php echo number_format($ro['cost']); ?></td>
                                                                            <td><?php echo number_format($ro['unit']); ?></td>
                                                                            <td>
<!--                                                                                <a href="ebranch?id=<?php echo $id; ?>" class="btn btn-primary" style="color: white;" title="Edit"><i class="fa fa-edit"></i></a>-->
                                                                                <div class="btn-group">
                                                                                    <div class="dropdown">
                                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                                                        <div role="menu" class="dropdown-menu">
                                                                                            <a class="dropdown-item" href="afamily?id=<?php echo $id; ?>">Add Family</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
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
<?php 
include 'nav.php'; 

if(isset($_GET['id'])){
 $id = $_GET['id'];
}

$qy=dbConnect()->prepare("SELECT *FROM branch WHERE id='$id'");
$qy->execute();
$y=$qy->fetch();

if(isset($_POST['save'])){
    
    if(empty($_POST['branch'])){
        $e="Please enter a branch name "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    elseif(empty($_POST['phone'])){
        $e="Please enter the branch contact number "; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $brn = check_input($_POST["branch"]);
        $phn = check_input($_POST["phone"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
         $q=  dbConnect()->prepare("UPDATE branch SET branch=:brn, phone=:phn WHERE id='$id' ");
        $q->bindParam(':brn', $brn);
        $q->bindParam(':phn', $phn);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Modification of branch ($brn) by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=branch'>
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">Branch Setup</h4>
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
                                    <input type="text" class="form-control" id="validationCustom01" name="branch" value="<?php echo $y['branch']; ?>"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <!--<label for="validationCustom01">Tax</label>-->
                                    <input type="text" class="form-control" id="validationCustom01" name="phone" value="<?php echo $y['phone']; ?>"  required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                                <button class="btn btn-primary btn-block" type="submit" name="save"> Save Changes</button>
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
                                                                            <th width="5%">S/N</th>
                                                                            <th>Branch</th>
                                                                            <th>Phone</th>
                                                                            <th width="23%">Action</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM branch");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $id=$ro['id'];
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $ro['branch']; ?></td>
                                                                            <td><?php echo $ro['phone']; ?></td>
                                                                            <td>
                                                                                <a href="ebranch?id=<?php echo $id; ?>" class="btn btn-primary" style="color: white;" title="Edit"><i class="fa fa-edit"></i></a>
                                                                                <div class="btn-group">
                                                                                    <div class="dropdown">
                                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                                                        <div role="menu" class="dropdown-menu">
                                                                                            <a class="dropdown-item" href="branchA?id=<?php echo $id; ?>">Add Branch Admin</a>
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
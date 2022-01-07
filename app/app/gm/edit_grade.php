<?php 
include 'nav.php'; 
if(isset($_GET['id'])){
$id = $_GET['id'];
}

$qq=  dbConnect()->prepare("SELECT * FROM grade WHERE id='$id'");
$qq->execute();
$rw=$qq->fetch();
$grade= $rw['grade'];

if(isset($_POST['save'])){
    
    if(empty($_POST['grade'])){
        $e="Please enter a name for Grade"; 
        echo  " <script>alert('$e'); </script>"; 
    }
    else{  
        $grd = check_input($_POST["grade"]);
        $dt= date('Y-m-d');
        $user = $uid;
        
        $q=  dbConnect()->prepare("UPDATE grade SET grade=:grade WHERE id=:id ");
        $q->bindParam(':grade', $grd);
        $q->bindParam(':id', $id);
        if($q->execute()){
            $in= dbConnect()->prepare("INSERT INTO activity SET userID='$uid', activity='Updating employee Grade ($grd) by userID $uid', created=now()");
            $in->execute();
            
            echo"
                    <br><br><br><br><br><br><br><br><br>
                    <div style='width:100%;text-align:center;vertical-align:bottom'>
                            <div class='loader'></div>
                            <br>
                            <meta http-equiv='refresh' content='1;url=gradeS'>
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
                        <h4 class="hk-pg-title font-weight-600 mb-10">Employee Grade</h4>
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
                                    <input type="text" class="form-control" id="validationCustom01" name="grade" value="<?php echo $grade; ?>" required>
                                    <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                </div>
                            <button class="btn btn-primary btn-block" type="submit" name="save">Update</button>
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
                                                                            <th>Grade</th>
                                                                    </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                $q=  dbConnect()->prepare("SELECT * FROM grade WHERE id='$id'");
                                                                $q->execute();
                                                                $counter =0;
                                                                while($ro=$q->fetch()){
                                                                    $id=$ro['id'];
                                                                ?>
                                                                    <tr>
                                                                            <td><?php echo ++$counter; ?></td>
                                                                            <td><?php echo $ro['grade']; ?></td>
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
<?php 
include 'nav.php';

if(isset($_GET['id'])){
    $id =$_GET['id'];
}
//$d=$id;

$epp=  dbConnect()->prepare("SELECT * FROM employee WHERE userID='$id' ");
$epp->execute();
$rw=$epp->fetch();

$phone=$rw['phone'];
$email=$rw['email'];
$nam=$rw['fname']." ".$rw['lname']." ".$rw['oname'];
$grd=$rw['grade'];
$job=$rw['job'];
$join=$rw['created'];

$q=  dbConnect()->prepare("SELECT job FROM job WHERE id='$job'");
$q->execute();
$w=$q->fetch();
$jb=$w['job'];

$qq=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$grd'");
$qq->execute();
$x=$qq->fetch();
$grade=$x['grade'];

$sl=dbConnect()->prepare("SELECT component, value FROM salaryComponent WHERE grade='$grd' AND job='$job'");
$sl->execute();
$rx=$sl->fetch();
$scomp= $rx['component'];
if($scomp =='Basic Salary'){
    $sala= $rx['value'];
}else{
    $sala= $rx['value'];
}


if(isset($_POST['save'])){
    
    
    
    
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
                
                
                
                
                
                
                <div class="profile-cover-wrap overlay-wrap">
                     <div class="profile-cover-img" style="background-image:url('../dist/img/trans-bg.jpg')"></div>
                        <div class="bg-overlay bg-trans-dark-60"></div>
                        <div class="container profile-cover-content py-50">
                                <div class="hk-row"> 
                                        <div class="col-lg-6">
                                                <div class="media align-items-center">
                                                        <div class="media-img-wrap  d-flex">
                                                                <div class="avatar">
                                                                        <img src="../dist/img/avatar12.jpg" alt="user" class="avatar-img rounded-circle">
                                                                </div>
                                                        </div>
                                                        <div class="media-body">
                                                                <div class="text-white text-capitalize display-6 mb-5 font-weight-400"><?php echo $nam; ?></div>
                                                                <div class="font-14 text-white"><span class="mr-5"><span class="font-weight-500 pr-5">Joined</span><span class="mr-5"><?php echo $join; ?></span></span><span></span></div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-lg-6">
                                                <div class="button-list">
                                                        <a href="#" class="btn btn-dark btn-wth-icon icon-wthot-bg btn-rounded"><span class="btn-text"><?php echo $phone; ?></span><span class="icon-label"><i class="fa fa-phone"></i> </span></a>
                                                       <!-- <a href="#" class="btn btn-icon btn-icon-circle btn-indigo btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                                                        <a href="#" class="btn btn-icon btn-icon-circle btn-sky btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                                                        <a href="#" class="btn btn-icon btn-icon-circle btn-purple btn-icon-style-2"><span class="btn-icon-wrap"><i class="fa fa-instagram"></i></span></a>-->
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div><hr/>
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h4 class="hk-pg-title font-weight-600 mb-10">Summary</h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-3">
                        <section class="hk-sec-wrapper">
                            Employee's Information
                        </section>
                    </div>
                    <div class="col-xl-9">
                        <section class="hk-sec-wrapper">
                                 <div class="table-wrap">
                                            <div class="table-responsive">
                                                <label class="btn btn-primary">Employee Salary Components</label><hr/>
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
                                    <div class="table-responsive"><br/>
                                        <label class="btn btn-primary">Employee Deductions</label><hr/>
                                        <table class="table table-sm table-hover mb-0">
                                                <thead>
                                                        <tr>
                                                                <th>S/N</th>
                                                                <th>Salary Deduction</th>
                                                                <th>Rate</th>
                                                                <th>Value</th>
                                                                <th width="20%">Action</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $qx=  dbConnect()->prepare("SELECT * FROM dedComponent WHERE userID='$id'");
                                                    $qx->execute();
                                                    $counter =0;
                                                    while($ro=$qx->fetch()){
                                                        $gr=$ro['id'];
                                                        $sded=$ro['deduction'];
                                                        $rate = $ro['value'];
                                                        $amt = $ro['amount'];
                                                        $rValue =($rate/100) * $sala;

                                                        /*
                                                        $y=  dbConnect()->prepare("SELECT component FROM salaryComponent WHERE id='$cid' ");
                                                        $y->execute();
                                                        $v=$q2->fetch();

                                                        $compp=$u['component'];  */
                                                    ?>
                                                        <tr>
                                                                <td><?php echo ++$counter; ?></td>
                                                                <td><?php  echo $sded; ?></td>
                                                                <td><?php echo $ro['value']."%"; ?></td>
                                                                <td><?php  echo $rValue; ?></td>
                                                                <td>
                                                                    <a class="btn btn-danger" style="color: white;" title="Delete"><i class="icon icon-trash"></i></a>
                                                                </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                        </table>
                                    </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
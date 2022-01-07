<?php 
include 'nav.php'; 
if(isset($_GET['m']) && isset($_GET['yr'])){
  
    $mnt=$_GET['m'];
    $yr=$_GET['yr'];
}

$monthNum  = $mnt;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');

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
                <!-- Title -->
                <div class="hk-pg-header align-items-top">
                    <div>
                        <h4 class="hk-pg-title font-weight-600 mb-10"><i class="ion ion-ios-calendar"></i> Salary Schedule for month of <?php echo $monthName.", ". $yr;?></h4>
                    </div>
                </div>
                <!-- /Title -->
                

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                                 <div class="table-wrap">
                                            <div class="table-responsive">
                               <table id="datable_1" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Employee</th>
                                        <th>Gross Salary</th>
                                        <th>Benefits</th>
                                        <th>Deductions</th>
                                        <th>Net</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    /*
                                        $dd=date('m');
                                        $dat= date('F');
                                        $yr=date('Y');
                                        */
                                        $q=  dbConnect()->prepare("SELECT * FROM emp_pay WHERE month='$mnt' AND year='$yr'");
                                        $q->execute();
                                        $counter =0;
                                        while($ro=$q->fetch()){
                                            $gr=$ro['grade'];
                                            $jbl=$ro['job'];
                                            $u=$ro['userID'];

                                            $empN = dbConnect()->prepare("SELECT * FROM users WHERE userID='$u'");
                                            $empN->execute();
                                            $x= $empN->fetch();
                                            $empName=$x['fname']." ".$x['lname'];


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
                                                <td><?php echo $empName; ?></td>
                                                <td><?php echo $ro['gross']; ?></td>
                                                <td><?php echo $ro['benefit']; ?></td>
                                                <td><?php echo $ro['deduction']; ?></td>
                                                <td><?php echo $ro['net']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                            <div role="menu" class="dropdown-menu">
                                                                <a class="dropdown-item" href="emp_view?id=<?php echo $u; ?>">View Employee</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                        </tr>
                                        <?php } ?>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Employee</th>
                                        <th>Gross Salary</th>
                                        <th>Benefits</th>
                                        <th>Deductions</th>
                                        <th>Net</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                                    </div>
                        </section>  
                   </div>
                <!-- /Row -->
                </div>
            <!-- /Container -->
            <?php include 'foot.php'; ?>
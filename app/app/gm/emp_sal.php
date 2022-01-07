<?php 
include 'nav.php'; 
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
                        <h4><i class="ion ion-ios-wallet"></i> Employee Salary Structured</h4>
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
                                                        <th></th>
                                                        <th width="25%">Employee Name</th>
                                                        <th>Gross Pay</th>
                                                        <th width="25%">Salary Components</th>
                                                        <th width="20%">Deductions</th>
                                                        <th width="20%">Grade</th>
                                                        <th width="5%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $epp=  dbConnect()->prepare("SELECT userID, grade, job, sum(value) AS sum, count(component) as component FROM emp_salary GROUP BY userID");
                                                    $counter=0;
                                                    $epp->execute();
                                                    while($ro=$epp->fetch()){
                                                        $cm=$ro['component'];
                                                        $jub=$ro['job'];
                                                        $gr=$ro['grade'];
                                                        $id=$ro['userID'];
                                                        $sum=$ro['sum'];
                                                        
                                                        $q1=  dbConnect()->prepare("SELECT grade FROM grade WHERE id='$gr'");
                                                        $q1->execute();
                                                        $rr1=$q1->fetch();
                                                        $grad=$rr1['grade'];
                                                        
                                                        /*
                                                        $w=  dbConnect()->prepare("SELECT job FROM job WHERE id='$jub'");
                                                        $w->execute();
                                                        $ru=$w->execute();
                                                        $joob=$w['job'];
                                                        
                                                        */
                                                        
                                                        $q=  dbConnect()->prepare("SELECT fname, lname FROM users WHERE userID='$id'");
                                                        $q->execute();
                                                        $rr=$q->fetch();
                                                        
                                                        $u_name=$rr['fname']." ".$rr['lname'];
                                                ?>
                                                    <tr>
                                                            <td><?php echo ++$counter;?></td>
                                                            <td><?php echo $u_name;?></td>
                                                            <td><?php echo $sum ?></td>
                                                            <td>
                                                                <?php 
                                                                    $q1=  dbConnect()->prepare("SELECT  component FROM salaryComponent WHERE grade='$gr' AND job='$jub'");
                                                                    $q1->execute();
                                                                    while($rr=$q1->fetch()){
                                                                        $cp=$rr['component'];
                                                                        echo "<small>$cp</small>".", ";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    $q1=  dbConnect()->prepare("SELECT  deduction FROM emp_deduction WHERE grade='$gr'");
                                                                    $q1->execute();
                                                                    while($rr=$q1->fetch()){
                                                                        $cp=$rr['deduction'];
                                                                        echo "<small>$cp</small>".", ";
                                                                    }
                                                                ?>
                                                            </td>
                                                            <td><?php echo $grad; ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="user"></i></span> <span class="caret"></span></button>
                                                                        <div role="menu" class="dropdown-menu">
                                                                            <a class="dropdown-item" href="emp_view?id=<?php echo $id; ?>">View Employee</a>
                                                                            <!--
                                                                            <a class="dropdown-item" href="esalary?id=<?php echo $id;?>">Set Salary</a>
                                                                            <a class="dropdown-item" href="edit_emp?id=<?php echo $id; ?>">Edit Employee</a>
                                                                            <a class="dropdown-item" href="#">Deactivate</a>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                    </tr>
                                                    <?php } ?>
                                            <tfoot>
                                                <tr>
                                                        <th></th>
                                                        <th width="25%">Employee Name</th>
                                                        <th>Salary</th>
                                                        <th width="25%">Salary Components</th>
                                                        <th width="20%">Deductions</th>
                                                        <th width="20%">Grade</th>
                                                        <th width="5%">Action</th>
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
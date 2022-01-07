<?php 
        include 'dash_nav.php'; 
        
        $d = "2019-06-06";
$dd=date('m');
$dat= date('F');
$yr=date('Y');
                                        
$qq=  dbConnect()->prepare("SELECT distinct(month) AS month, year, count(userID) AS user, sum(basic) AS basic, sum(benefit) AS benefit, sum(deduction) AS deduction, sum(net) AS net FROM emp_pay WHERE branch='$branch' AND year='$yr' AND month='$dd' GROUP BY branch ORDER BY month DESC");
$qq->execute();
$ro=$qq->fetch();

//This is for PHP 7.4 for iteration
//$usr = $ro['user']??="0";

  $usr  = $ro['user'];   
  $net  = $ro['net'];
  $dedc = $ro['deduction'];
  $benf = $ro['benefit'];
        ?>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!--/Horizontal Nav-->
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <div class="hk-pg-header">
                    <div>
			<h2 class="hk-pg-title font-weight-600">Salary </h2>
                    </div>
<!--                    <div class="d-flex mb-0 flex-wrap">
                        <a href="asalary" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="btn-text"><i class="fa fa-money"></i> New Salary</span></a>
                    </div>-->
                </div>
                <!-- /Title -->

                 <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="hk-row">
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Staff on Payroll</span>
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                    <div>
                                                        <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($usr) ;?></span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Last Payroll (Net)</span>
                                            <div class="d-flex align-items-center justify-content-between position-relative">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark">=N=<span class="counter-anim"><?php echo number_format($net) ;?></span></span>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Deductions</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark">=N= <?php echo number_format($dedc) ;?></span>
                                                                    
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                            <div class="card card-sm">
                                    <div class="card-body">
                                            <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Benefit</span>
                                            <div class="d-flex align-items-end justify-content-between">
                                                    <div>
                                                            <span class="d-block">
                                                                    <span class="display-5 font-weight-400 text-dark">=N= <?php echo number_format($benf) ;?></span>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
            </div>
           <!-- <div class="hk-row">
                    <div class="col-lg-12">
                            <div class="card card-refresh">
                                    <div class="refresh-container">
                                            <div class="loader-pendulums"></div>
                                    </div>
                                    <div class="card-header card-header-action">
                                            <h6>Payroll by Month in <?php echo date('Y')?></h6>
                                            <div class="d-flex align-items-center card-action-wrap">
                                                    <a href="#" class="inline-block refresh mr-15">
                                                            <i class="ion ion-md-radio-button-off"></i>
                                                    </a>
                                                    <a href="#" class="inline-block full-screen">
                                                            <i class="ion ion-md-expand"></i>
                                                    </a>
                                            </div>
                                    </div>
                                    <div class="card-body">
                                            <div class="hk-legend-wrap mb-20">
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Basic Salary</span>
                                                    </div>
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-brown-light-5 rounded-circle d-inline-block"></span><span>Emp Benefit</span>
                                                    </div>
                                                    <div class="hk-legend">
                                                            <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>Deductions</span>
                                                    </div>
                                            </div>
                                            <div id="area_chart" class="echart" style="height: 194px;"></div>
                                    </div>
                            </div>
                    </div>
            </div>-->
        <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
            <h4>Recent Payroll</h4><small>Total Monthly Payment</small>
        </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                <div class="table-wrap">
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
                    </div>		
		 </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
			
            <?php include 'foot2.php'; ?>
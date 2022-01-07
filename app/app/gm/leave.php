<?php 
include 'dash_nav.php'; 
//total leave
$q1=  dbConnect()->prepare("SELECT count(id) AS no FROM leaves WHERE branch='$branch'");
$q1->execute();
$rr=$q1->fetch();
$leaves=$rr['no'];

//Approved leave
$q2=  dbConnect()->prepare("SELECT count(id) AS no FROM leaves WHERE branch='$branch' AND status='Approved'");
$q2->execute();
$rr2=$q2->fetch();
$lapprove=$rr2['no'];

//Pending leave
$q3=  dbConnect()->prepare("SELECT count(id) AS no FROM leaves WHERE branch='$branch' AND status='Pending'");
$q3->execute();
$rr3=$q3->fetch();
$lpending=$rr3['no'];

//Declined leave
$q4=  dbConnect()->prepare("SELECT count(id) AS no FROM leaves WHERE branch='$branch' AND status='Declined'");
$q4->execute();
$rr4=$q4->fetch();
$ldecline=$rr4['no'];
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
			<h2 class="hk-pg-title font-weight-600">Leaves </h2>
                    </div>
                    <div class="d-flex mb-0 flex-wrap">
                        <!--<div class="btn-group btn-group-sm btn-group-rounded mb-15 mr-15" role="group">
                            <a href="" class="btn btn-outline-secondary">Vendors</a>
                            <a href="" class="btn btn-outline-secondary">Expenses</a>
                        </div>-->
                        <a href="leaveType" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span><span class="btn-text">Create Type</span></a>
                        <a href="leaveR" class="btn btn-sm btn-outline-secondary btn-rounded btn-wth-icon icon-wthot-bg mb-15"><span class="icon-label"><span class="feather-icon"><i data-feather="plus"></i></span> </span><span class="btn-text">Leave Request</span></a>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hk-row">
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Leaves Year till Date</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block display-5 font-weight-400 text-dark"><?php echo number_format($leaves); ?></span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Approved</span>
                                                    <div class="d-flex align-items-center justify-content-between position-relative">
                                                            <div>
                                                                    <span class="d-block">
                                                                        <span class="display-5 font-weight-400 text-dark"><span class="counter-anim"><?php echo number_format($lapprove); ?></span></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Pending</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($lpending); ?></span>
                                                                            
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                    <div class="card card-sm">
                                            <div class="card-body">
                                                    <span class="d-block font-11 font-weight-500 text-dark text-uppercase mb-10">Declined</span>
                                                    <div class="d-flex align-items-end justify-content-between">
                                                            <div>
                                                                    <span class="d-block">
                                                                            <span class="display-5 font-weight-400 text-dark"><?php echo number_format($ldecline); ?></span>
                                                                    </span>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    </div>
                        
                        
                        
                   
                   
                        
                        
                        
<!--                   <div class="hk-row">
                                <div class="col-lg-6">
                                                <div class="card">
                                                <div class="card-header card-header-action">
                                                        <h6>Budget</h6>
                                                </div>
                                                <div class="card-body">
                                                        <div class="hk-legend-wrap mb-20">
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-2 rounded-circle d-inline-block"></span><span>A1</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>A2</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>A3</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-4 rounded-circle d-inline-block"></span><span>A4</span>
                                                                </div>
                                                        </div>
                                                        <div id="e_chart_9" class="echart" style="height:287px;"></div>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                                <div class="card">
                                                <div class="card-header card-header-action">
                                                        <h6>Risk</h6>
                                                        <div class="d-flex align-items-center card-action-wrap">
                                                                <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary risk-switch"></div>
                                                        </div>
                                                </div>
                                                <div class="card-body">
                                                        <div id="e_chart_10" class="echart" style="height:260px;"></div>
                                                        <div class="hk-legend-wrap mt-20 mb-5">
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-2 rounded-circle d-inline-block"></span><span>Net Search</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-primary rounded-circle d-inline-block"></span><span>Email Search</span>
                                                                </div>
                                                        </div>
                                                        <div class="hk-legend-wrap">
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-3 rounded-circle d-inline-block"></span><span>Direct Search</span>
                                                                </div>
                                                                <div class="hk-legend">
                                                                        <span class="d-10 bg-brown-light-4 rounded-circle d-inline-block"></span><span>Paid Search</span>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>-->
                        
                    <div class="d-flex align-items-center justify-content-between mt-40 mb-20">
                            <h4>Leaves</h4>
                            <button class="btn btn-sm btn-link">view all</button>
                    </div>
                    <div class="card">
                            <div class="card-body pa-0">
                                <div class="table-wrap">
                                        <table id="datable_1" class="table table-hover w-100 display pb-30">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th><i class="icon icon-user"></i> Employee</th>
                                                    <th><i class="icon icon-calender"></i> Star date</th>
                                                    <th><i class="icon icon-calender"></i> End Date</th>
                                                    <th><i class="icon icon-list"></i> Purpose</th>
                                                    <th><i class="fa fa-clock-o"></i> Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $tr=  dbConnect()->prepare("SELECT * FROM leaves WHERE branch='$branch'");
                                                $counter=0;
                                                $tr->execute();
                                                while($r=$tr->fetch())
                                                {
                                                    $usr= $r['userID'];
                                                    $id= $r['id'];
                                                    $q=  dbConnect()->prepare("SELECT fname, lname FROM users WHERE userID='$usr'");
                                                        $q->execute();
                                                        $rr=$q->fetch();
                                                        
                                                        $u_name=$rr['fname']." ".$rr['lname'];
                                                ?>
                                                <tr>
                                                        <td><?php echo ++$counter; ?></td>
                                                        <td><?php echo $u_name; ?></td>
                                                        <td><?php echo $r['start']; ?></td>
                                                        <td><?php echo $r['end']; ?></td>
                                                        <td><?php echo $r['purpose']; ?></td>
                                                        <td><span class="badge badge-primary"><?php echo $r['status']; ?></span></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                    <div class="dropdown">
                                                                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-secondary dropdown-toggle btn-icon-dropdown" type="button"><span class="feather-icon"><i data-feather="book"></i></span> <span class="caret"></span></button>
                                                                        <div role="menu" class="dropdown-menu">
                                                                            <a class="dropdown-item" href="leaveP?id=<?php echo $id; ?>">Process Request</a>
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
                                                    <th>Employee</th>
                                                    <th>Travel date</th>
                                                    <th>Return Date</th>
                                                    <th>Purpose</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
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